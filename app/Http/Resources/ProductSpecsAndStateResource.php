<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;

class ProductSpecsAndStateResource extends Resource
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

            'specifications' => $this->when($this->needToInclude($request, 'psas.specifications'), function () {
                return $this->specifications;
            }),

            'productStates' => $this->when($this->needToInclude($request, 'psas.productStates'), function () {
                return $this->productStates;
            }),

            'createdByUserId' => $this->createdByUserId,
            'createdByUser' => $this->when($this->needToInclude($request, 'psas.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),

            'productId' => $this->productId,
            'product' => $this->when($this->needToInclude($request, 'psas.product'), function () {
                return new ProductResource($this->product);
            }),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
