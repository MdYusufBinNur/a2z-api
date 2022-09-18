<?php

namespace App\Http\Resources;


class UserAddressResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'createdByUserId' => $this->createdByUserId,
            'userId' => $this->userId,
            'name' => $this->name,
            'phone' => $this->phone,
            'division' => $this->division,
            'district' => $this->district,
            'area' => $this->area,
            'address' => $this->address,
            'updatedByUserId' => $this->updatedByUserId,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
