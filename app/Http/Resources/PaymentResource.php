<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class PaymentResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getIdOrUuid(),
            'createdByUserId' => $this->createdByUserId,
            'createdByUser' => $this->when($this->needToInclude($request, 'payment.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),

            'updatedByUserId' => $this->createdByUserId,
            'updatedByUser' => $this->when($this->needToInclude($request, 'payment.updatedByUser'), function () {
                return new UserResource($this->createdByUser);
            }),

            'orderId' => $this->createdByUserId,
            'order' => $this->when($this->needToInclude($request, 'payment.order'), function () {
                return new OrderResource($this->order);
            }),

            'invoice' => $this->invoice,
            'amount' => $this->amount,
            'paid' => $this->paid,
            'due' => $this->due,
            'advance' => $this->advance,
            'status' => $this->status,
            'dueDate' => $this->dueDate,
            'allowedPaymentMethods' => $this->allowedPaymentMethods,
            'created_at' => $this->created_at,
            'updated_at' => $this->udpated_at,
        ];
    }
}
