<?php

namespace App\Http\Resources;


class ExpenseCategoryResource extends Resource
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
            'id' => $this->getIdOrUuid(),
            'title' => $this->title,
            'propertyId' => $this->propertyId
        ];
    }
}
