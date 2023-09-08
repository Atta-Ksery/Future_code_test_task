<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Constants\Resources;
use Illuminate\Http\Request;
use App\Constants\ApiMessages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Order\OrderResource;
use App\Http\Requests\Order\MakeOrderRequest;
use App\Http\Requests\Order\AcceptFriendInvitedToPurchaseRequest;

class OrderController extends Controller
{
    public function makeOrder(MakeOrderRequest $request)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        $buyer  = User::find(Auth::user()->id);
        $seller = User::find($validatedData['seller_id']);

        $orderTotalPrice = null;

        $productIds = $validatedData['productIds'];
        $amounts    = $validatedData['amounts'];

        for ($i = 0; $i < sizeof($productIds); $i++) {
            $product = Product::find($productIds[$i]);
            $price = $product->price;
            $currentDateTime = Carbon::now();
            if ($product->discount_percentage && $currentDateTime->between($product->start_datetime, $product->end_datetime)) {
                $price = $price * ($product->price / 100);
            }
            $orderTotalPrice += $price * $amounts[$i];
            $product->amount -= $amounts[$i];
            $product->save();
        }

        if ($buyer->wallet_value < $orderTotalPrice) {
            return $this->notAllowedResponse(null, __(ApiMessages::MSG_ORDER_NOT_ALLOWED));
        }

        $order = Order::create([
            'type'              => 'normal',
            'total_price'       => $orderTotalPrice,
            'seller_id'         => $validatedData['seller_id'],
            'buyer_id'          => Auth::user()->id,
            'order_datetime'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        for ($i = 0; $i < sizeof($productIds); $i++) {
            $order->products()->attach(
                $productIds[$i],
                [
                    'amount'    => $amounts[$i]
                ]
            );
        }

        $buyer->wallet_value    -= $orderTotalPrice;
        $buyer->total_purchases += $orderTotalPrice;

        $seller->wallet_value += $orderTotalPrice;

        $buyer->save();
        $seller->save();

        $orderResponse = new OrderResource($order);
        DB::commit();
        return $this->createdResponse($orderResponse, __(ApiMessages::MSG_ADDED_SUCCESSFULLY, ['resource' => __(Resources::RES_ORDER)]));
    }

    public function acceptFriendInvitedToPurchase(AcceptFriendInvitedToPurchaseRequest $request)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        $buyer   = User::find(Auth::user()->id);
        $inviteSender  = User::find($validatedData['sender_id']);
        $product = Product::find($validatedData['product_id']);
        $productPrice   = $product->price;
        $price = $product->price;
        $currentDateTime = Carbon::now();

        if ($product->discount_percentage && $currentDateTime->between($product->start_datetime, $product->end_datetime)) {
            $price = $price * ($product->price / 100);
        }

        $seller = $product->marketingPage->owner;

        if ($buyer->wallet_value < $price) {
            return $this->notAllowedResponse(null, __(ApiMessages::MSG_ORDER_NOT_ALLOWED));
        }

        $order = Order::create([
            'type'              => 'from_invitation',
            'total_price'       => $price,
            'seller_id'         => $seller->id,
            'buyer_id'          => Auth::user()->id,
            'order_datetime'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $order->products()->attach(
            $product->id,
            [
                'amount'    =>  1
            ]
        );

        $buyer->wallet_value    -= $price;
        $buyer->total_purchases += $price;

        $inviteSenderProfit = $product->basic_value * 0.02;
        $inviteSender->wallet_value += $inviteSenderProfit;

        $paidPrice = $price - $inviteSenderProfit;
        $seller->wallet_value += $paidPrice;


        DB::table('purchase_invitations')
            ->where('sender_id', $inviteSender->id)
            ->where('receiver_id', Auth::user()->id)
            ->update([
                'is_accepted'   =>  true,
                'profit_amount' =>  $inviteSenderProfit
            ]);

        $buyer->save();
        $seller->save();
        $inviteSender->save();

        $orderResponse = new OrderResource($order);
        DB::commit();

        return $this->okResponse($orderResponse, __(ApiMessages::MSG_SUCCESS));
    }
}
