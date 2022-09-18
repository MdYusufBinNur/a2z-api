<?php

namespace App\Http\Resources;


class PaymentLogResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getIdOrUuid(),
            'status' => $this->status,
            'paid' => $this->paid,
            'event' => $this->event,
            'due' => $this->due,
            'advance' => $this->advance,
            'note' => $this->note,

            'createdByUserId' => $this->createdByUserId,
            'createdByUser' => $this->when($this->needToInclude($request, 'paymentLog.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),

            'paymentId' => $this->payment,
            'payment' => $this->when($this->needToInclude($request, 'paymentLog.payment'), function () {
                return new PaymentResource($this->payment);
            }),

            'paymentTransactionId' => $this->paymentTransactionId,
            'paymentTransaction' => $this->when($this->needToInclude($request, 'paymentLog.paymentTransactionId'), function () {
                return new PaymentTransactionResource($this->paymentTransaction);
            }),

            'paymentMethodId' => $this->paymentMethodId,
            'paymentMethod' => $this->when($this->needToInclude($request, 'paymentLog.paymentMethod'), function () {
                return new PaymentResource($this->paymentMethod);
            }),

            'cashReceivedById' => $this->cashReceivedById,
            'cashReceivedBy' => $this->when($this->needToInclude($request, 'paymentLog.cashReceivedById'), function () {
                return new UserResource($this->cashReceivedBy);
            }),

            'updatedByUserId' => $this->updatedByUserId,
            'updatedByUser' => $this->when($this->needToInclude($request, 'paymentLog.updatedByUser'), function () {
                return new UserResource($this->updatedByUser);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
