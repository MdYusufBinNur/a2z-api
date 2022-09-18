<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class UserProfileResource extends Resource
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
            'gender' => $this->gender,
            'occupation' => $this->occupation,
            'address' => $this->address,
            'homeTown' => $this->homeTown,
            'birthDate' => $this->birthDate,
            'interests' => $this->interests,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
