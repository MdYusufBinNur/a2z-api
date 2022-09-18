<?php

namespace App\Http\Controllers;

use App\DbModels\MessageUser;
use App\Http\Requests\MessageUser\BulkDeleteRequest;
use App\Http\Requests\MessageUser\BulkUpdateReadStatusRequest;
use App\Http\Requests\MessageUser\IndexRequest;
use App\Http\Requests\MessageUser\UpdateRequest;
use App\Http\Resources\MessageUserResource;
use App\Http\Resources\MessageUserResourceCollection;
use App\Repositories\Contracts\MessageUserRepository;
use Illuminate\Auth\Access\AuthorizationException;

class MessageUserController extends Controller
{
    /**
     * @var MessageUserRepository
     */
    protected $messageUserRepository;

    /**
     * MessageUserController constructor.
     * @param MessageUserRepository $messageUserRepository
     */
    public function __construct(MessageUserRepository $messageUserRepository)
    {
        $this->messageUserRepository = $messageUserRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return MessageUserResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [MessageUser::class, $request->get('userId')]);

        $messageUsers = $this->messageUserRepository->findBy($request->all());

        return new MessageUserResourceCollection($messageUsers);
    }

    /**
     * Display the specified resource.
     *
     * @param MessageUser $messageUser
     * @return MessageUserResource
     * @throws AuthorizationException
     */
    public function show(MessageUser $messageUser)
    {
        $this->authorize('show', $messageUser);

        return new MessageUserResource($messageUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param MessageUser $messageUser
     * @return MessageUserResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, MessageUser $messageUser)
    {
        $this->authorize('update', $messageUser);

        $messageUser = $this->messageUserRepository->update($messageUser, $request->all());

        return new MessageUserResource($messageUser);
    }

    /**
     * Bulk update the specified resource in storage.
     *
     * @param BulkUpdateReadStatusRequest $request
     * @return MessageUserResourceCollection
     * @throws AuthorizationException
     */
    public function bulkUpdate(BulkUpdateReadStatusRequest $request)
    {
        $requestData = $request->all();
        $this->authorize('bulkUpdate', [MessageUser::class, $requestData['messageUserIds']]);

        $messageUsers = $this->messageUserRepository->bulkUpdateReadStatus($requestData);

        return  new MessageUserResourceCollection($messageUsers);
    }


    /**
     * Bulk delete the specified resource in storage.
     *
     * @param BulkDeleteRequest $request
     * @return MessageUserResource
     * @throws AuthorizationException
     */
    public function bulkDelete(BulkDeleteRequest $request)
    {
        $requestData = $request->all();

        $this->authorize('bulkDelete', [MessageUser::class, $requestData['messageUserIds']]);

        $this->messageUserRepository->bulkDelete($requestData);

        return response()->json(null, 204);
    }
}
