<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;

class OrderDetailResource extends Resource
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
            'invoice' => $this->invoice,

            'productId' => $this->productId,
            'product' => $this->when($this->needToInclude($request, 'orderDetail.product'), function () {
                return new ProductResource($this->product);
            }),

            'productOfferId' => $this->productOfferId,
            'productOffer' => $this->when($this->needToInclude($request, 'orderDetail.productOffer'), function () {
                return new ProductOfferResource($this->productOffer);
            }),

            'orderId' => $this->orderId,
            'order' => $this->when($this->needToInclude($request, 'orderDetail.order'), function () {
                return new OrderResource($this->order);
            }),

            'productPrice' => $this->productPrice,
            'size' => $this->size,
            'color' => $this->color,
            'productQuantity' => $this->productQuantity,
            'amount' => $this->productQuantity * $this->productPrice,
            'cashbackStatus' => $this->cashbackStatus,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
