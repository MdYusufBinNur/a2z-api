<?php


namespace App\Repositories;


use App\Repositories\Contracts\PaymentLogRepository;

class EloquentPaymentLogRepository extends EloquentBaseRepository implements PaymentLogRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['pil.createdByUser' => 'createdByUser', 'pil.property' => 'property',  'pil.payment' => 'payment', 'pil.updatedByUser' => 'updatedByUser','pil.paymentInstallmentItem' => 'paymentInstallmentItem', 'pil.paymentItemPartial' => 'paymentItemPartial'];

        return parent::findBy($searchCriteria, $withTrashed);
    }
}
