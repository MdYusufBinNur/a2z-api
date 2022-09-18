<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;

class UserAccountResource extends Resource
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
            'userId' => $this->userId,
            'user' => $this->when($this->needToInclude($request, 'userAccount.user'), function () {
                return new UserResource($this->user);
            }),

            'userAccountLogs' => $this->when($this->needToInclude($request, 'userAccount.userAccountLogs'), function () {
                return new UserAccountLogResourceCollection($this->userAccountLogs);
            }),

            'balanceAmount' => $this->balanceAmount,
            'holdingAmount' => $this->holdingAmount,
            'giftCardAmount' => $this->giftCardAmount,
            'cashbackAmount' => $this->cashbackAmount,
            'status' => $this->status,
            'note' => $this->note,
            'currency' => $this->currency,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
