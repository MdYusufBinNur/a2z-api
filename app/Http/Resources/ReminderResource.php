<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class ReminderResource extends Resource
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
            'toUserIds' => $this->toUserIds,
            'reminderType' => $this->reminderType,
            'resourceType' => $this->resourceType,
            'resourceId' => $this->resourceId,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'details' => $this->detailByType
        ];
    }
}
