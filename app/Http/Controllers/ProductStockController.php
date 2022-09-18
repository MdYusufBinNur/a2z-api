<?php

namespace App\Http\Controllers;

use App\DbModels\ProductStock;
use App\Http\Requests\ProductStock\IndexRequest;
use App\Http\Requests\ProductStock\StoreRequest;
use App\Http\Requests\ProductStock\UpdateRequest;
use App\Http\Resources\ProductStockResource;
use App\Http\Resources\ProductStockResourceCollection;
use App\Repositories\Contracts\ProductStockRepository;
use Illuminate\Auth\Access\AuthorizationException;


class ProductStockController extends Controller
{
    /**
     * @var ProductStock
     */
    protected $productStockRepository;

    /**
     * UserController constructor.
     *
     * @param ProductStockRepository $productStockRepository
     */
    public function __construct(ProductStockRepository $productStockRepository)
    {
        $this->productStockRepository = $productStockRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ProductStockResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', ProductStock::class);

        $request = $this->productStockRepository->findBy($request->all());
        return new ProductStockResourceCollection($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return ProductStockResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [ProductStock::class]);

        $request = $this->productStockRepository->save($request->all());
        return new ProductStockResource($request);
    }

    /**
     * Display the specified resource.
     *
     * @param ProductStock $productStock
     * @return ProductStockResource
     * @throws AuthorizationException
     */
    public function show(ProductStock $productStock)
    {
        $this->authorize('show', $productStock);

        return new ProductStockResource($productStock);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ProductStock $productStock
     * @return ProductStockResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ProductStock $productStock)
    {
        $this->authorize('update', $productStock);

        $request = $this->productStockRepository->update($productStock,$request->all());
        return new ProductStockResource($request);
    }
}
