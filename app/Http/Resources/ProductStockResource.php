<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class ProductStockResource extends Resource
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
            'updatedByUserId' => $this->updatedByUserId,
            'productId' => $this->productId,
            'price' => $this->price,
            'oldPrice' => $this->oldPrice,
            'status' => $this->status,
            'type' => $this->type,
            'availableQuantity' => $this->availableQuantity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
