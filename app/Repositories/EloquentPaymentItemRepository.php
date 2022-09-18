<?php


namespace App\Repositories;


use App\DbModels\PaymentItem;
use App\Repositories\Contracts\PaymentItemRepository;
use App\Services\PaymentServices\PaymentHelper;
use Carbon\Carbon;
use Illuminate\Support\Str;

class EloquentPaymentItemRepository extends EloquentBaseRepository implements PaymentItemRepository
{

    /**
     * @inheritDoc
     */
    public function generateTransaction(array $data)
    {
        if(empty($data['paymentDate'])) {
            $data['paymentDate'] = Carbon::now();
        }

        $data['refId'] = $data['paymentId'] . '-' . Str::random(4);

        $transactionDetails = PaymentHelper::generatePaymentLink($data);

        $data['paymentProcessURL'] = $transactionDetails['GatewayPageURL'];
        $data['status'] = PaymentItem::STATUS_REQUEST;

        return parent::save($data);
    }
}
