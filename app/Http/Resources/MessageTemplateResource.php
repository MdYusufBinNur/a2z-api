<?php

namespace App\Http\Resources;


class MessageTemplateResource extends Resource
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
            'propertyId' => $this->propertyId,
            'title' => $this->title,
            'text' => $this->text,
        ];
    }
}
