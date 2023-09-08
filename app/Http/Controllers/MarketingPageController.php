<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Constants\Resources;
use Illuminate\Http\Request;
use App\Models\MarketingPage;
use App\Constants\ApiMessages;
use App\Http\Traits\ModelHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MarketingPage\MarketingPageResource;
use App\Http\Requests\MarketingPage\CreateMarketingPageRequest;
use App\Http\Requests\MarketingPage\AddDiscountToProductRequest;
use App\Http\Requests\MarketingPage\CreateProductAndAddedToPage;

class MarketingPageController extends Controller
{
    public function createMarketingPage(CreateMarketingPageRequest $request) {
        $validatedData = $request->validated();

        DB::beginTransaction();
        $name = ['en' => $validatedData['name_en'], 'ar' => $validatedData['name_ar']];
        $description = ['en' => $validatedData['desc_en'], 'ar' => $validatedData['desc_ar']];
        $marketingPage = MarketingPage::create([
            'name'              => $name,
            'description'       => $description,
            'user_id'           => Auth::user()->id,
            'product_type_id'   => $validatedData['product_type_id']
        ]);

        if ($request->file('marketing_page_photo')) {
            $marketingPage->addMediaFromRequest('marketing_page_photo')
                ->toMediaCollection('marketing_page_photo');
        }

        $marketingPage->save();

        $marketingPageResponse = new MarketingPageResource($marketingPage);
        DB::commit();
        return $this->createdResponse($marketingPageResponse, __(ApiMessages::MSG_ADDED_SUCCESSFULLY, ['resource' => __(Resources::RES_MARKETING_PAGE)]));
    }

    public function createProductAndAddedToPage(CreateProductAndAddedToPage $request) {
        $validatedData = $request->validated();

        DB::beginTransaction();
        $name = ['en' => $validatedData['name_en'], 'ar' => $validatedData['name_ar']];
        $description = ['en' => $validatedData['desc_en'], 'ar' => $validatedData['desc_ar']];
        $product = Product::create([
            'name'                  => $name,
            'description'           => $description,
            'basic_value'           => $validatedData['basic_value'],
            'price'                 => $validatedData['price'],
            'amount'                => $validatedData['amount'],
            'marketing_page_id'     => $validatedData['marketing_page_id']
        ]);

        if ($request->file('product_photo')) {
            $product->addMediaFromRequest('product_photo')
                ->toMediaCollection('product_photo');
        }

        $product->save();

        $marketingPage = MarketingPage::find($validatedData['marketing_page_id']);
        $marketingPageResponse = new MarketingPageResource($marketingPage);

        DB::commit();
        return $this->createdResponse($marketingPageResponse, __(ApiMessages::MSG_ADDED_SUCCESSFULLY, ['resource' => __(Resources::RES_PRODUCT)]));
    }

    public function getMarketingPageDetails(Request $request, $id) {
        $marketingPage = ModelHelper::findByIdOrFail(MarketingPage::class, $id, 'female', Resources::RES_MARKETING_PAGE);

        $data = new MarketingPageResource($marketingPage);

        return $this->okResponse($data, __(ApiMessages::MSG_SUCCESS));
    }

    public function addDiscountToProduct(AddDiscountToProductRequest $request) {
        $validatedData = $request->validated();

        DB::beginTransaction();
        $product = Product::find($validatedData['product_id']);

        $product->discount_percentage = $validatedData['discount_percentage'];
        $product->discount_start_datetime = $validatedData['start_dateTime'];
        $product->discount_end_datetime = $validatedData['end_dateTime'];

        $product->save();

        DB::commit();

        return $this->okResponse(null, __(ApiMessages::MSG_SUCCESS));
    }

}
