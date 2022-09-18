<?php

namespace App\Events\Attachment;

use App\DbModels\Attachment;
use Illuminate\Queue\SerializesModels;

class AttachmentCreatedEvent
{
    use SerializesModels;

    /**
     * @var Attachment
     */
    public $attachment;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Attachment $attachment
     * @param array $options
     * @return void
     */
    public function __construct(Attachment $attachment, array $options = [])
    {
        $this->attachment = $attachment;
        $this->options = $options;
    }
}
