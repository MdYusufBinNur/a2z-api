<?php

namespace App\Http\Resources;

class AttachmentResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->getIdOrUuid(),
            'fileName'     => $this->fileName,
            'descriptions' => $this->descriptions,
            'type'         => $this->type,
            'createdBy' => $this->when($this->needToInclude($request, 'attachment.createdBy'), function () {
                return new UserResource($this->user);
            }),
            'resourceId'   => $this->resourceId,
            'fileType'     => $this->fileType,
            'fileSize'     => $this->fileSize,
            'variation'      => $this->variation,
            'src'      => $this->getFileUrl(),
            'thumbnail'      => $this->getFileUrl(),
            'avatar' => $this->when($this->needToInclude($request, 'image.avatar'), function () {
                return $this->getFileUrl('avatar');
            }),
//            'thumbnail' => $this->when($this->needToInclude($request, 'image.thumbnail'), function () {
//                return $this->getFileUrl('thumbnail');
//            }),
            'medium' => $this->when($this->needToInclude($request, 'image.medium'), function () {
                return $this->getFileUrl('medium');
            }),
            'large' => $this->when($this->needToInclude($request, 'image.large'), function () {
                return $this->getFileUrl('large');
            }),
        ];
    }
}
