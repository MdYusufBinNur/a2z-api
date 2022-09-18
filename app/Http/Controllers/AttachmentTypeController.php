<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\AttachmentRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentTypeController extends Controller
{
    /**
     * @var AttachmentRepository
     */
    private $attachmentRepository;

    /**
     * AttachmentController constructor.
     *
     * @param AttachmentRepository $attachmentRepository
     */
    public function __construct(AttachmentRepository $attachmentRepository)
    {
        $this->attachmentRepository = $attachmentRepository;
    }

    /**
     * get the attachments
     */
    public function index()
    {
        $attachmentTypes = $this->attachmentRepository->getAllAttachmentTypes();

        return JsonResource::make(array_values($attachmentTypes));
    }
}
