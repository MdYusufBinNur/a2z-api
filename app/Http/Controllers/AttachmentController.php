<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attachment\IndexRequest;
use App\Http\Requests\Attachment\StoreRequest;
use App\Http\Resources\AttachmentResource;
use App\Http\Resources\AttachmentResourceCollection;
use App\Repositories\Contracts\AttachmentRepository;
use App\DbModels\Attachment;

class AttachmentController extends Controller
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
     * show the attachments
     *
     * @param IndexRequest $request
     * @return AttachmentResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $attachments = $this->attachmentRepository->findBy($request->all());

        return new AttachmentResourceCollection($attachments);
    }

    /**
     * Show a attachment
     *
     * @param Attachment $attachment
     * @return AttachmentResource
     */
    public function show(Attachment $attachment)
    {
        return new AttachmentResource($attachment);
    }

    /**
     * create a attachment
     *
     * @param StoreRequest $request
     * @return AttachmentResource
     */
    public function store(StoreRequest $request)
    {
        $attachment = $this->attachmentRepository->save($request->all());

        return  new AttachmentResource($attachment);
    }

    /**
     * delete a attachment
     *
     * @param Attachment $attachment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Attachment $attachment)
    {
        $this->attachmentRepository->delete($attachment);

        return response()->json(null, 204);
    }
}
