<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;

class PaymentMethodResource extends Resource
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
            'title' => $this->title,
            'details' => $this->details,
            'link' => $this->link,
            'callbackUrl' => $this->callbackUrl,
            'discount' => $this->discount,
            'createdByUserId' => $this->createdByUserId,
            'updatedByUserId' => $this->updatedByUserId,
            'isActive' => $this->isActive,
            'icons' => $this->when($this->needToInclude($request, 'paymentMethod.icons'), function () {
                return new AttachmentResourceCollection($this->icons);
            }),
        ];
    }
}
