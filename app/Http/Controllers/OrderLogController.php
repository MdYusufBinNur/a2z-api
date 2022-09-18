<?php

namespace App\Http\Controllers;

use App\DbModels\OrderLog;
use App\Http\Requests\OrderLog\IndexRequest;
use App\Http\Resources\OrderLogResource;
use App\Http\Resources\OrderLogResourceCollection;
use App\Repositories\Contracts\OrderLogRepository;
use Illuminate\Auth\Access\AuthorizationException;

class OrderLogController extends Controller
{

    /**
     * @var OrderLogRepository
     */
    protected $orderLogRepository;

    /**
     * OrderLogController constructor.
     * @param OrderLogRepository $orderLogRepository
     */
    public function __construct(OrderLogRepository $orderLogRepository)
    {
        $this->orderLogRepository = $orderLogRepository;
    }

    /**
     * list all orderLog.
     *
     * @param IndexRequest $request
     * @return OrderLogResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [OrderLog::class, $request->input('createdByUserId')]);

        $orderLogs = $this->orderLogRepository->findBy($request->all());
        return new OrderLogResourceCollection($orderLogs);
    }

    /**
     * Display the specified resource.
     *
     * @param OrderLog $orderLog
     * @return OrderLogResource
     * @throws AuthorizationException
     */
    public function show(OrderLog $orderLog)
    {
        $this->authorize('list', $orderLog);

        return new OrderLogResource($orderLog);
    }
}
