<?php

namespace App\Http\Controllers;

use App\DbModels\User;
use App\DbModels\UserAccountLog;
use App\Http\Requests\UserAccountLog\IndexRequest;
use App\Http\Requests\UserAccountLog\StoreRequest;
use App\Http\Requests\UserAccountLog\UpdateRequest;
use App\Http\Resources\UserAccountLogResource;
use App\Http\Resources\UserAccountLogResourceCollection;
use App\Repositories\Contracts\UserAccountLogRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Json;

class UserAccountLogController extends Controller
{
    /**
     * @var UserAccountLogRepository
     */
    protected $userAccountLogRepository;

    /**
     * UserAccountLogController constructor.
     * @param UserAccountLogRepository $userAccountLogRepository
     */
    public function __construct(UserAccountLogRepository $userAccountLogRepository)
    {
        $this->userAccountLogRepository = $userAccountLogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return UserAccountLogResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [UserAccountLog::class, $request->userId]);

        $userAccountLogs = $this->userAccountLogRepository->findBy($request->all());

        return new UserAccountLogResourceCollection($userAccountLogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return UserAccountLogResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', User::class);

        $userAccountLog = $this->userAccountLogRepository->save($request->all());

        return new UserAccountLogResource($userAccountLog);
    }

    /**
     * Display the specified resource.
     *
     * @param UserAccountLog $userAccountLog
     * @return UserAccountLogResource
     * @throws AuthorizationException
     */
    public function show(UserAccountLog $userAccountLog)
    {
        $this->authorize('show', $userAccountLog);

        return new UserAccountLogResource($userAccountLog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UserAccountLog $userAccountLog
     * @return UserAccountLogResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, UserAccountLog $userAccountLog)
    {
        $this->authorize('store', User::class);

        $userAccountLog = $this->userAccountLogRepository->update($userAccountLog, $request->all());

        return new UserAccountLogResource($userAccountLog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserAccountLog $userAccountLog
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(UserAccountLog $userAccountLog)
    {
        $this->authorize('destroy', User::class);

        $this->userAccountLogRepository->delete($userAccountLog);

        return response()->json(null, 204);
    }
}
