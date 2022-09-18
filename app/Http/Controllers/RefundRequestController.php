<?php

namespace App\Http\Controllers;

use App\DbModels\RefundRequest;
use App\Http\Requests\RefundRequest\IndexRequest;
use App\Http\Requests\RefundRequest\StoreRequest;
use App\Http\Requests\RefundRequest\UpdateRequest;
use App\Http\Resources\RefundRequestResource;
use App\Http\Resources\RefundRequestResourceCollection;
use App\Repositories\Contracts\RefundRequestRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RefundRequestController extends Controller
{
    /**
     * @var RefundRequestRepository
     */
    protected $refundRequestRepository;

    public function __construct(RefundRequestRepository $refundRequestRepository)
    {
        $this->refundRequestRepository = $refundRequestRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return RefundRequestResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $refundRequests = $this->refundRequestRepository->findBy($request->all());

        return new RefundRequestResourceCollection($refundRequests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return RefundRequestResource
     */
    public function store(StoreRequest $request)
    {
        $refundRequest = $this->refundRequestRepository->save($request->all());

        return new RefundRequestResource($refundRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param RefundRequest $refundRequest
     * @return RefundRequestResource
     */
    public function show(RefundRequest $refundRequest)
    {
        return new RefundRequestResource($refundRequest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RefundRequest $refundRequest
     * @return RefundRequestResource
     */
    public function update(Request $request, RefundRequest $refundRequest)
    {
        $refundRequest = $this->refundRequestRepository->update($refundRequest, $request->all());

        return new RefundRequestResource($refundRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RefundRequest $refundRequest
     * @return JsonResponse
     */
    public function destroy(RefundRequest $refundRequest)
    {
        $this->refundRequestRepository->delete($refundRequest);

        return response()->json(null,  204);
    }
}
