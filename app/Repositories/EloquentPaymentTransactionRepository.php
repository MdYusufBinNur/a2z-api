<?php


namespace App\Repositories;


use App\DbModels\Order;
use App\DbModels\Payment;
use App\DbModels\PaymentTransaction;
use App\Events\OrderLog\OrderLogCreatedEvent;
use App\Events\PaymentLog\PaymentLogCreatedEvent;
use App\Events\PaymentTransaction\PaymentTransactionCreatedEvent;
use App\Repositories\Contracts\OrderLogRepository;
use App\Repositories\Contracts\PaymentLogRepository;
use App\Repositories\Contracts\PaymentTransactionRepository;
use Illuminate\Support\Facades\DB;

class EloquentPaymentTransactionRepository extends EloquentBaseRepository implements PaymentTransactionRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['pit.paymentItem' => 'paymentItem', 'pit.property' => 'property'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function aamarpaySuccessfulPayment(array $data): array
    {
        $paymentTransactionProviderData['paymentId'] = $data['opt_b'];
        $paymentTransactionProviderData['providerName'] = $data['opt_d'];
        $paymentTransactionProviderData['status'] = PaymentTransaction::STATUS_SUCCESS;
        $paymentTransactionProviderData['sourceURL'] = $data['ip_address'];
        $paymentTransactionProviderData['paymentProcessURL'] = $data['pg_txnid'];
        $paymentTransactionProviderData['rawData'] = json_encode($data);

        $paymentTransaction = $this->model->create($paymentTransactionProviderData);

        if($paymentTransaction instanceof PaymentTransaction) {
            DB::beginTransaction();

            $providerData = json_decode($paymentTransaction->rawData);
            $payment = $paymentTransaction->payment;

            $paymentLogData['paymentId'] = $paymentTransaction->paymentId;
            $paymentLogData['paymentTransactionId'] = $paymentTransaction->id;
            $paymentLogData['paymentMethod'] = $providerData->card_type;
            $paymentLogData['createdByUserId'] = $payment->createdByUserId;

            $due = $payment->due;
            $advance = $payment->advance;

            if($due == $providerData->amount) {
                $paymentStatus = Payment::STATUS_PAID;
                $due = 0;
            } else if ($due > $providerData->amount) {
                $paymentStatus = Payment::STATUS_PARTIAL;
                $due = $due - $providerData->amount;
            } else {
                $paymentStatus = Payment::STATUS_PAID;
                $due = 0;
                $advance = $providerData->amount - $due;
            }

            $paymentLogData['status'] = $paymentStatus;
            $paymentLogData['paid'] = $providerData->amount;
            $paymentLogData['due'] = $due;
            $paymentLogData['advance'] = $advance;
            $paymentLogData['note'] = 'Thank you for payment ' . $providerData->amount . ' taka for the invoice ' . $payment->invoice;

            $paymentLogRepository = app(PaymentLogRepository::class);
            $paymentLog = $paymentLogRepository->save($paymentLogData);

            $orderLog['orderId'] = $payment->orderId;
            $orderLog['status'] = Order::STATUS_PENDING;
            $orderLog['comments'] = 'Tk. ' . $paymentLog->paid . ' payment received by ' . config('app.name') . '. Pay by Customer';

            $orderLogRepository = app(OrderLogRepository::class);
            $orderLog = $orderLogRepository->save($orderLog);

            Db::commit();

            event(new PaymentLogCreatedEvent($paymentLog, $this->generateEventOptionsForModel()));
            event(new OrderLogCreatedEvent($orderLog, $paymentLog->status, $this->generateEventOptionsForModel()));

            return ['message' => 'payment transaction success', 'invoice' => $payment->invoice];
        }

        return ['message' => 'payment transaction failed', 'invoice' => $data['opt_a']];
    }

    /**
     * @inheritDoc
     */
    public function aamarpayFailedPayment(array $data): array
    {
        $paymentTransactionData['paymentId'] = $data['opt_b'];
        $paymentTransactionData['providerName'] = $data['opt_d'];
        $paymentTransactionData['status'] = PaymentTransaction::STATUS_FAILED;
        $paymentTransactionData['sourceURL'] = $data['ip_address'];
        $paymentTransactionData['paymentProcessURL'] = $data['pg_txnid'];
        $paymentTransactionData['rawData'] = json_encode($data);

        $this->model->create($paymentTransactionData);

        return ['message' => 'payment transaction failed'];
    }

}
