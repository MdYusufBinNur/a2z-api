<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class RefundRequestResource extends Resource
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
            'createdByUser' => $this->when($this->needToInclude($request, 'refundRequest.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),

            'orderId' => $this->orderId,
            'order' => $this->when($this->needToInclude($request, 'refundRequest.order'), function () {
                return new OrderResource($this->order);
            }),

            'paymentId' => $this->paymentId,
            'payment' => $this->when($this->needToInclude($request, 'refundRequest.payment'), function () {
                return new PaymentResource($this->payment);
            }),

            'refundRequestLogs' => $this->when($this->needToInclude($request, 'refundRequest.refundRequestLogs'), function () {
                return new RefundRequestLogResourceCollection($this->refundRequestLogs);
            }),

            'amount' => $this->amount,
            'paymentLogs' => $this->paymentLogs,
            'status' => $this->status,
            'comment' => $this->comment,

            'requestPaymentMethod'  => $this->requestPaymentMethod,

            'updatedByUserId' => $this->updatedByUserId,
            'updatedByUser' => $this->when($this->needToInclude($request, 'refundRequest.updatedByUser'), function () {
                return new UserResource($this->updatedByUser);
            }),

            'assignedToUserId' => $this->assignedToUserId,
            'assignedToUser' => $this->when($this->needToInclude($request, 'refundRequest.assignedToUser'), function () {
                return new UserResource($this->assignedToUser);
            }),
        ];
    }
}
