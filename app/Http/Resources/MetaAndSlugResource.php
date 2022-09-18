<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;

class MetaAndSlugResource extends Resource
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
            'resourceId' => $this->resourceId,
            'type' => $this->type,
            'routePath' => $this->routePath,
            'slugPath' => $this->slugPath,
            'keywords' => $this->keywords,
            'updatedByUserId' => $this->updatedByUserId,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
