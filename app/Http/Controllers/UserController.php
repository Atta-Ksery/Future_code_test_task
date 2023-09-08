<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Constants\ApiMessages;
use App\Actions\GetPaginationData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\SignUpRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\User\AddFriendRequest;
use App\Http\Requests\User\AcceptFriendRequest;
use App\Http\Requests\User\InviteFriendToPurchaseRequest;
use App\Http\Requests\User\AddMemberToMarketingPageRequest;
use App\Http\Requests\User\BlockUserFromMarketingPageRequest;
use App\Http\Resources\User\GetFinancialDetailsResource;

class UserController extends Controller
{
    public function signUp(SignUpRequest $request)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        $user = User::create([
            'first_name'    => $validatedData['first_name'],
            'last_name'     => $validatedData['last_name'],
            'email'         => $validatedData['email'],
            'password'      => bcrypt($validatedData['password']),
            'mobile_number' => $validatedData['mobile_number'],
            'birthday'      => $validatedData['birthday'],
            'wallet_value'  => $validatedData['wallet_value']
        ]);

        if ($request->file('user_photo')) {
            $user->addMediaFromRequest('user_photo')
                ->toMediaCollection('user_photo');
        }

        $token = $user->createToken('NewLook-app')->plainTextToken;
        $user->save();

        $userResponse = new UserResource($user);

        $data = [
            'user'  => $userResponse,
            'token' => $token
        ];

        DB::commit();
        return $this->okResponse($data, __(ApiMessages::MSG_SUCCESS));
    }

    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::where('email', $validatedData['email'])->first();

        if (!Hash::check($validatedData['password'], $user->password)) {
            return $this->unauthorizedResponse(null, __(ApiMessages::MSG_WRONG_PASSWORD));
        }

        DB::beginTransaction();
        $token = $user->createToken('NewLook-app')->plainTextToken;
        $user->save();

        $userResponse = new UserResource($user);

        $data = [
            'user'  => $userResponse,
            'token' => $token
        ];

        DB::commit();
        return $this->okResponse($data, __(ApiMessages::MSG_LOGIN_SUCCESSFULLY));
    }

    public function getFinancialDetails(Request $request) {
        $user = User::find(Auth::user()->id);
        $data = new GetFinancialDetailsResource($user);
        return $this->okResponse($data, __(ApiMessages::MSG_SUCCESS));
    }

    public function addFriend(AddFriendRequest $request)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        DB::table('friendships')
            ->insert([
                'sender_id'     => Auth::user()->id,
                'receiver_id'   => $validatedData['receiver_id']
            ]);
        DB::commit();
        return $this->okResponse(null, __(ApiMessages::MSG_SUCCESS));
    }

    public function acceptFriendRequest(AcceptFriendRequest $request)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        DB::table('friendships')
            ->where('sender_id', $validatedData['sender_id'])
            ->where('receiver_id', Auth::user()->id)
            ->update([
                'is_accepted'   =>  true
            ]);

        DB::commit();
        return $this->okResponse(null, __(ApiMessages::MSG_SUCCESS));
    }

    public function inviteFriendToPurchase(InviteFriendToPurchaseRequest $request)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        DB::table('purchase_invitations')
            ->insert([
                'sender_id'     => Auth::user()->id,
                'receiver_id'   => $validatedData['receiver_id'],
                'product_id'    => $validatedData['product_id']
            ]);
        DB::commit();
        return $this->okResponse(null, __(ApiMessages::MSG_SUCCESS));
    }


    public function logout(Request $request)
    {
        DB::beginTransaction();
        // Delete the token for this device.
        $request->user()->currentAccessToken()->delete();
        DB::commit();
        return $this->okResponse(null, __(ApiMessages::MSG_LOGOUT_SUCCESSFULLY));
    }

    public function getListOfUsers(Request $request) {
        $users = User::paginate(5);

        $data = UserResource::collection($users);
        $paginationData = GetPaginationData::run($users);
        return $this->okResponse($data, __(ApiMessages::MSG_SUCCESS), $paginationData);
    }

    public function addMemberToMarketingPage(AddMemberToMarketingPageRequest $request) {
        $validatedData = $request->validated();

        DB::beginTransaction();

        DB::table('members')
          ->insert([
            'user_id'       => $validatedData['member_id'],
            'marketing_id'  => $validatedData['marketing_id']
          ]);

        DB::commit();

        return $this->okResponse(null, __(ApiMessages::MSG_SUCCESS));
    }

    public function blockUserFromMarketingPage(BlockUserFromMarketingPageRequest $request) {
        $validatedData = $request->validated();

        DB::beginTransaction();

        DB::table('blocked_users')
          ->insert([
            'user_id'           => $validatedData['blocked_user_id'],
            'marketing_page_id' => $validatedData['marketing_page_id']
          ]);

        DB::commit();
        return $this->okResponse(null, __(ApiMessages::MSG_SUCCESS));
    }

}
