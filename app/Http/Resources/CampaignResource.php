<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class CampaignResource extends Resource
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
            'slug' => $this->slug,
            'resourceId' => $this->when($this->needToInclude($request, 'campaign.resourceId'), function () {
                return $this->id;
            }),
            'createdByUserId' => $this->createdByUserId,
            'title' => $this->title,
            'startDate' => $this->startDate,
            'startTime' => $this->startTime,
            'endDate' =>  $this->endDate,
            'endTime' => $this->endTime,
            'description' => $this->description,
            'host' => $this->host,
            'isActive' => $this->isActive,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
