<?php

namespace App\Http\Resources;


class TagResource extends Resource
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
            'product' => $this->when($this->needToInclude($request, 'tag.product'), function () {
                return new ProductResource($this->product);
            }),
            'title' => $this->title,
            'type' => $this->type,
            'value' => $this->value,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
