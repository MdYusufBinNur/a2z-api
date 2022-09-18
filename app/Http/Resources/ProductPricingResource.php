<?php

namespace App\Http\Resources;

use App\DbModels\ProductOffer;
use Illuminate\Http\Request;

class ProductPricingResource extends Resource
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
            'productId' => $this->productId,
            'price' => $this->price,
            'discountPrice' => $this->discountPrice(),
            'oldPrice' => $this->oldPrice,
            'status' => $this->status,
            'type' => $this->type,

            'vendorId' => $this->vendorId,
            'campaignId' => $this->campaignId,
            'cashback' => $this->cashback,
            'discount' => $this->discount,
            'cashbackType' => $this->cashbackType,
            'discountType' => $this->discountType,
            'startDate' => $this->startDate,
            'startTime' => $this->startTime,
            'endDate' =>  $this->endDate,
            'endTime' => $this->endTime,
            'isActive' => $this->isActive,
            'title' => $this->title,
            'availableQuantity' => $this->availableQuantity,
        ];
    }

    private function discountPrice() {
        $calculatedOfferPrice = (float) 0;

        if(!empty($this->discount)) {
            if($this->discountType === ProductOffer::TYPE_FLAT) {
                $calculatedOfferPrice = $this->price - $this->discount;
            } else if($this->discountType === ProductOffer::TYPE_PERCENTAGE) {
                $calculatedOfferPrice = $this->price - round((($this->discount  * $this->price) / 100),2);
            } else {
                $calculatedOfferPrice = $this->price;
            }
        }

        return $calculatedOfferPrice;
    }
}
