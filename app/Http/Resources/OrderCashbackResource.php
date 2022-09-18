<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class OrderCashbackResource extends Resource
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
            'orderDetailId' => $this->orderDetailId,
            'orderDetail' => $this->when($this->needToInclude($request, 'oc.orderDetail'), function () {
                return new OrderDetailResource($this->orderDetail);
            }),
            'userAccountId' => $this->userAccountId,
            'userAccount' => $this->when($this->needToInclude($request, 'oc.userAccount'), function () {
                return new UserAccountResource($this->userAccount);
            }),
            'cashbackAmount' => $this->cashbackAmount,
            'createdByUserId' => $this->createdByUserId,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
