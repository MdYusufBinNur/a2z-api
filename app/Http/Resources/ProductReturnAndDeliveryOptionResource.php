<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;

class ProductReturnAndDeliveryOptionResource extends Resource
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
            "id" => $this->getIdOrUuid(),
            "createdByUserId" => $this->createdByUserId,
            "updatedByUserId" => $this->updatedByUserId,
            "productId" => $this->productId,
            "deliveryOptions" => $this->deliveryOptions,
            "returnOptions" => $this->returnOptions,
            "isFreeDeliveryAvailable" => $this->isFreeDeliveryAvailable,
            "isProductReturnable" => $this->isProductReturnable,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
