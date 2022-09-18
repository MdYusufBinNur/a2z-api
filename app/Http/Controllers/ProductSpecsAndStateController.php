<?php

namespace App\Http\Controllers;

use App\DbModels\ProductSpecsAndState;
use App\Http\Requests\ProductSpecsAndState\IndexRequest;
use App\Http\Requests\ProductSpecsAndState\StoreRequest;
use App\Http\Requests\ProductSpecsAndState\UpdateRequest;
use App\Http\Resources\ProductSpecsAndStateResource;
use App\Http\Resources\ProductSpecsAndStateResourceCollection;
use App\Repositories\Contracts\ProductSpecsAndStateRepository;
use Illuminate\Auth\Access\AuthorizationException;

class ProductSpecsAndStateController extends Controller
{
    /**
     * @var ProductSpecsAndStateRepository
     */
    protected $productSpecsAndStateRepository;

    /**
     * ProductSpecsAndStateController constructor.
     * @param ProductSpecsAndStateRepository $productSpecsAndStateRepository
     */
    public function __construct(ProductSpecsAndStateRepository $productSpecsAndStateRepository)
    {
        $this->productSpecsAndStateRepository = $productSpecsAndStateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ProductSpecsAndStateResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $productSpecsAndStates = $this->productSpecsAndStateRepository->findBy($request->all());

        return new ProductSpecsAndStateResourceCollection($productSpecsAndStates);
    }

    /**
     * Display a listing of the resource.
     *
     * @param StoreRequest $request
     * @return ProductSpecsAndStateResource
     */
    public function store(StoreRequest $request)
    {
        $productSpecsAndState = $this->productSpecsAndStateRepository->save($request->all());

        return new ProductSpecsAndStateResource($productSpecsAndState);
    }

    /**
     * Display the specified resource.
     *
     * @param ProductSpecsAndState $productSpecsAndState
     * @return ProductSpecsAndStateResource
     */
    public function show(ProductSpecsAndState  $productSpecsAndState)
    {
        return new ProductSpecsAndStateResource($productSpecsAndState);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ProductSpecsAndState $productSpecsAndState
     * @return ProductSpecsAndStateResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ProductSpecsAndState $productSpecsAndState)
    {
        $this->authorize('destroy', $productSpecsAndState);

        $this->productSpecsAndStateRepository->update($productSpecsAndState, $request->all());

        return new ProductSpecsAndStateResource($productSpecsAndState);
    }
}
