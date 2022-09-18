<?php

namespace App\Providers;

use App\DbModels\AdAndSlider;
use App\DbModels\Admin;
use App\DbModels\AppFooter;
use App\DbModels\Attachment;
use App\DbModels\Brand;
use App\DbModels\Campaign;
use App\DbModels\Category;
use App\DbModels\ContentModule;
use App\DbModels\Customer;
use App\DbModels\Expense;
use App\DbModels\ExpenseCategory;
use App\DbModels\Feedback;
use App\DbModels\Income;
use App\DbModels\IncomeCategory;
use App\DbModels\MetaAndSlug;
use App\DbModels\Order;
use App\DbModels\OrderDetail;
use App\DbModels\OrderLog;
use App\DbModels\OrderReport;
use App\DbModels\OrderReportComment;
use App\DbModels\OrderReportLog;
use App\DbModels\OrderType;
use App\DbModels\PaymentLog;
use App\DbModels\Message;
use App\DbModels\MessagePost;
use App\DbModels\MessageTemplate;
use App\DbModels\MessageUser;
use App\DbModels\PasswordReset;
use App\DbModels\Payment;
use App\DbModels\PaymentItem;
use App\DbModels\PaymentMethod;
use App\DbModels\PaymentTransaction;
use App\DbModels\Product;
use App\DbModels\ProductOffer;
use App\DbModels\ProductReturnAndDeliveryOption;
use App\DbModels\ProductSpecsAndState;
use App\DbModels\ProductStock;
use App\DbModels\ProductStockOutLog;
use App\DbModels\RatingAndReview;
use App\DbModels\ProductStockInLog;
use App\DbModels\RefundRequestLog;
use App\DbModels\RefundRequest;
use App\DbModels\Role;
use App\DbModels\Staff;
use App\DbModels\SubCategory;
use App\DbModels\User;
use App\DbModels\UserAccount;
use App\DbModels\UserAccountLog;
use App\DbModels\UserAddress;
use App\DbModels\UserNotification;
use App\DbModels\UserNotificationSetting;
use App\DbModels\UserNotificationType;
use App\DbModels\UserProfile;
use App\DbModels\UserRole;
use App\DbModels\Vendor;
use App\Policies\AdAndSlidersPolicy;
use App\Policies\AdminPolicy;
use App\Policies\AppFooterPolicy;
use App\Policies\AttachementPolicy;
use App\Policies\BrandPolicy;
use App\Policies\CampaignPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ContentModulePolicy;
use App\Policies\CustomerPolicy;
use App\Policies\ExpenseCategoryPolicy;
use App\Policies\ExpensePolicy;
use App\Policies\FeedbackPolicy;
use App\Policies\IncomeCategoryPolicy;
use App\Policies\IncomePolicy;
use App\Policies\MetaAndSlugPolicy;
use App\Policies\OrderDetailPolicy;
use App\Policies\OrderLogPolicy;
use App\Policies\OrderPolicy;
use App\Policies\OrderReportCommentPolicy;
use App\Policies\OrderReportLogPolicy;
use App\Policies\OrderReportPolicy;
use App\Policies\OrderTypePolicy;
use App\Policies\MessagePolicy;
use App\Policies\MessagePostPolicy;
use App\Policies\MessageTemplatePolicy;
use App\Policies\MessageUserPolicy;
use App\Policies\PasswordResetPolicy;
use App\Policies\PaymentItemPolicy;
use App\Policies\PaymentLogPolicy;
use App\Policies\PaymentMethodPolicy;
use App\Policies\PaymentPolicy;
use App\Policies\PaymentTransactionPolicy;
use App\Policies\ProductOfferPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ProductReturnAndDeliveryOptionPolicy;
use App\Policies\ProductSpecsAndStatePolicy;
use App\Policies\ProductStockOutLogPolicy;
use App\Policies\RatingAndReviewPolicy;
use App\Policies\ProductStockInLogPolicy;
use App\Policies\ProductStockPolicy;
use App\Policies\RefundRequestLogPolicy;
use App\Policies\RefundRequestPolicy;
use App\Policies\RolePolicy;
use App\Policies\StaffPolicy;
use App\Policies\SubCategoryPolicy;
use App\Policies\UserAccountLogPolicy;
use App\Policies\UserAccountPolicy;
use App\Policies\UserAddressPolicy;
use App\Policies\UserNotificationPolicy;
use App\Policies\UserNotificationSettingPolicy;
use App\Policies\UserNotificationTypePolicy;
use App\Policies\UserPolicy;
use App\Policies\UserProfilePolicy;
use App\Policies\UserRolePolicy;
use App\Policies\VendorPolicy;
use App\Services\Helpers\ScopesHelper;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        UserAddress::class => UserAddressPolicy::class,
        UserRole::class => UserRolePolicy::class,
        Admin::class => AdminPolicy::class,
        Staff::class => StaffPolicy::class,
        Customer::class => CustomerPolicy::class,
        Vendor::class => VendorPolicy::class,
        UserProfile::class => UserProfilePolicy::class,
        ContentModule::class => ContentModulePolicy::class,
        Campaign::class => CampaignPolicy::class,

        AdAndSlider::class => AdAndSlidersPolicy::class,
        //Product Resource Related Policy
        Brand::class => BrandPolicy::class,
        AppFooter::class => AppFooterPolicy::class,
        Category::class => CategoryPolicy::class,
        SubCategory::class => SubCategoryPolicy::class,
        Product::class => ProductPolicy::class,
        ProductSpecsAndState::class => ProductSpecsAndStatePolicy::class,
        ProductStock::class => ProductStockPolicy::class,
        ProductStockOutLog::class => ProductStockOutLogPolicy::class,
        ProductStockInLog::class => ProductStockInLogPolicy::class,
        RatingAndReview::class => RatingAndReviewPolicy::class,
        ProductOffer::class => ProductOfferPolicy::class,
        ProductReturnAndDeliveryOption::class => ProductReturnAndDeliveryOptionPolicy::class,

        // Order Resource Related Policy
        OrderType::class => OrderTypePolicy::class,
        Order::class => OrderPolicy::class,
        OrderDetail::class => OrderDetailPolicy::class,
        OrderLog::class => OrderLogPolicy::class,
        OrderReport::class => OrderReportPolicy::class,
        OrderReportComment::class => OrderReportCommentPolicy::class,

        Attachment::class => AttachementPolicy::class,
        Expense::class => ExpensePolicy::class,
        ExpenseCategory::class => ExpenseCategoryPolicy::class,
        Feedback::class => FeedbackPolicy::class,
        Income::class => IncomePolicy::class,
        IncomeCategory::class => IncomeCategoryPolicy::class,
        Message::class => MessagePolicy::class,
        MessagePost::class => MessagePostPolicy::class,
        MessageTemplate::class => MessageTemplatePolicy::class,
        MessageUser::class => MessageUserPolicy::class,
        PasswordReset::class => PasswordResetPolicy::class,
//        PaymentMethod::class => PaymentMethodPolicy::class,
        Payment::class => PaymentPolicy::class,
        PaymentItem::class => PaymentItemPolicy::class,
        PaymentLog::class => PaymentLogPolicy::class,
        PaymentTransaction::class => PaymentTransactionPolicy::class,
        Role::class => RolePolicy::class,
        UserNotification::class => UserNotificationPolicy::class,
        UserNotificationSetting::class => UserNotificationSettingPolicy::class,
        UserNotificationType::class => UserNotificationTypePolicy::class,
        UserAccount::class => UserAccountPolicy::class,
        UserAccountLog::class => UserAccountLogPolicy::class,

        RefundRequest::class => RefundRequestPolicy::class,
        RefundRequestLog::class => RefundRequestLogPolicy::class,

        MetaAndSlug::class => MetaAndSlugPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::tokensCan(ScopesHelper::allScopes());

        //Passport::routes(null, ['prefix' => 'api/v1/oauth']);
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(15));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
