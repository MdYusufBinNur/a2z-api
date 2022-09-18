<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;

class OrderResource extends Resource
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
            'invoice' => $this->invoice,
            'status' => $this->status,
            'amount' => $this->amount,
            'discount' => $this->discount,
            'address' => $this->address,
            'phone' => $this->phone,
            'paymentStatus' => $this->paymentStatus,
            'isPayable' => $this->isPayable(),
            'isRefundable' => $this->isRefundable(),
            'isCancelable' => $this->isCancelable(),
            'canLeaveReview' => $this->canLeaveReview(),
            'canMarkAsDelivered' => $this->canMarkAsDelivered(),

            'orderProducts' => $this->when($this->needToInclude($request, 'order.orderProducts'), function () {
                return new OrderDetailResourceCollection($this->orderDetails);
            }),

            'orderLogs' => $this->when($this->needToInclude($request, 'order.orderLogs'), function () {
                return new OrderLogResourceCollection($this->orderLogs);
            }),

            'orderReports' => $this->when($this->needToInclude($request, 'order.orderReports'), function () {
                return new OrderReportResourceCollection($this->orderReports);
            }),

            'voucherId' => $this->voucherId,
            'voucher' => $this->when($this->needToInclude($request, 'order.voucher'), function () {
                return new VoucherResource($this->voucher);
            }),

            'vendorId' => $this->vendorId,
            'vendor' => $this->when($this->needToInclude($request, 'order.vendor'), function () {
                return new VendorResource($this->vendor);
            }),

            'orderTypeId' => $this->orderTypeId,
            'orderType' => $this->when($this->needToInclude($request, 'order.orderType'), function () {
                return new OrderTypeResource($this->orderType);
            }),

            'createdByUserId' => $this->createdByUserId,
            'createdByUser' => $this->when($this->needToInclude($request, 'order.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),

            'assignedToUserId' => $this->assignedToUserId, //User Id
            'assignedToUser' => $this->when($this->needToInclude($request, 'order.assignedToUser'), function () {
                return new UserResource($this->assignedToUser);
            }),

            'payment' => new PaymentResource($this->payment),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
