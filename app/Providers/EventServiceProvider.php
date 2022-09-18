<?php

namespace App\Providers;

use App\Events\Admin\AdminCreatedEvent;
use App\Events\Admin\AdminUpdatedEvent;

use App\Events\Expense\ExpenseCreatedEvent;
use App\Events\Expense\ExpenseUpdatedEvent;
use App\Events\ExpenseCategory\ExpenseCategoryCreatedEvent;
use App\Events\ExpenseCategory\ExpenseCategoryUpdatedEvent;

use App\Events\Feedback\FeedbackCreatedEvent;
use App\Events\Feedback\FeedbackDeletedEvent;
use App\Events\Income\IncomeCreatedEvent;
use App\Events\Income\IncomeUpdatedEvent;
use App\Events\IncomeCategory\IncomeCategoryCreatedEvent;
use App\Events\IncomeCategory\IncomeCategoryUpdatedEvent;

use App\Events\Message\MessageCreatedEvent;
use App\Events\MessagePost\MessagePostCreatedEvent;
use App\Events\MessagePost\MessagePostUpdatedEvent;
use App\Events\MessageTemplate\MessageTemplateCreatedEvent;
use App\Events\MessageTemplate\MessageTemplateUpdatedEvent;
use App\Events\MessageUser\MessageUserCreatedEvent;
use App\Events\MessageUser\MessageUserUpdatedEvent;

use App\Events\Order\OrderCreatedEvent;
use App\Events\Order\OrderUpdatedEvent;
use App\Events\OrderCashback\OrderCashbackCreatedEvent;
use App\Events\OrderLog\OrderLogCreatedEvent;
use App\Events\OrderReport\OrderReportCreatedEvent;
use App\Events\OrderReportComment\OrderReportCommentCreatedEvent;
use App\Events\PasswordReset\PasswordResetEvent;
use App\Events\Payment\PaymentCreatedEvent;
use App\Events\Payment\PaymentUpdatedEvent;
use App\Events\PaymentLog\PaymentLogCreatedEvent;
use App\Events\PaymentLog\PaymentLogUpdatedEvent;
use App\Events\PaymentMethod\PaymentMethodCreatedEvent;
use App\Events\PaymentMethod\PaymentMethodUpdatedEvent;
use App\Events\PaymentTransaction\PaymentTransactionCreatedEvent;

use App\Events\Attachment\AttachmentCreatedEvent;

use App\Events\Product\ProductCreatedEvent;
use App\Events\ProductStockOutLog\ProductStockOutLogCreatedEvent;
use App\Events\RefundRequest\RefundRequestCreatedEvent;
use App\Events\RefundRequest\RefundRequestUpdatedEvent;
use App\Events\Reminder\ReminderCreatedEvent;

use App\Events\Role\RoleCreatedEvent;
use App\Events\Role\RoleUpdatedEvent;

use App\Events\User\UserCreatedEvent;
use App\Events\User\UserLoggedInEvent;
use App\Events\User\UserUpdatedEvent;
use App\Events\UserAccountLog\UserAccountLogCreatedEvent;
use App\Events\UserNotification\UserNotificationCreatedEvent;
use App\Events\UserNotification\UserNotificationUpdatedEvent;
use App\Events\UserNotificationSetting\UserNotificationSettingCreatedEvent;
use App\Events\UserNotificationSetting\UserNotificationSettingUpdatedEvent;
use App\Events\UserNotificationType\UserNotificationTypeCreatedEvent;
use App\Events\UserNotificationType\UserNotificationTypeUpdatedEvent;
use App\Events\UserProfile\UserProfileCreatedEvent;
use App\Events\UserProfile\UserProfileUpdatedEvent;

use App\Events\UserRole\UserRoleCreatedEvent;
use App\Events\UserRole\UserRoleUpdatedEvent;

use App\Listeners\Admin\HandleAdminCreatedEvent;
use App\Listeners\Admin\HandleAdminUpdatedEvent;

use App\Listeners\Expense\HandleExpenseCreatedEvent;
use App\Listeners\Expense\HandleExpenseUpdatedEvent;
use App\Listeners\ExpenseCategory\HandleExpenseCategoryCreatedEvent;
use App\Listeners\ExpenseCategory\HandleExpenseCategoryUpdatedEvent;
use App\Listeners\Feedback\HandleFeedbackCreatedEvent;
use App\Listeners\Feedback\HandleFeedbackDeletedEvent;
use App\Listeners\Income\HandleIncomeCreatedEvent;
use App\Listeners\Income\HandleIncomeUpdatedEvent;
use App\Listeners\IncomeCategory\HandleIncomeCategoryCreatedEvent;
use App\Listeners\IncomeCategory\HandleIncomeCategoryUpdatedEvent;
use App\Listeners\Message\HandleMessageCreatedEvent;
use App\Listeners\MessagePost\HandleMessagePostCreatedEvent;
use App\Listeners\MessagePost\HandleMessagePostUpdatedEvent;
use App\Listeners\MessageTemplate\HandleMessageTemplateCreatedEvent;
use App\Listeners\MessageTemplate\HandleMessageTemplateUpdatedEvent;
use App\Listeners\MessageUser\HandleMessageUserCreatedEvent;
use App\Listeners\MessageUser\HandleMessageUserUpdatedEvent;
use App\Listeners\Order\HandleOrderCreatedEvent;
use App\Listeners\Order\HandleOrderUpdatedEvent;
use App\Listeners\OrderCashback\HandleOrderCashbackCreatedEvent;
use App\Listeners\OrderLog\HandleOrderLogCreatedEvent;
use App\Listeners\OrderReport\HandleOrderReportCreatedEvent;
use App\Listeners\OrderReportComment\HandleOrderReportCommentCreatedEvent;
use App\Listeners\PasswordReset\HandlePasswordResetEvent;
use App\Listeners\Payment\HandlePaymentCreatedEvent;
use App\Listeners\Payment\HandlePaymentUpdatedEvent;
use App\Listeners\PaymentLog\HandlePaymentLogCreatedEvent;
use App\Listeners\PaymentLog\HandlePaymentLogUpdatedEvent;
use App\Listeners\PaymentMethod\HandlePaymentMethodCreatedEvent;
use App\Listeners\PaymentMethod\HandlePaymentMethodUpdatedEvent;
use App\Listeners\PaymentTransaction\HandlePaymentTransactionCreatedEvent;

use App\Listeners\Attachment\HandleAttachmentCreatedEvent;

use App\Listeners\Product\HandleProductCreatedEvent;
use App\Listeners\ProductStockOutLog\HandleProductStockOutLogCreatedEvent;
use App\Listeners\RefundRequest\HandleRefundRequestCreatedEvent;
use App\Listeners\RefundRequest\HandleRefundRequestUpdatedEvent;
use App\Listeners\Reminder\HandleReminderCreatedEvent;

use App\Listeners\Role\HandleRoleCreatedEvent;
use App\Listeners\Role\HandleRoleUpdatedEvent;
use App\Listeners\User\HandleUserCreatedEvent;
use App\Listeners\User\HandleUserLoggedInEvent;
use App\Listeners\User\HandleUserUpdatedEvent;
use App\Listeners\UserAccountLog\HandleUserAccountLogCreatedEvent;
use App\Listeners\UserNotification\HandleUserNotificationCreatedEvent;
use App\Listeners\UserNotification\HandleUserNotificationUpdatedEvent;
use App\Listeners\UserNotificationType\HandleUserNotificationTypeCreatedEvent;
use App\Listeners\UserNotificationType\HandleUserNotificationTypeUpdatedEvent;
use App\Listeners\UserProfile\HandleUserProfileCreatedEvent;
use App\Listeners\UserProfile\HandleUserProfileUpdatedEvent;

use App\Listeners\UserRole\HandleUserRoleCreatedEvent;
use App\Listeners\UserRole\HandleUserRoleUpdatedEvent;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        AdminCreatedEvent::class => [
            HandleAdminCreatedEvent::class
        ],
        AdminUpdatedEvent::class => [
            HandleAdminUpdatedEvent::class
        ],

        AttachmentCreatedEvent::class => [
            HandleAttachmentCreatedEvent::class
        ],

        ExpenseCreatedEvent::class => [
            HandleExpenseCreatedEvent::class
        ],
        ExpenseUpdatedEvent::class => [
            HandleExpenseUpdatedEvent::class
        ],
        ExpenseCategoryCreatedEvent::class => [
            HandleExpenseCategoryCreatedEvent::class
        ],
        ExpenseCategoryUpdatedEvent::class => [
            HandleExpenseCategoryUpdatedEvent::class
        ],

        FeedbackCreatedEvent::class => [
            HandleFeedbackCreatedEvent::class
        ],
        FeedbackDeletedEvent::class => [
            HandleFeedbackDeletedEvent::class
        ],


        IncomeCreatedEvent::class => [
            HandleIncomeCreatedEvent::class
        ],
        IncomeUpdatedEvent::class => [
            HandleIncomeUpdatedEvent::class
        ],
        IncomeCategoryCreatedEvent::class => [
            HandleIncomeCategoryCreatedEvent::class
        ],
        IncomeCategoryUpdatedEvent::class => [
            HandleIncomeCategoryUpdatedEvent::class
        ],

        MessageCreatedEvent::class => [
            HandleMessageCreatedEvent::class
        ],
        MessagePostCreatedEvent::class => [
            HandleMessagePostCreatedEvent::class
        ],
        MessagePostUpdatedEvent::class => [
            HandleMessagePostUpdatedEvent::class
        ],
        MessageTemplateCreatedEvent::class => [
            HandleMessageTemplateCreatedEvent::class
        ],
        MessageTemplateUpdatedEvent::class => [
            HandleMessageTemplateUpdatedEvent::class
        ],
        MessageUserCreatedEvent::class => [
            HandleMessageUserCreatedEvent::class
        ],
        MessageUserUpdatedEvent::class => [
            HandleMessageUserUpdatedEvent::class
        ],


        OrderCreatedEvent::class => [
            HandleOrderCreatedEvent::class
        ],
        OrderUpdatedEvent::class => [
            HandleOrderUpdatedEvent::class
        ],
        OrderLogCreatedEvent::class => [
            HandleOrderLogCreatedEvent::class
        ],

        OrderReportCreatedEvent::class => [
            HandleOrderReportCreatedEvent::class
        ],
        OrderReportCommentCreatedEvent::class => [
            HandleOrderReportCommentCreatedEvent::class
        ],
        OrderCashbackCreatedEvent::class => [
            HandleOrderCashbackCreatedEvent::class
        ],


        PasswordResetEvent::class => [
            HandlePasswordResetEvent::class
        ],

        PaymentMethodCreatedEvent::class => [
            HandlePaymentMethodCreatedEvent::class
        ],
        PaymentMethodUpdatedEvent::class => [
            HandlePaymentMethodUpdatedEvent::class
        ],
        PaymentTransactionCreatedEvent::class => [
            HandlePaymentTransactionCreatedEvent::class
        ],
        PaymentCreatedEvent::class => [
            HandlePaymentCreatedEvent::class
        ],
        PaymentUpdatedEvent::class => [
            HandlePaymentUpdatedEvent::class
        ],
        PaymentLogCreatedEvent::class => [
            HandlePaymentLogCreatedEvent::class
        ],
        PaymentLogUpdatedEvent::class => [
            HandlePaymentLogUpdatedEvent::class
        ],

        RoleCreatedEvent::class => [
            HandleRoleCreatedEvent::class
        ],
        RoleUpdatedEvent::class => [
            HandleRoleUpdatedEvent::class
        ],

        ReminderCreatedEvent::class => [
            HandleReminderCreatedEvent::class
        ],

        RefundRequestCreatedEvent::class => [
            HandleRefundRequestCreatedEvent::class
        ],

        RefundRequestUpdatedEvent::class => [
            HandleRefundRequestUpdatedEvent::class
        ],

        UserCreatedEvent::class => [
            HandleUserCreatedEvent::class
        ],
        UserUpdatedEvent::class => [
            HandleUserUpdatedEvent::class
        ],
        UserLoggedInEvent::class => [
            HandleUserLoggedInEvent::class
        ],
        UserAccountLogCreatedEvent::class => [
            HandleUserAccountLogCreatedEvent::class
        ],

        UserNotificationSettingCreatedEvent::class => [
            UserNotificationSettingCreatedEvent::class
        ],
        UserNotificationSettingUpdatedEvent::class => [
            UserNotificationSettingUpdatedEvent::class
        ],
        UserNotificationTypeCreatedEvent::class => [
            HandleUserNotificationTypeCreatedEvent::class
        ],
        UserNotificationTypeUpdatedEvent::class => [
            HandleUserNotificationTypeUpdatedEvent::class
        ],
        UserNotificationCreatedEvent::class => [
            HandleUserNotificationCreatedEvent::class
        ],
        UserNotificationUpdatedEvent::class => [
            HandleUserNotificationUpdatedEvent::class
        ],
        UserProfileCreatedEvent::class => [
            HandleUserProfileCreatedEvent::class
        ],
        UserProfileUpdatedEvent::class => [
            HandleUserProfileUpdatedEvent::class
        ],

        UserRoleCreatedEvent::class => [
            HandleUserRoleCreatedEvent::class
        ],
        UserRoleUpdatedEvent::class => [
            HandleUserRoleUpdatedEvent::class
        ],

        ProductCreatedEvent::class => [
            HandleProductCreatedEvent::class
        ],

        ProductStockOutLogCreatedEvent::class => [
            HandleProductStockOutLogCreatedEvent::class
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
