<?php

namespace App\Http\Requests\Attachment;

use App\DbModels\Attachment;
use App\Http\Requests\Request;
use App\Rules\CSVString;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws \ReflectionException
     */
    public function rules()
    {
        return $rules = [
            'type'         => 'required|in:' . implode(',', Attachment::getConstantsByPrefix('ATTACHMENT_TYPE_')),
            'fileSource'   => 'required|file|max:15360|mimes:jpeg,jpg,png,bmp,pdf,zip,rar,csv,xls,xlsx,docx,odt,txt,text,html,conf,def,list,log,in,gif,mpga,mp2,mp2a,mp3,m2a,m3a,3gp,h261,h262,h263,h264,mp4,mp4v,mpg4,mpeg,mpg,mpe,m1v,m2vm,qt,mov,flv,m4v,mkv,wmv,avi,movie,webm',
            'resourceId'   => '',
            'fileName'     => '',
            'descriptions' => '',
            'fileType'     => '',
            'fileSize'     => '',
            'variation'     => '',

            'resizeImage'  => 'boolean',
            'width'  => 'required_with:resizeImage',
            'height'  => 'required_with:resizeImage',

            'multipleTypes'  => [new CSVString(['thumbnail', 'medium', 'large', 'avatar'])],
        ];
    }

    public function messages()
    {
        return [
            'upload.max' => "Maximum file size to upload is 15MB. If you are uploading a photo, try to reduce its resolution to make it under 15 MB"
        ];
    }
}
