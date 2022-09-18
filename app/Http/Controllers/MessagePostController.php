<?php

namespace App\Http\Controllers;

use App\DbModels\MessagePost;
use App\Http\Requests\MessagePost\IndexRequest;
use App\Http\Requests\MessagePost\StoreRequest;
use App\Http\Requests\MessagePost\UpdateRequest;
use App\Http\Resources\MessagePostResource;
use App\Http\Resources\MessagePostResourceCollection;
use App\Repositories\Contracts\MessagePostRepository;
use Illuminate\Auth\Access\AuthorizationException;

class MessagePostController extends Controller
{
    /**
     * @var MessagePostRepository
     */
    protected $messagePostRepository;

    /**
     * MessagePostController constructor.
     * @param MessagePostRepository $messagePostRepository
     */
    public function __construct(MessagePostRepository $messagePostRepository)
    {
        $this->messagePostRepository = $messagePostRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return MessagePostResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [MessagePost::class, $request->get('messageId')]);

        $messagePosts = $this->messagePostRepository->findBy($request->all());

        return new MessagePostResourceCollection($messagePosts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return MessagePostResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [MessagePost::class, $request->get('messageId')]);

        $messagePost = $this->messagePostRepository->save($request->all());

        return new MessagePostResource($messagePost);
    }

    /**
     * Display the specified resource.
     *
     * @param MessagePost $messagePost
     * @return MessagePostResource
     * @throws AuthorizationException
     */
    public function show(MessagePost $messagePost)
    {
        $this->authorize('show', $messagePost);

        return new MessagePostResource($messagePost);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param MessagePost $messagePost
     * @return MessagePostResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, MessagePost $messagePost)
    {
        $this->authorize('update', $messagePost);

        $messagePost = $this->messagePostRepository->update($messagePost, $request->all());

        return new MessagePostResource($messagePost);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MessagePost $messagePost
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(MessagePost $messagePost)
    {
        $this->authorize('destroy', $messagePost);

        $this->messagePostRepository->delete($messagePost);

        return response()->json(null, 204);
    }
}
