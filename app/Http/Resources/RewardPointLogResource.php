<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class RewardPointLogResource extends Resource
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
            'userId' => $this->userId,
            'orderId' => $this->orderId,
            'pointUsed' => $this->pointUsed,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
