<?php

namespace App\Http\Resources;


use App\DbModels\Order;
use App\DbModels\Payment;
use App\DbModels\ProductOffer;
use Illuminate\Http\Request;

class CashbackAbleOrderProductResource extends Resource
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
            'id' => $this->id,
            'userAccountId' => $this->userAccountId,
            'createdByUserId' => $this->createdByUserId,
            'orderId' => $this->orderId,
            'invoice' => $this->invoice,
            'productName' => $this->name,
            'productPrice' => $this->productPrice,
            'productQuantity' => $this->productQuantity,
            'amount' => $this->productQuantity * $this->productPrice,
            'paymentStatus' => $this->paymentStatus,
            'orderStatus' => $this->status,
            'cashback' => $this->cashback,
            'cashbackType' => $this->cashbackType,
            'isCashbackAble' => $this->isCashbackAble(),
            'cashbackAmount' => $this->cashbackAmount(),
            'created_at' => $this->created_at,
        ];
    }

    private function isCashbackAble()
    {
        if (in_array($this->paymentStatus, [Payment::STATUS_PAID, Payment::STATUS_PARTIAL])
            && in_array($this->status, [Order::STATUS_PROCESSING])) {
            return true;
        }

        return false;
    }

    private function cashbackAmount()
    {
        $amount = 0;
        if($this->isCashbackAble()) {
            if($this->cashbackType === ProductOffer::TYPE_FLAT) {
                $amount = $this->cashback;
            } else {
                $amount =  floor((($this->productQuantity * $this->productPrice) / 100) * $this->cashback);
            }
            return $amount;
        } else {
            return $amount;
        }
    }
}
