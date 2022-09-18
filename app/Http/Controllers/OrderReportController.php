<?php

namespace App\Http\Controllers;

use App\DbModels\OrderReport;
use App\Http\Requests\OrderReport\IndexRequest;
use App\Http\Requests\OrderReport\StoreRequest;
use App\Http\Requests\OrderReport\UpdateRequest;
use App\Http\Resources\OrderReportResource;
use App\Http\Resources\OrderReportResourceCollection;
use App\Repositories\Contracts\OrderReportRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class OrderReportController extends Controller
{
    /**
     * @var OrderReportRepository
     */
    protected $orderReportRepository;

    /**
     * OrderReportController constructor.
     * @param OrderReportRepository $orderReportRepository
     */
    public function __construct(OrderReportRepository $orderReportRepository)
    {
        $this->orderReportRepository = $orderReportRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return OrderReportResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [OrderReport::class, $request->input('createdByUserId')]);

        $orderReports = $this->orderReportRepository->findBy($request->all());

        return new OrderReportResourceCollection($orderReports);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return OrderReportResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [OrderReport::class, $request->input('createdByUserId')]);

        $orderReport = $this->orderReportRepository->save($request->all());

        return new OrderReportResource($orderReport);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param OrderReport $orderReport
     * @return OrderReportResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, OrderReport $orderReport)
    {
        $this->authorize('update', $orderReport);
        $orderReport = $this->orderReportRepository->update($orderReport, $request->all());

        return new OrderReportResource($orderReport);
    }

    /**
     * Display the specified resource.
     *
     * @param OrderReport $orderReport
     * @return OrderReportResource
     * @throws AuthorizationException
     */
    public function show(OrderReport $orderReport)
    {
        $this->authorize('show', $orderReport);

        return new OrderReportResource($orderReport);
    }

    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function reportTypes()
    {
        return response()->json(OrderReport::getReportTypes(), 200);
    }
}
