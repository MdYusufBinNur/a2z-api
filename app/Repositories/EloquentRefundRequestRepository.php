<?php


namespace App\Repositories;


use App\DbModels\RefundRequest;
use App\Events\RefundRequest\RefundRequestCreatedEvent;
use App\Repositories\Contracts\RefundRequestRepository;
use ArrayAccess;

class EloquentRefundRequestRepository extends EloquentBaseRepository implements RefundRequestRepository
{
    /**
     * @param array $data
     * @return ArrayAccess
     */
    public function save(array $data): ArrayAccess
    {
        $refundRequestMethod = isset($data['requestPaymentMethod']) ? $data['requestPaymentMethod'] : RefundRequest::PAYMENT_METHOD_DEFAULT;

        $data['status'] = isset($data['status']) ? $data['status'] : RefundRequest::STATUS_REQUEST;
        $data['requestPaymentMethod'] = isset($data['requestPaymentMethod']) ? $data['requestPaymentMethod'] : RefundRequest::PAYMENT_METHOD_DEFAULT;
        $data['comment'] = isset($data['comment']) ? $data['comment'] : 'Refund in ' . $refundRequestMethod . ' requested by customer';;

        $refundRequest = parent::save($data);

        event(new RefundRequestCreatedEvent($refundRequest, $this->generateEventOptionsForModel()));

        return $refundRequest;
    }
}
