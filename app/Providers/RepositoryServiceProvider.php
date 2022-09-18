<?php

namespace App\Providers;

use App\DbModels\AppFooter;
use App\DbModels\Campaign;
use App\DbModels\ContentModule;
use App\DbModels\MetaAndSlug;
use App\DbModels\OrderCashback;
use App\DbModels\PaymentItem;
use App\DbModels\ProductOffer;
use App\DbModels\ProductReturnAndDeliveryOption;
use App\DbModels\ProductSpecsAndState;
use App\DbModels\RefundRequestLog;
use App\DbModels\RefundRequest;
use App\DbModels\Tag;
use App\DbModels\Role;
use App\DbModels\User;
use App\DbModels\Admin;
use App\DbModels\Brand;
use App\DbModels\Order;
use App\DbModels\Staff;
use App\DbModels\Income;
use App\DbModels\UserAccount;
use App\DbModels\UserAccountLog;
use App\DbModels\UserAddress;
use App\DbModels\Vendor;
use App\DbModels\Expense;
use App\DbModels\Message;
use App\DbModels\Payment;
use App\DbModels\Product;
use App\DbModels\Voucher;
use App\DbModels\Category;
use App\DbModels\Customer;
use App\DbModels\Feedback;
use App\DbModels\OrderLog;
use App\DbModels\Reminder;
use App\DbModels\UserRole;
use App\DbModels\OrderType;
use App\DbModels\Attachment;
use App\DbModels\MessagePost;
use App\DbModels\MessageUser;
use App\DbModels\OrderDetail;
use App\DbModels\OrderReport;
use App\DbModels\RewardPoint;
use App\DbModels\SubCategory;
use App\DbModels\UserProfile;
use App\DbModels\AdAndSlider;
use App\DbModels\ProductStock;
use App\DbModels\PasswordReset;
use App\DbModels\PaymentMethod;
use App\DbModels\RatingAndReview;
use App\DbModels\IncomeCategory;
use App\DbModels\PaymentLog;
use App\DbModels\ExpenseCategory;
use App\DbModels\MessageTemplate;
use App\DbModels\RewardPointLog;
use App\DbModels\UserNotification;
use App\DbModels\ProductStockInLog;
use App\DbModels\OrderReportComment;
use App\DbModels\ProductStockOutLog;
use App\DbModels\UserNotificationType;
use App\Repositories\Contracts\AppFooterRepository;
use App\Repositories\Contracts\CampaignRepository;
use App\Repositories\Contracts\ContentModuleRepository;
use App\Repositories\Contracts\MetaAndSlugRepository;
use App\Repositories\Contracts\OrderCashbackRepository;
use App\Repositories\Contracts\PaymentItemRepository;
use App\Repositories\Contracts\ProductOfferRepository;
use App\Repositories\Contracts\ProductReturnAndDeliveryOptionRepository;
use App\Repositories\Contracts\ProductSpecsAndStateRepository;
use App\Repositories\Contracts\RefundRequestLogRepository;
use App\Repositories\Contracts\RefundRequestRepository;
use App\Repositories\Contracts\UserAccountLogRepository;
use App\Repositories\Contracts\UserAccountRepository;
use App\Repositories\Contracts\UserAddressRepository;
use App\Repositories\EloquentAppFooterRepository;
use App\Repositories\EloquentCampaignRepository;
use App\Repositories\EloquentContentModuleRepository;
use App\Repositories\EloquentMetaAndSlugRepository;
use App\Repositories\EloquentOrderCashbackRepository;
use App\Repositories\EloquentPaymentItemRepository;
use App\Repositories\EloquentProductOfferRepository;
use App\Repositories\EloquentProductReturnAndDeliveryOptionRepository;
use App\Repositories\EloquentProductSpecsAndStateRepository;
use App\Repositories\EloquentRefundRequestLogRepository;
use App\Repositories\EloquentRefundRequestRepository;
use App\Repositories\EloquentUserAccountLogRepository;
use App\Repositories\EloquentUserAccountRepository;
use App\Repositories\EloquentUserAddressRepository;
use Illuminate\Support\ServiceProvider;
use App\DbModels\PaymentTransaction;
use App\DbModels\UserNotificationSetting;
use App\Repositories\EloquentTagRepository;
use App\Repositories\EloquentRoleRepository;
use App\Repositories\EloquentUserRepository;
use App\Repositories\Contracts\TagRepository;
use App\Repositories\EloquentAdminRepository;
use App\Repositories\EloquentBrandRepository;
use App\Repositories\EloquentOrderRepository;
use App\Repositories\EloquentStaffRepository;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\EloquentIncomeRepository;
use App\Repositories\EloquentVendorRepository;
use App\Repositories\Contracts\AdminRepository;
use App\Repositories\Contracts\BrandRepository;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\StaffRepository;
use App\Repositories\EloquentExpenseRepository;
use App\Repositories\EloquentMessageRepository;
use App\Repositories\EloquentPaymentRepository;
use App\Repositories\EloquentProductRepository;
use App\Repositories\EloquentVoucherRepository;
use App\Repositories\Contracts\IncomeRepository;
use App\Repositories\Contracts\VendorRepository;
use App\Repositories\EloquentCategoryRepository;
use App\Repositories\EloquentCustomerRepository;
use App\Repositories\EloquentFeedbackRepository;
use App\Repositories\EloquentOrderLogRepository;
use App\Repositories\EloquentReminderRepository;
use App\Repositories\EloquentUserRoleRepository;
use App\Repositories\Contracts\ExpenseRepository;
use App\Repositories\Contracts\MessageRepository;
use App\Repositories\Contracts\PaymentRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\VoucherRepository;
use App\Repositories\EloquentOrderTypeRepository;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\FeedbackRepository;
use App\Repositories\Contracts\OrderLogRepository;
use App\Repositories\Contracts\ReminderRepository;
use App\Repositories\Contracts\UserRoleRepository;
use App\Repositories\EloquentAttachmentRepository;
use App\Repositories\Contracts\OrderTypeRepository;
use App\Repositories\EloquentMessagePostRepository;
use App\Repositories\EloquentMessageUserRepository;
use App\Repositories\EloquentOrderDetailRepository;
use App\Repositories\EloquentOrderReportRepository;
use App\Repositories\EloquentRewardPointRepository;
use App\Repositories\EloquentSubCategoryRepository;
use App\Repositories\EloquentUserProfileRepository;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\EloquentAdAndSliderRepository;
use App\Repositories\EloquentProductStockRepository;
use App\Repositories\Contracts\MessagePostRepository;
use App\Repositories\Contracts\MessageUserRepository;
use App\Repositories\Contracts\OrderDetailRepository;
use App\Repositories\Contracts\OrderReportRepository;
use App\Repositories\Contracts\RewardPointRepository;
use App\Repositories\Contracts\SubCategoryRepository;
use App\Repositories\Contracts\UserProfileRepository;
use App\Repositories\EloquentPasswordResetRepository;
use App\Repositories\EloquentPaymentMethodRepository;
use App\Repositories\EloquentRatingAndReviewRepository;
use App\Repositories\Contracts\AdAndSliderRepository;
use App\Repositories\Contracts\ProductStockRepository;
use App\Repositories\EloquentIncomeCategoryRepository;
use App\Repositories\EloquentPaymentLogRepository;
use App\Repositories\Contracts\PasswordResetRepository;
use App\Repositories\Contracts\PaymentMethodRepository;
use App\Repositories\Contracts\RatingAndReviewRepository;
use App\Repositories\EloquentExpenseCategoryRepository;
use App\Repositories\EloquentMessageTemplateRepository;
use App\Repositories\EloquentRewardPointLogRepository;
use App\Repositories\Contracts\IncomeCategoryRepository;
use App\Repositories\Contracts\PaymentLogRepository;
use App\Repositories\EloquentUserNotificationRepository;
use App\Repositories\Contracts\ExpenseCategoryRepository;
use App\Repositories\Contracts\MessageTemplateRepository;
use App\Repositories\Contracts\RewardPointLogRepository;
use App\Repositories\EloquentProductStockInLogRepository;
use App\Repositories\Contracts\UserNotificationRepository;
use App\Repositories\EloquentOrderReportCommentRepository;
use App\Repositories\EloquentProductStockOutLogRepository;
use App\Repositories\Contracts\ProductStockInLogRepository;
use App\Repositories\Contracts\OrderReportCommentRepository;
use App\Repositories\Contracts\ProductStockOutLogRepository;
use App\Repositories\EloquentUserNotificationTypeRepository;
use App\Repositories\Contracts\UserNotificationTypeRepository;
use App\Repositories\EloquentPaymentTransactionRepository;
use App\Repositories\EloquentUserNotificationSettingRepository;
use App\Repositories\Contracts\PaymentTransactionRepository;
use App\Repositories\Contracts\UserNotificationSettingRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // bind UserRepository
        $this->app->bind(UserRepository::class, function() {
            return new EloquentUserRepository(new User());
        });

        // bind RoleRepository
        $this->app->bind(RoleRepository::class, function() {
            return new EloquentRoleRepository(new Role());
        });

        // bind UserRoleRepository
        $this->app->bind(UserRoleRepository::class, function() {
            return new EloquentUserRoleRepository(new UserRole());
        });

        // bind AdminRepository
        $this->app->bind(AdminRepository::class, function() {
            return new EloquentAdminRepository(new Admin());
        });

        // bind StaffRepository
        $this->app->bind(StaffRepository::class, function() {
            return new EloquentStaffRepository(new Staff());
        });

        // bind CustomerRepository
        $this->app->bind(CustomerRepository::class, function() {
            return new EloquentCustomerRepository(new Customer());
        });

        // bind VendorRepository
        $this->app->bind(VendorRepository::class, function() {
            return new EloquentVendorRepository(new Vendor());
        });

        // bind UserNotificationSettingRepository
        $this->app->bind(UserNotificationSettingRepository::class, function() {
            return new EloquentUserNotificationSettingRepository(new UserNotificationSetting());
        });

        // bind UserProfileRepository
        $this->app->bind(UserProfileRepository::class, function() {
            return new EloquentUserProfileRepository(new UserProfile());
        });

        // bind AttachmentRepository
        $this->app->bind(AttachmentRepository::class, function() {
            return new EloquentAttachmentRepository(new Attachment());
        });

        // bind UserNotificationTypeRepository
        $this->app->bind(UserNotificationTypeRepository::class, function() {
            return new EloquentUserNotificationTypeRepository(new UserNotificationType());
        });

        // bind UserNotificationRepository
        $this->app->bind(UserNotificationRepository::class, function() {
            return new EloquentUserNotificationRepository(new UserNotification());
        });

        // bind PasswordResetRepository
        $this->app->bind(PasswordResetRepository::class, function() {
            return new EloquentPasswordResetRepository(new PasswordReset());
        });

        // bind MessageRepository
        $this->app->bind(MessageRepository::class, function() {
            return new EloquentMessageRepository(new Message());
        });

        // bind MessageUserRepository
        $this->app->bind(MessageUserRepository::class, function() {
            return new EloquentMessageUserRepository(new MessageUser());
        });

        // bind MessagePostRepository
        $this->app->bind(MessagePostRepository::class, function() {
            return new EloquentMessagePostRepository(new MessagePost());
        });

        // bind MessageTemplateRepository
        $this->app->bind(MessageTemplateRepository::class, function() {
            return new EloquentMessageTemplateRepository(new MessageTemplate());
        });

        // bind IncomeCategoryRepository
        $this->app->bind(IncomeCategoryRepository::class, function() {
            return new EloquentIncomeCategoryRepository(new IncomeCategory());
        });

        // bind IncomeRepository
        $this->app->bind(IncomeRepository::class, function() {
            return new EloquentIncomeRepository(new Income());
        });

        // bind ExpenseCategoryRepository
        $this->app->bind(ExpenseCategoryRepository::class, function() {
            return new EloquentExpenseCategoryRepository(new ExpenseCategory());
        });

        // bind ExpenseRepository
        $this->app->bind(ExpenseRepository::class, function() {
            return new EloquentExpenseRepository(new Expense());
        });

        // bind FeedbackRepository
        $this->app->bind(FeedbackRepository::class, function() {
            return new EloquentFeedbackRepository(new Feedback());
        });

        // bind PaymentMethodRepository
        $this->app->bind(PaymentMethodRepository::class, function() {
            return new EloquentPaymentMethodRepository(new PaymentMethod());
        });

        // bind PaymentRepository
        $this->app->bind(PaymentRepository::class, function() {
            return new EloquentPaymentRepository(new Payment());
        });

        // bind PaymentItemRepository
        $this->app->bind(PaymentItemRepository::class, function() {
            return new EloquentPaymentItemRepository(new PaymentItem());
        });


        // bind PaymentItemLogRepository
        $this->app->bind(PaymentLogRepository::class, function() {
            return new EloquentPaymentLogRepository(new PaymentLog());
        });

        // bind PaymentItemTransactionRepository
        $this->app->bind(PaymentTransactionRepository::class, function() {
            return new EloquentPaymentTransactionRepository(new PaymentTransaction());
        });

        // bind ReminderRepository
        $this->app->bind(ReminderRepository::class, function() {
            return new EloquentReminderRepository(new Reminder());
        });


        // bind CategoryRepository
        $this->app->bind(CategoryRepository::class, function() {
            return new EloquentCategoryRepository(new Category());
        });

        // bind BrandRepository
        $this->app->bind(BrandRepository::class, function() {
            return new EloquentBrandRepository(new Brand());
        });

        // bind ProductRepository
        $this->app->bind(ProductRepository::class, function() {
            return new EloquentProductRepository(new Product());
        });

        // bind TagRepository
        $this->app->bind(TagRepository::class, function() {
            return new EloquentTagRepository(new Tag());
        });

        // bind OrderTypeRepository
        $this->app->bind(OrderTypeRepository::class, function() {
            return new EloquentOrderTypeRepository(new OrderType());
        });

              // bind OrderRepository
        $this->app->bind(OrderRepository::class, function() {
            return new EloquentOrderRepository(new Order());
        });

        // bind OrderDetailRepository
        $this->app->bind(OrderDetailRepository::class, function() {
            return new EloquentOrderDetailRepository(new OrderDetail());
        });

        // bind OrderLogRepository
        $this->app->bind(OrderLogRepository::class, function() {
            return new EloquentOrderLogRepository(new OrderLog());
        });

        // bind OrderReportRepository
        $this->app->bind(OrderReportRepository::class, function() {
            return new EloquentOrderReportRepository(new OrderReport());
        });

        // bind VoucherRepository
        $this->app->bind(VoucherRepository::class, function() {
            return new EloquentVoucherRepository(new Voucher());
        });

        // bind RewardPointRepository
        $this->app->bind(RewardPointRepository::class, function() {
            return new EloquentRewardPointRepository(new RewardPoint());
        });

        // bind UserPointUseLogRepository
        $this->app->bind(RewardPointLogRepository::class, function() {
            return new EloquentRewardPointLogRepository(new RewardPointLog());
        });

        // bind OrderReportCommentRepository
        $this->app->bind(OrderReportCommentRepository::class, function() {
            return new EloquentOrderReportCommentRepository(new OrderReportComment());
        });

        // bind OrderCashbackRepository
        $this->app->bind(OrderCashbackRepository::class, function() {
            return new EloquentOrderCashbackRepository(new OrderCashback());
        });

        // bind ProductStockRepository
        $this->app->bind(ProductStockRepository::class, function() {
            return new EloquentProductStockRepository(new ProductStock());
        });

        // bind ProductStockInLogRepository
        $this->app->bind(ProductStockInLogRepository::class, function() {
            return new EloquentProductStockInLogRepository(new ProductStockInLog());
        });

        // bind ProductStockInLogRepository
        $this->app->bind(ProductStockOutLogRepository::class, function() {
            return new EloquentProductStockOutLogRepository(new ProductStockOutLog());
        });

        //bind ProductReviewRepository
        $this->app->bind(RatingAndReviewRepository::class, function (){
            return new EloquentRatingAndReviewRepository(new RatingAndReview());
        });

        //bind SubCategoryRepository
        $this->app->bind(SubCategoryRepository::class, function (){
            return new EloquentSubCategoryRepository(new SubCategory());
        });

        //bind AdAndSlidersRepository
        $this->app->bind(AdAndSliderRepository::class, function (){
            return new EloquentAdAndSliderRepository(new AdAndSlider());
        });

        //bind ProductSpecsAndStateRepository
        $this->app->bind(ProductSpecsAndStateRepository::class, function (){
            return new EloquentProductSpecsAndStateRepository(new ProductSpecsAndState());
        });

        //bind ProductReturnAndDeliveryOptionRepository
        $this->app->bind(ProductReturnAndDeliveryOptionRepository::class, function (){
            return new EloquentProductReturnAndDeliveryOptionRepository(new ProductReturnAndDeliveryOption());
        });

        //bind ProductOfferRepository
        $this->app->bind(ProductOfferRepository::class, function (){
            return new EloquentProductOfferRepository(new ProductOffer());
        });

        //bind ContentModuleRepository
        $this->app->bind(ContentModuleRepository::class, function (){
            return new EloquentContentModuleRepository(new ContentModule());
        });

        //bind CampaignRepository
        $this->app->bind(CampaignRepository::class, function (){
            return new EloquentCampaignRepository(new Campaign());
        });

        //bind RefundRequestRepository
        $this->app->bind(RefundRequestRepository::class, function (){
            return new EloquentRefundRequestRepository(new RefundRequest());
        });

        //bind CampaignRepository
        $this->app->bind(RefundRequestLogRepository::class, function (){
            return new EloquentRefundRequestLogRepository(new RefundRequestLog());
        });

        //bind UserAccountRepository
        $this->app->bind(UserAccountRepository::class, function (){
            return new EloquentUserAccountRepository(new UserAccount());
        });

        //bind UserAccountLogRepository
        $this->app->bind(UserAccountLogRepository::class, function (){
            return new EloquentUserAccountLogRepository(new UserAccountLog());
        });

        //bind AppFooterRepository
        $this->app->bind(AppFooterRepository::class, function (){
            return new EloquentAppFooterRepository(new AppFooter());
        });

        //bind MetaAndSlugRepository
        $this->app->bind(MetaAndSlugRepository::class, function (){
            return new EloquentMetaAndSlugRepository(new MetaAndSlug());
        });

        //bind UserAddressRepository
        $this->app->bind(UserAddressRepository::class, function (){
            return new EloquentUserAddressRepository(new UserAddress());
        });
    }
}
