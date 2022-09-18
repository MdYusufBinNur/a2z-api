<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class RatingAndReviewResource extends Resource
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
            'createdByUser' => $this->when($this->needToInclude($request, 'rar.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'productId' => $this->productId,
            'vendorId' => $this->vendorId,
            'type' => $this->type,
            'rating' => $this->rating,
            'comments' => $this->comments,
            'created_at' => $this->created_at
        ];
    }
}
