<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonUuidFeatures;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    // use SoftDeletes, CommonModelFeatures;
    use CommonModelFeatures, CommonUuidFeatures;

    const ATTACHMENT_TYPE_GENERIC = 'generic';
    const ATTACHMENT_TYPE_USER_PROFILE = 'user-profile';
    const ATTACHMENT_TYPE_VENDOR = 'vendor';
    const ATTACHMENT_TYPE_VOUCHER = 'voucher';
    const ATTACHMENT_TYPE_BRAND = 'brand';
    const ATTACHMENT_TYPE_CATEGORY = 'category';
    const ATTACHMENT_TYPE_SUB_CATEGORY = 'sub-category';
    const ATTACHMENT_TYPE_PRODUCT = 'product';
    const ATTACHMENT_TYPE_PRODUCT_REVIEW = 'product-review';
    const ATTACHMENT_TYPE_FEEDBACK = 'feedback';
    const ATTACHMENT_TYPE_AD = 'ad';
    const ATTACHMENT_TYPE_SLIDER = 'slider';
    const ATTACHMENT_TYPE_MESSAGE = 'message';
    const ATTACHMENT_TYPE_ORDER_REPORT = 'order-report';
    const ATTACHMENT_TYPE_CONTACT_US = 'contact-us';
    const ATTACHMENT_TYPE_PAYMENT_METHOD = 'payment-method';
    const ATTACHMENT_TYPE_CONTENT_MODULE = 'content-module';

    const ATTACHMENT_VARIATION_DEFAULT = 'default';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attachments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdBy',
        'type',
        'resourceId',
        'fileName',
        'variation',
        'descriptions',
        'fileType',
        'fileSize',
        'hasAvatarSize',
        'hasThumbnailSize',
        'hasMediumSize',
        'hasLargeSize',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'hasAvatarSize' => 'boolean',
        'hasThumbnailSize' => 'boolean',
        'hasMediumSize' => 'boolean',
        'hasLargeSize' => 'boolean',
    ];

    /**
     * Get the user who created the attachment
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'createdBy');
    }

    /**
     * Get storage directory name by attachment type
     *
     * @param $attachmentType
     * @return string
     */
    public function getDirectoryName($attachmentType)
    {
        $directoryName = 'generic';
        switch ($attachmentType) {
            case self::ATTACHMENT_TYPE_GENERIC:
                $directoryName = 'generic';
                break;
            case self::ATTACHMENT_TYPE_USER_PROFILE:
                $directoryName = 'user-profile';
                break;
            case self::ATTACHMENT_TYPE_VENDOR:
                $directoryName = 'vendor';
                break;
            case self::ATTACHMENT_TYPE_VOUCHER:
                $directoryName = 'voucher';
                break;
            case self::ATTACHMENT_TYPE_BRAND:
                $directoryName = 'brand';
                break;
            case self::ATTACHMENT_TYPE_CATEGORY:
                $directoryName = 'category';
                break;
            case self::ATTACHMENT_TYPE_SUB_CATEGORY:
                $directoryName = 'sub-category';
                break;
            case self::ATTACHMENT_TYPE_PRODUCT:
                $directoryName = 'product';
                break;
            case self::ATTACHMENT_TYPE_PRODUCT_REVIEW:
                $directoryName = 'product-review';
                break;
            case self::ATTACHMENT_TYPE_FEEDBACK:
                $directoryName = 'feedback';
                break;
            case self::ATTACHMENT_TYPE_AD:
                $directoryName = 'ad';
                break;
            case self::ATTACHMENT_TYPE_SLIDER:
                $directoryName = 'slider';
                break;
            case self::ATTACHMENT_TYPE_MESSAGE:
                $directoryName = 'message';
                break;
            case self::ATTACHMENT_TYPE_ORDER_REPORT:
                $directoryName = 'order-report';
                break;
            case self::ATTACHMENT_TYPE_CONTACT_US:
                $directoryName = 'contact-us';
                break;
            case self::ATTACHMENT_TYPE_CONTENT_MODULE:
                $directoryName = 'content-module';
                break;
        }

        return $directoryName;
    }

    /**
     * get access type of the attachment
     *
     * @param string $attachmentType
     * @return string
     */
    public function getAccessTypeByAttachmentType($attachmentType)
    {
        $accessType = 'public';

        switch ($attachmentType) {
            case self::ATTACHMENT_TYPE_MESSAGE:
            case self::ATTACHMENT_TYPE_ORDER_REPORT:
//            case self::ATTACHMENT_TYPE_FEEDBACK:
//            case self::ATTACHMENT_TYPE_USER_PROFILE:
                $accessType = 'private';
                break;
        }
        return $accessType;
    }

    /**
     * get image width and height by image type title
     *
     * @param $title
     * @return array
     */
    public function getImageSizeByTypeTitle($title)
    {
        $sizes = ['width' => 150, 'height' => 150];
        switch (strtolower($title)) {
            case 'avatar':
                $sizes = ['width' => 40, 'height' => 40];
                break;
            case 'thumbnail':
                $sizes = ['width' => 100, 'height' => 100];
                break;
            case 'medium':
                $sizes = ['width' => 300, 'height' => 300];
                break;
            case 'large':
                $sizes = ['width' => 1024, 'height' => 1024];
                break;

        }

        return $sizes;
    }

    /**
     * get attachment file path by type-title(thumbnail, medium, large etc.)
     *
     * @param string $typeTitle
     * @return string
     */
    public function getAttachmentDirectoryPathByTypeTitle($typeTitle = '')
    {
        switch (strtolower($typeTitle)) {
            case 'thumbnail':
            case 'medium':
            case 'large':
            case 'avatar':
                $path = $typeTitle . '/' . $this->fileName;
                break;
            default:
                $path = $this->fileName;

        }

        $directoryName = $this->getDirectoryName($this->type);

        return $directoryName . '/' . $path;
    }

    /**
     * see if image type is available for that attachment
     *
     * @param string $imageType
     * @return bool|mixed
     */
    public function isImageSizeAvailable($imageType = '')
    {
        switch (strtolower($imageType)) {
            case '': //for normal file url
                return true;
                break;
            case 'avatar':
                return $this->hasAvatarSize;
                break;
            case 'thumbnail':
                return $this->hasThumbnailSize;
                break;
            case 'medium':
                return $this->hasMediumSize;
                break;
            case 'large':
                return $this->hasLargeSize;
                break;
            default:
                return false;

        }
    }

    /**
     * generate file URL by type
     *
     * @param string $imageType
     * @return mixed
     */
    public function getFileUrl($imageType = '')
    {
        $accessType = $this->getAccessTypeByAttachmentType($this->type);

        if ($accessType == 'private') {
            return $this->isImageSizeAvailable($imageType) ? \Storage::temporaryUrl($this->getAttachmentDirectoryPathByTypeTitle($imageType), Carbon::now()->addMinutes(10)) : null;
        } else {
            return $this->isImageSizeAvailable($imageType) ? \Storage::url($this->getAttachmentDirectoryPathByTypeTitle($imageType)) : null;
        }
    }
}
