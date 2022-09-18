<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class UserNotificationSettingResource extends Resource
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
            'userId' => $this->userId,
            'typeId' => $this->typeId,
            'email' => $this->email,
            'sms' => $this->sms,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
