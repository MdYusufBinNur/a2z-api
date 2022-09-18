<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class ProductStockInLogResource extends Resource
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
            'productId' => $this->productId,
            'vendorId' => $this->vendorId,
            'date' => $this->date,
            'cost' => $this->cost,
            'note' => $this->note,
            'startingQuantity' => $this->startingQuantity,
            'receivedQuantity' => $this->receivedQuantity,
            'availableQuantity' => $this->availableQuantity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
