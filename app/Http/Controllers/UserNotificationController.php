<?php

namespace App\Http\Controllers;

use App\DbModels\UserNotification;
use App\Http\Requests\UserNotification\IndexRequest;
use App\Http\Requests\UserNotification\UpdateRequest;
use App\Http\Resources\UserNotificationResource;
use App\Http\Resources\UserNotificationResourceCollection;
use App\Repositories\Contracts\UserNotificationRepository;
use Illuminate\Auth\Access\AuthorizationException;

class UserNotificationController extends Controller
{
    /**
     * @var UserNotificationRepository
     */
    protected $userNotificationRepository;

    /**
     * UserNotificationController constructor.
     * @param UserNotificationRepository $userNotificationRepository
     */
    public function __construct(UserNotificationRepository $userNotificationRepository)
    {
        $this->userNotificationRepository = $userNotificationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return UserNotificationResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [UserNotification::class, $request->get('userId')]);

        $userNotificationTypes = $this->userNotificationRepository->findBy($request->all());

        return new UserNotificationResourceCollection($userNotificationTypes);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return UserNotificationResource
     * @throws AuthorizationException
     */
    public function show($id)
    {
        $userNotification = $this->userNotificationRepository->findOne($id);

        if (!$userNotification instanceof UserNotification) {
            return response()->json(['status' => 404, 'message' => 'Resource not found with the specific id.'], 404);
        }

        $this->authorize('list', $userNotification);

        return new UserNotificationResource($userNotification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @return UserNotificationResource
     */
    public function update(UpdateRequest $request)
    {
        $this->userNotificationRepository->setUserNotificationReadStatus($request->all());

        return response()->json(['data' => ["message" => "ReadStatus set successfully."]], 200);
    }
}
