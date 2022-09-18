<?php

use App\Http\Controllers\SslCommerzPaymentController;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlFactory;
use GuzzleHttp\Handler\CurlHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function (Request $request) {
    return ['message' => 'The bazar API!'];
});
Route::get('/hello', function (Request  $request){
   return response()->json('Hello Dev');
});

// SSLCOMMERZ Start
Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

/**
 * related to aamarpay payment transaction verfication
 */
Route::post('{paymentId}/aamarpay-payment-transaction-success/{name}', function(Request $request, $id, $category) {
    if (!$request -> hasValidSignature()) {
        abort(401);
    }
    return App::call('App\Http\Controllers\PaymentTransactionController@aamarpaySuccess');
})->name('aamarpay-payment-transaction-success')->middleware('signed');

Route::post('{paymentId}/aamarpay-payment-transaction-failed/{name}', function(Request $request, $id, $category) {
    if (!$request -> hasValidSignature()) {
        abort(401);
    }
    return App::call('App\Http\Controllers\PaymentTransactionController@aamarpayFailed');
})->name('aamarpay-payment-transaction-failed')->middleware('signed');

Route::group(['prefix' => 'api/v1'], function () {
    /**
     * related to get index without authentication
     */
    Route::apiResource('category', 'CategoryController', ['only' => ['index', 'show']]);
    Route::apiResource('sub-category', 'SubCategoryController', ['only' => ['index', 'show']]);
    Route::apiResource('brand', 'BrandController', ['only' => ['index', 'show']]);
    Route::apiResource('vendor', 'VendorController', ['only' => ['index', 'show']]);
    Route::apiResource('product', 'ProductController', ['only' => ['index', 'show']]);
    Route::apiResource('product-stock', 'ProductStockController', ['only' => ['index', 'show']]);
    Route::apiResource('rating-and-review', 'RatingAndReviewController', ['only' => ['index', 'show']]);
    Route::apiResource('ad-and-slider', 'AdAndSliderController', ['only' => ['index', 'show']]);
    Route::apiResource('content-module', 'ContentModuleController',  ['only' => ['index', 'show']]);
    Route::apiResource('product-offer', 'ProductOfferController',  ['only' => ['index', 'show']]);
    Route::apiResource('product-return-delivery-option', 'ProductReturnAndDeliveryOptionController', ['only' => ['index', 'show']]);
    Route::apiResource('campaign', 'CampaignController', ['only' => ['index', 'show']]);
    Route::apiResource('app-footer', 'AppFooterController', ['only' => ['index', 'show']]);
    Route::apiResource('meta-and-slug', 'MetaAndSlugController',  ['only' => ['index', 'show']]);


    Route::group(['middleware' => ['auth:api']], function () {
        /**
         * related to meta and slug
         */
        Route::apiResource('meta-and-slug', 'MetaAndSlugController',  ['except' => ['destroy'], 'only' => ['update', 'store']]);

        /**
         * related to user features
         */
        Route::apiResource('user', 'UserController', ['except' => ['destroy']]);
        Route::apiResource('admin', 'AdminController');
        Route::apiResource('staff', 'StaffController');
        Route::apiResource('customer', 'CustomerController');
        Route::apiResource('vendor', 'VendorController', ['except' => ['destroy'], 'only' => ['update', 'store']]);

        /**
         * related to user accounts and profiles
         */
        Route::apiResource('role', 'RoleController');
        Route::apiResource('user-role', 'UserRoleController');
        Route::apiResource('user-profile', 'UserProfileController');
        Route::apiResource('user-account', 'UserAccountController');
        Route::apiResource('user-account-log', 'UserAccountLogController');

        /**
         * related to notifications features
         */
        Route::apiResource('user-notification-setting', 'UserNotificationSettingController');
        Route::apiResource('user-notification-type', 'UserNotificationTypeController');
        Route::get('user-notification', 'UserNotificationController@index');
        Route::put('user-notification', 'UserNotificationController@update');
        Route::get('user-notification/{id}', 'UserNotificationController@show');

        /**
         * related to systems features settings
         */
        Route::apiResource('tag', 'TagController');
        Route::apiResource('ad-and-slider', 'AdAndSliderController' ,['only' => ['update', 'store', 'destroy']]);
        Route::apiResource('content-module', 'ContentModuleController',  ['only' => ['update', 'store', 'destroy']]);
        Route::apiResource('campaign', 'CampaignController',  ['except' => ['destroy'], 'only' => ['update', 'store']]);
        Route::apiResource('category', 'CategoryController', ['except' => ['destroy'], 'only' => ['update', 'store']]);
        Route::apiResource('sub-category', 'SubCategoryController', ['except' => ['destroy'], 'only' => ['update', 'store']]);
        Route::apiResource('brand', 'BrandController', ['except' => ['destroy'], 'only' => ['update', 'store']]);
        Route::apiResource('app-footer', 'AppFooterController', ['except' => ['destroy'], 'only' => ['update', 'store']]);

        /**
         * related to product features
         */
        Route::apiResource('product', 'ProductController', ['except' => ['destroy'], 'only' => ['update', 'store']]);
        Route::apiResource('product-stock', 'ProductStockController', ['except' => ['destroy'], 'only' => ['update']]);
        Route::apiResource('product-specs-and-state', 'ProductSpecsAndStateController', ['except' => ['destroy'], 'only' => ['store', 'update']]);
        Route::apiResource('product-stock-in-log', 'ProductStockInLogController', ['except' => ['destroy'], 'only' => ['update', 'store']]);
        Route::apiResource('product-stock-out-log', 'ProductStockOutLogController', ['except' => ['destroy']]);
        Route::apiResource('product-offer', 'ProductOfferController',  ['except' => ['destroy'], 'only' => ['update', 'store']]);
        Route::apiResource('product-return-delivery-option', 'ProductReturnAndDeliveryOptionController', ['except' => ['destroy'], 'only' => ['update', 'store']]);
        Route::apiResource('rating-and-review', 'RatingAndReviewController', ['except' => ['destroy'], 'only' => ['update', 'store']]);

        /**
         * related to order features
         */
        Route::apiResource('order-type', 'OrderTypeController');
        Route::apiResource('order', 'OrderController', ['except' => ['destroy']]);
        Route::apiResource('order-detail', 'OrderDetailController', ['only' => ['show', 'index']]);
        Route::apiResource('order-log', 'OrderLogController', ['only' => ['show', 'index']]);
        Route::get('order-report-types', 'OrderReportController@reportTypes');
        Route::apiResource('order-report', 'OrderReportController', ['except' => ['destroy']]);
        Route::apiResource('order-report-comment', 'OrderReportCommentController', ['except' => ['destroy', 'update']]);

        Route::apiResource('order-cashback', 'OrderCashbackController');
        Route::get('order-cashbackable', 'OrderCashbackController@getCashbackAbleOrderLists');

        /**
         * Related to Refund
         */
        Route::apiResource('refund-request', 'RefundRequestController', ['except' => ['destroy', 'update']]);
        Route::apiResource('refund-request-log', 'RefundRequestLogController', ['except' => ['destroy', 'update']]);

        /**
         * related to voucher and reward point
         */
        Route::apiResource('voucher', 'VoucherController');
        Route::apiResource('reward-point', 'RewardPointController');
        Route::apiResource('reward-point-log', 'RewardPointLogController');

        /**
         * related to Message
         */
        Route::apiResource('message', 'MessageController', ['except' => ['update']]);
        Route::apiResource('message-user', 'MessageUserController', ['except' => ['store', 'destroy']]);
        Route::put('message-user-bulk-update-status', 'MessageUserController@bulkUpdate');
        Route::delete('message-user-bulk-destroy', 'MessageUserController@bulkdestroy');
        Route::apiResource('message-post', 'MessagePostController');
        Route::apiResource('message-template', 'MessageTemplateController');

        /**
         * Related to payment
         */
        Route::apiResource('payment-method', 'PaymentMethodController');
        Route::apiResource('payment', 'PaymentController');
        Route::apiResource('payment-item', 'PaymentItemController');
        Route::apiResource('payment-log', 'PaymentLogController', ['only' => ['index', 'show']]);
//        Route::apiResource('payment-transaction', 'PaymentTransactionController');


        /**
         * Related to income and expense
         */
        Route::apiResource('income-category', 'IncomeCategoryController');
        Route::apiResource('income', 'IncomeController');
        Route::apiResource('expense-category', 'ExpenseCategoryController');
        Route::apiResource('expense', 'ExpenseController');

        /**
         * Related to user feedback
         */
        Route::apiResource('feedback', 'FeedbackController');

        /**
         * Related to ReminderService
         */
        Route::apiResource('reminder', 'ReminderController', ['except' => ['update']]);
    });

    Route::apiResource('attachment', 'AttachmentController', ['except' => ['update']]);
    Route::get('attachment-type', 'AttachmentTypeController@index');

    Route::apiResource('customer', 'CustomerController',  ['only' => ['store']]);

    Route::post('login', 'Auth\\LoginController@index');
    Route::get('logout', 'Auth\\LoginController@logout');

    Route::post('resend-pin', 'PasswordResetController@generateResetPin');
    Route::post('password-reset', 'PasswordResetController@resetPassword');

});

