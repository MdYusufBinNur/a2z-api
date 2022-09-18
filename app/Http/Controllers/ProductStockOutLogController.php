<?php

namespace App\Http\Controllers;

use App\DbModels\ProductStockOutLog;
use App\Http\Requests\ProductStockOutLog\IndexRequest;
use App\Http\Requests\ProductStockOutLog\StoreRequest;
use App\Http\Requests\ProductStockOutLog\UpdateRequest;
use App\Http\Resources\ProductStockOutLogResource;
use App\Http\Resources\ProductStockOutLogResourceCollection;
use App\Repositories\Contracts\ProductStockOutLogRepository;
use Illuminate\Auth\Access\AuthorizationException;


class ProductStockOutLogController extends Controller
{
    /**
     * @var ProductStockOutLog
     */
    protected $productStockOutLogRepository;

    /**
     * BrandController constructor.
     * @param ProductStockOutLogRepository $productStockOutLogRepository
     */
    public function __construct(ProductStockOutLogRepository $productStockOutLogRepository)
    {
        $this->productStockOutLogRepository = $productStockOutLogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ProductStockOutLogResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', ProductStockOutLog::class);

        $request = $this->productStockOutLogRepository->findBy($request->all());
        return new ProductStockOutLogResourceCollection($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return ProductStockOutLogResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', ProductStockOutLog::class);

        $request = $this->productStockOutLogRepository->save($request->all());
        return new ProductStockOutLogResource($request);
    }

    /**
     * Display the specified resource.
     *
     * @param ProductStockOutLog $productStockOutLog
     * @return ProductStockOutLogResource
     * @throws AuthorizationException
     */
    public function show(ProductStockOutLog $productStockOutLog)
    {
        $this->authorize('show', $productStockOutLog);

        return new ProductStockOutLogResource($productStockOutLog);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ProductStockOutLog $productStockOutLog
     * @return ProductStockOutLogResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ProductStockOutLog $productStockOutLog)
    {
        $this->authorize('update', $productStockOutLog);

        $productStockOutLog = $this->productStockOutLogRepository->update($productStockOutLog,$request->all());
        
        return new ProductStockOutLogResource($productStockOutLog);
    }
}
