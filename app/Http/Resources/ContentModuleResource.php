<?php

namespace App\Http\Resources;


class ContentModuleResource extends Resource
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
            'createdByUserId' => $this->createdByUserId,
            'updatedByUserId' => $this->updatedByUserId,
            
            'categoryId' => $this->categoryId,
            'category' => $this->when($this->needToInclude($request, 'contentModule.category'), function () {
                return new CategoryResource($this->category);
            }),

            'subCategoryId' => $this->subCategoryId,
            'subCategory' => $this->when($this->needToInclude($request, 'contentModule.subCategory'), function () {
                return new SubCategoryResource($this->subCategory);
            }),

            'image' => $this->when($this->needToInclude($request, 'contentModule.image'), function () {
                return new AttachmentResource($this->image);
            }),

            'products' => $this->when($this->needToInclude($request, 'contentModule.products'), function () {
                return new ProductResourceCollection($this->products());
            }),

            'type' => $this->type,
            'title' => $this->title,
            'params' => $this->params,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
