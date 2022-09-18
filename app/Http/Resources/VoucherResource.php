<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class VoucherResource extends Resource
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
            'updatedByUserId' => $this->updatedByUserId,
            'toUserId' => $this->toUserId,
            'toUser' => $this->when($this->needToInclude($request, 'voucher.toUser'), function () {
                return new UserResource($this->toUser);
            }),
            'status' => $this->status,
            'code' => $this->code,
            'isClaimed' => $this->isClaimed,
            'expiredAt' => $this->expiredAt,
            'claimedAt' => $this->claimedAt,
            'note' => $this->note,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
