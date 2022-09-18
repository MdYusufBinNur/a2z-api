<?php

namespace App\Http\Controllers;

use App\DbModels\ProductStockInLog;
use App\Http\Requests\ProductStockInLog\IndexRequest;
use App\Http\Requests\ProductStockInLog\StoreRequest;
use App\Http\Requests\ProductStockInLog\UpdateRequest;
use App\Http\Resources\ProductStockInLogResource;
use App\Http\Resources\ProductStockInLogResourceCollection;
use App\Repositories\Contracts\ProductStockInLogRepository;
use Illuminate\Auth\Access\AuthorizationException;

class ProductStockInLogController extends Controller
{
    /**
     * @var ProductStockInLog
     */
    protected $productStockInLogRepository;

    /**
     * UserController constructor.
     *
     * @param ProductStockInLogRepository $productStockInLogRepository
     */
    public function __construct(ProductStockInLogRepository $productStockInLogRepository)
    {
        $this->productStockInLogRepository = $productStockInLogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ProductStockInLogResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', ProductStockInLog::class);

        $request = $this->productStockInLogRepository->findBy($request->all());
        return new ProductStockInLogResourceCollection($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return ProductStockInLogResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', ProductStockInLog::class);

        $request = $this->productStockInLogRepository->save($request->all());
        return new ProductStockInLogResource($request);
    }

    /**
     * Display the specified resource.
     *
     * @param ProductStockInLog $productStockInLog
     * @return ProductStockInLogResource
     * @throws AuthorizationException
     */
    public function show(ProductStockInLog $productStockInLog)
    {
        $this->authorize('show', $productStockInLog);

        return new ProductStockInLogResource($productStockInLog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ProductStockInLog $productStockInLog
     * @return ProductStockInLogResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ProductStockInLog $productStockInLog)
    {
        $this->authorize('update', $productStockInLog);

        $previousProductStockInLog = $this->productStockInLogRepository->findOneBy(['productId' => $request['productId']], false, true);

        if ($previousProductStockInLog instanceof ProductStockInLog && $productStockInLog->id != $previousProductStockInLog->id) {
            return response()->json(['status' => 409, 'message' => 'Update Failed, Resource Update has an conflict issues.'], 409);
        }

        $request = $this->productStockInLogRepository->update($previousProductStockInLog, $request->all());

        return new ProductStockInLogResource($request);
    }
}
