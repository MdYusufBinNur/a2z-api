<?php

namespace App\Events\MessageTemplate;

use App\DbModels\MessageTemplate;
use Illuminate\Queue\SerializesModels;

class MessageTemplateUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var MessageTemplate
     */
    public $messageTemplate;

    /**
     * Create a new event instance.
     *
     * @param MessageTemplate $messageTemplate
     * @param array $options
     */
    public function __construct(MessageTemplate $messageTemplate, array $options = [])
    {
        $this->messageTemplate = $messageTemplate;
        $this->options = $options;
    }
}
