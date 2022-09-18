<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class BrandResource extends Resource
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
            'slug' => $this->slug,
            'resourceId' => $this->when($this->needToInclude($request, 'brand.resourceId'), function () {
                return $this->id;
            }),
            'createdByUserId' => $this->createdByUserId,
            'title' => $this->title,
            'tag' => $this->tag,
            'categoryId' => $this->categoryId,
            'category' => $this->when($this->needToInclude($request, 'brand.category'), function () {
                return new CategoryResource($this->category);
            }),
            'productOffer' => $this->when($this->needToInclude($request, 'brand.productOffer'), function () {
                return new ProductOfferResource($this->productOffer);
            }),
            'image' => $this->when($this->needToInclude($request, 'brand.image'), function () {
                return new AttachmentResource($this->image);
            }),
            'address' => $this->address,
            'ownerName' => $this->ownerName,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
