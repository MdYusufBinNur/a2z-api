<?php

namespace App\Http\Controllers;

use App\DbModels\RewardPoint;
use App\Http\Requests\RewardPoint\IndexRequest;
use App\Http\Requests\RewardPoint\StoreRequest;
use App\Http\Requests\RewardPoint\UpdateRequest;
use App\Http\Resources\RewardPointResource;
use App\Http\Resources\RewardPointResourceCollection;
use App\Repositories\Contracts\RewardPointRepository;
use Illuminate\Http\JsonResponse;

class RewardPointController extends Controller
{
    protected $rewardPointRepository;
    public function __construct(RewardPointRepository $repository)
    {
        $this->rewardPointRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return RewardPointResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $request = $this->rewardPointRepository->findBy($request->all());
        return new RewardPointResourceCollection($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return RewardPointResource
     */
    public function store(StoreRequest $request)
    {
        $request = $this->rewardPointRepository->save($request->all());
        return new RewardPointResource($request);
    }

    /**
     * Display the specified resource.
     *
     * @param RewardPoint $rewardPoint
     * @return RewardPointResource
     */
    public function show(RewardPoint $rewardPoint)
    {
        return new RewardPointResource($rewardPoint);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param RewardPoint $rewardPoint
     * @return RewardPointResource
     */
    public function update(UpdateRequest $request, RewardPoint $rewardPoint)
    {
        $request = $this->rewardPointRepository->update($rewardPoint, $request->all());
        return new RewardPointResource($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RewardPoint $rewardPoint
     * @return JsonResponse
     */
    public function destroy(RewardPoint $rewardPoint)
    {
        $this->rewardPointRepository->delete($rewardPoint);

        return response()->json(null, 204);
    }
}
