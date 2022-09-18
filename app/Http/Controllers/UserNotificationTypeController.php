<?php

namespace App\Http\Controllers;

use App\DbModels\UserNotificationType;
use App\Http\Requests\UserNotificationType\IndexRequest;
use App\Http\Requests\UserNotificationType\StoreRequest;
use App\Http\Requests\UserNotificationType\UpdateRequest;
use App\Http\Resources\UserNotificationTypeResource;
use App\Http\Resources\UserNotificationTypeResourceCollection;
use App\Repositories\Contracts\UserNotificationTypeRepository;

class UserNotificationTypeController extends Controller
{
    /**
     * @var UserNotificationTypeRepository
     */
    protected $userNotificationTypeRepository;

    /**
     * UserNotificationTypeController constructor.
     * @param UserNotificationTypeRepository $userNotificationTypeRepository
     */
    public function __construct(UserNotificationTypeRepository $userNotificationTypeRepository)
    {
        $this->userNotificationTypeRepository = $userNotificationTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return UserNotificationTypeResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $userNotificationTypes = $this->userNotificationTypeRepository->findBy($request->all());

        return new UserNotificationTypeResourceCollection($userNotificationTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return UserNotificationTypeResource
     */
    public function store(StoreRequest $request)
    {
        $userNotificationType = $this->userNotificationTypeRepository->save($request->all());

        return new UserNotificationTypeResource($userNotificationType);
    }

    /**
     * Display the specified resource.
     *
     * @param UserNotificationType $userNotificationType
     * @return UserNotificationTypeResource
     */
    public function show(UserNotificationType $userNotificationType)
    {
        return new UserNotificationTypeResource($userNotificationType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UserNotificationType $userNotificationType
     * @return UserNotificationTypeResource
     */
    public function update(UpdateRequest $request, UserNotificationType $userNotificationType)
    {
        $userNotificationType = $this->userNotificationTypeRepository->update($userNotificationType, $request->all());

        return new  UserNotificationTypeResource($userNotificationType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserNotificationType $userNotificationType
     * @return null
     */
    public function destroy(UserNotificationType $userNotificationType)
    {
        $this->userNotificationTypeRepository->delete($userNotificationType);

        return response()->json(null, 204);
    }
}
