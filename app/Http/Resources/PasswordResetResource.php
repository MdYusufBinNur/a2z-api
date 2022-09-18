<?php

namespace App\Http\Resources;

class PasswordResetResource extends Resource
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
            'email' => $this->email,
            'phone' => $this->phone
        ];
    }
}
