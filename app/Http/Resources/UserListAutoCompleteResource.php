<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;

class UserListAutoCompleteResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'userId' => $this->getIdOrUuid(),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'profilePic' => $this->when($this->needToInclude($request, 'ula.profilePic'), function () {
                return new AttachmentResource($this->userProfilePics->last());
            }),
            $this->mergeWhen(isset($this->managerLevel), [
                'managerId' => $this->managerId,
                'managerLevel' => $this->managerLevel,
                'managerTitle' => $this->managerTitle,
                'verbose' => Str::title($this->name . (isset($this->managerTitle) ?  ' (' . $this->managerTitle . ')' : '')),
            ]),
            $this->mergeWhen(isset($this->residentTitle), [
                'residentId' => $this->residentId,
                'residentTitle' => $this->residentTitle,
                'unit' => $this->unit,
                'verbose' => Str::title($this->name . (isset($this->residentTitle) ?  ' (' . $this->unit . ')' : '')),
            ]),
        ];
    }
}
