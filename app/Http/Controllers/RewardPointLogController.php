<?php

namespace App\Http\Controllers;

use App\DbModels\RewardPointLog;
use App\Http\Requests\RewardPointLog\IndexRequest;
use App\Http\Requests\RewardPointLog\StoreRequest;
use App\Http\Requests\RewardPointLog\UpdateRequest;
use App\Http\Resources\RewardPointLogResource;
use App\Http\Resources\RewardPointLogResourceCollection;
use App\Repositories\Contracts\RewardPointLogRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RewardPointLogController extends Controller
{
    protected $userPointUseLogRepository;

    public function __construct(RewardPointLogRepository $useLogRepository)
    {
        $this->userPointUseLogRepository = $useLogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return RewardPointLogResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $request = $this->userPointUseLogRepository->findBy($request->all());
        return new RewardPointLogResourceCollection($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return RewardPointLogResource
     */
    public function store(StoreRequest $request)
    {
        $request = $this->userPointUseLogRepository->save($request->all());
        return new RewardPointLogResource($request);
    }

    /**
     * Display the specified resource.
     *
     * @param RewardPointLog $log
     * @return RewardPointLogResource
     */
    public function show(RewardPointLog $log)
    {
        return new RewardPointLogResource($log);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param RewardPointLog $log
     * @return RewardPointLogResource
     */
    public function update(UpdateRequest $request, RewardPointLog $log)
    {
        $request = $this->userPointUseLogRepository->update($log, $request->all());
        return new RewardPointLogResource($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RewardPointLog $log
     * @return JsonResponse
     */
    public function destroy(RewardPointLog $log)
    {
        $this->userPointUseLogRepository->delete($log);
        return response()->json(null, 204);
    }
}
