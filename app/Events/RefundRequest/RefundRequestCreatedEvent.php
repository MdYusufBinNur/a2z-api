<?php

namespace App\Events\RefundRequest;

use App\DbModels\RefundRequest;
use Illuminate\Queue\SerializesModels;

class RefundRequestCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var RefundRequest
     */
    public $refundRequest;

    /**
     * Create a new event instance.
     *
     * @param RefundRequest $refundRequest
     * @param array $options
     */
    public function __construct(RefundRequest $refundRequest, array $options = [])
    {
        $this->refundRequest = $refundRequest;
        $this->options = $options;
    }
}
