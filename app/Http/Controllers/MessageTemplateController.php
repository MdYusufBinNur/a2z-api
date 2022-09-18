<?php

namespace App\Http\Controllers;

use App\DbModels\MessageTemplate;
use App\Http\Requests\MessageTemplate\IndexRequest;
use App\Http\Requests\MessageTemplate\StoreRequest;
use App\Http\Requests\MessageTemplate\UpdateRequest;
use App\Http\Resources\MessageTemplateResource;
use App\Http\Resources\MessageTemplateResourceCollection;
use App\Repositories\Contracts\MessageTemplateRepository;
use Illuminate\Http\Request;

class MessageTemplateController extends Controller
{
    /**
     * @var MessageTemplateRepository
     */
    protected $messageTemplateRepository;

    /**
     * MessageTemplateController constructor.
     * @param MessageTemplateRepository $messageTemplateRepository
     */
    public function __construct(MessageTemplateRepository $messageTemplateRepository)
    {
        $this->messageTemplateRepository = $messageTemplateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return MessageTemplateResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $messageTemplates = $this->messageTemplateRepository->findBy($request->all());

        return new MessageTemplateResourceCollection($messageTemplates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return MessageTemplateResource
     */
    public function store(StoreRequest $request)
    {
        $messageTemplate = $this->messageTemplateRepository->save($request->all());

        return new MessageTemplateResource($messageTemplate);
    }

    /**
     * Display the specified resource.
     *
     * @param MessageTemplate $messageTemplate
     * @return MessageTemplateResource
     */
    public function show(MessageTemplate $messageTemplate)
    {
        return new MessageTemplateResource($messageTemplate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param MessageTemplate $messageTemplate
     * @return MessageTemplateResource
     */
    public function update(UpdateRequest $request, MessageTemplate $messageTemplate)
    {
        $messageTemplate = $this->messageTemplateRepository->update($messageTemplate, $request->all());

        return new MessageTemplateResource($messageTemplate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MessageTemplate $messageTemplate
     * @return void
     */
    public function destroy(MessageTemplate $messageTemplate)
    {
        $this->messageTemplateRepository->delete($messageTemplate);

        return response()->json(null, 204);
    }
}
