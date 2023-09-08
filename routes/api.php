<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MarketingPageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['SetAppLang'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::post('/users/sign-up', 'signUp');
        Route::post('/users/login', 'login')->name('login');
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::post('/logout', 'logout');
            Route::post('/users/add-friend', 'addFriend');
            Route::post('/users/invite-friend-to-purchase', 'inviteFriendToPurchase');
            Route::post('/users/accept-friend-request', 'acceptFriendRequest');
            Route::get('/users', 'getListOfUsers');
            Route::post('/users/add-member-to-marketing-page', 'addMemberToMarketingPage');
            Route::get('/users/financial-details', 'getFinancialDetails');
            Route::post('/users/block-user', 'blockUserFromMarketingPage');
        });
    });

    Route::controller(MarketingPageController::class)->middleware(['auth:sanctum'])->group(function () {
        Route::post('/marketing-pages', 'createMarketingPage');
        Route::post('/marketing-pages/add-product', 'createProductAndAddedToPage');
        Route::get('/marketing-pages/{id}', 'getMarketingPageDetails')
        ->where('id', '[0-9]+');
        Route::post('/marketing-pages/products/add-discount', 'addDiscountToProduct');
        Route::get('/marketing-pages', 'getListOfMarketingPages');
    });

    Route::controller(OrderController::class)->middleware(['auth:sanctum'])->group(function () {
        Route::post('/orders', 'makeOrder');
        Route::post('/orders/accept-friend-request-to-purchase-order', 'acceptFriendInvitedToPurchase');
    });

});
