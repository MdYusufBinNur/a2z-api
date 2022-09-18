<?php

namespace App\Http\Resources;

use App\DbModels\ProductStockOutLog;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductStockOutLogResource extends Resource
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
            'createdByUserId' => $this->createdByUserId,
            'productId' => $this->productId,
            'resourceId' => $this->resourceId,
            'resourceItem' => $this->resourceItem,
            'startingQuantity' => $this->startingQuantity,
            'availableQuantity' => $this->availableQuantity,
            'decreaseQuantity' => $this->decreaseQuantity,
            'note' => $this->note,
            'date' => $this->date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
