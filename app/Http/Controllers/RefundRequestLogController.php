<?php

namespace App\Http\Controllers;

use App\DbModels\RefundRequestLog;
use App\Http\Requests\RefundRequestLog\IndexRequest;
use App\Http\Requests\RefundRequestLog\StoreRequest;
use App\Http\Requests\RefundRequestLog\UpdateRequest;
use App\Http\Resources\RefundRequestLogResource;
use App\Http\Resources\RefundRequestLogResourceCollection;
use App\Repositories\Contracts\RefundRequestLogRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RefundRequestLogController extends Controller
{

    /**
     * @var RefundRequestLogRepository
     */
    protected $refundRepository;

    public function __construct(RefundRequestLogRepository $refundRepository)
    {
        $this->refundRepository = $refundRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return RefundRequestLogResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $refunds = $this->refundRepository->findBy($request->all());

        return new RefundRequestLogResourceCollection($refunds);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return RefundRequestLogResource
     */
    public function store(StoreRequest $request)
    {
        $refund = $this->refundRepository->save($request->all());

        return new RefundRequestLogResource($refund);
    }

    /**
     * Display the specified resource.
     *
     * @param RefundRequestLog $refund
     * @return RefundRequestLogResource
     */
    public function show(RefundRequestLog $refund)
    {
        return new RefundRequestLogResource($refund);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param RefundRequestLog $refund
     * @return RefundRequestLogResource
     */
    public function update(UpdateRequest $request, RefundRequestLog $refund)
    {
        $refund = $this->refundRepository->update($refund, $request->all());

        return new RefundRequestLogResource($refund);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RefundRequestLog $refund
     * @return JsonResponse
     */
    public function destroy(RefundRequestLog $refund)
    {
        $this->refundRepository->delete($refund);

        return response()->json(null, 204);
    }
}
