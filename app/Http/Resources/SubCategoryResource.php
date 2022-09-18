<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;

class SubCategoryResource extends Resource
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
            'resourceId' => $this->when($this->needToInclude($request, 'subc.resourceId'), function () {
                return $this->id;
            }),
            'name' => $this->name,
            'categoryId' => $this->categoryId,
            'category' => $this->when($this->needToInclude($request, 'subc.category'), function () {
                return new CategoryResource($this->category);
            }),
            'image' => $this->when($this->needToInclude($request, 'subc.image'), function () {
                return new AttachmentResource($this->image);
            }),
            'icon' => $this->icon,
        ];
    }
}
