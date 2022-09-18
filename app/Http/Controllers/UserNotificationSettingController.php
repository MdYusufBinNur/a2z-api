<?php

namespace App\Http\Controllers;

use App\DbModels\UserNotificationSetting;
use App\Http\Requests\UserNotificationSetting\IndexRequest;
use App\Http\Requests\UserNotificationSetting\StoreRequest;
use App\Http\Requests\UserNotificationSetting\UpdateRequest;
use App\Http\Resources\UserNotificationSettingResource;
use App\Http\Resources\UserNotificationSettingResourceCollection;
use App\Repositories\Contracts\UserNotificationSettingRepository;
use Illuminate\Auth\Access\AuthorizationException;

class UserNotificationSettingController extends Controller
{
    /**
     * @var UserNotificationSettingRepository
     */
    protected $userNotificationSettingRepository;

    /**
     * UserNotificationSettingController constructor.
     * @param UserNotificationSettingRepository $userNotificationSettingRepository
     */
    public function __construct(UserNotificationSettingRepository $userNotificationSettingRepository)
    {
        $this->userNotificationSettingRepository = $userNotificationSettingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return UserNotificationSettingResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [UserNotificationSetting::class, $request->input('propertyId'), $request->get('userId', null)]);

        $userNotificationSettings = $this->userNotificationSettingRepository->findBy($request->all());

        return new UserNotificationSettingResourceCollection($userNotificationSettings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return UserNotificationSettingResourceCollection
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [UserNotificationSetting::class, $request->all()]);

        $userNotificationSettings = $this->userNotificationSettingRepository->saveUserNotificationSettings($request->all());

        return new UserNotificationSettingResourceCollection(collect($userNotificationSettings));
    }

    /**
     * Display the specified resource.
     *
     * @param UserNotificationSetting $userNotificationSetting
     * @return UserNotificationSettingResource
     * @throws AuthorizationException
     */
    public function show(UserNotificationSetting $userNotificationSetting)
    {
        $this->authorize('store', $userNotificationSetting);

        return new UserNotificationSettingResource($userNotificationSetting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UserNotificationSetting $userNotificationSetting
     * @return UserNotificationSettingResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, UserNotificationSetting $userNotificationSetting)
    {
        $this->authorize('update', $userNotificationSetting);

        $userNotificationSetting = $this->userNotificationSettingRepository->update($userNotificationSetting,$request->all());

        return new UserNotificationSettingResource($userNotificationSetting);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserNotificationSetting $userNotificationSetting
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(UserNotificationSetting $userNotificationSetting)
    {
        $this->authorize('destroy', $userNotificationSetting);

        $this->userNotificationSettingRepository->delete($userNotificationSetting);

        return response()->json(null,204);
    }
}
