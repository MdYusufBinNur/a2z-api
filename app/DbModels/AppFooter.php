<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AppFooter extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const CONTENT_MENU = "menu";
    const CONTENT_ADDRESS = "address";
    const CONTENT_DOWNLOAD = "download";
    const CONTENT_GET_IN_TOUCH = "getInTouch";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createByUserId',
        'title',
        'content',
        'link',
        'details',
    ];

    /**
     * Get the associate appFooter image
     *
     * @return HasOne
     */
    public function image()
    {
        return $this->hasOne(Attachment::class,'resourceId', 'id')->where('type', Attachment::ATTACHMENT_TYPE_CONTACT_US)->latest();
    }
}
