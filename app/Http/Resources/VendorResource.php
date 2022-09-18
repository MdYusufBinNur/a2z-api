<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;

class VendorResource extends Resource
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
            'acceptPaymentMethods' => $this->acceptPaymentMethods,
            'resourceId' => $this->when($this->needToInclude($request, 'vendor.resourceId'), function () {
                return $this->id;
            }),
            'createdByUserId' => $this->createdByUserId,
            'name' => $this->name,
            'email' =>$this->email,
            'phone' => $this->phone,
            'subCategoryIds' => $this->subCategoryIds,
            'address' => $this->address,
            'website' => $this->website,
            'billingInfo' => $this->billingInfo,
            'additionalNote' => $this->additionalNote,
            'tag' => $this->tag,
            'type' => $this->type,
            'userId' => $this->userId,
            'user' => $this->when($this->needToInclude($request, 'vendor.user'), function () {
                return new UserResource($this->user);
            }),
            'productOffer' => $this->when($this->needToInclude($request, 'vendor.productOffer'), function () {
                return new ProductOfferResource($this->productOffer);
            }),
            'image' => $this->when($this->needToInclude($request, 'vendor.image'), function () {
                return new AttachmentResource($this->image);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
