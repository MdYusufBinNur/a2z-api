<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;

class ProductOfferResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->getIdOrUuid(),
            'vendorId' => $this->vendorId,
            'vendor' => $this->when($this->needToInclude($request, 'productOffer.vendor'), function () {
                return new VendorResource($this->vendor);
            }),

            'productId' => $this->productId,
            'product' => $this->when($this->needToInclude($request, 'productOffer.product'), function () {
                return new ProductResource($this->product);
            }),

            'brandId' => $this->brandId,
            'brand' => $this->when($this->needToInclude($request, 'productOffer.brand'), function () {
                return new BrandResource($this->brand);
            }),

            'campaignId' => $this->campaignId,
            'campaign' => $this->when($this->needToInclude($request, 'productOffer.campaign'), function () {
                return new CampaignResource($this->campaign);
            }),

            'title' => $this->title,
            'cashback' => $this->cashback,
            'discount' => $this->discount,
            'discountType' => $this->discountType,
            'cashbackType' => $this->cashbackType,

            'startDate' => $this->startDate,
            'startTime' => $this->startTime,
            'endDate' =>  $this->endDate,
            'endTime' => $this->endTime,

            'isActive' => $this->isActive,
            'availableQuantity' => $this->availableQuantity,
            'createdByUserId' => $this->createdByUserId,
            'updatedByUserId' => $this->updatedByUserId,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
