<?php

namespace App\Http\Controllers;

use App\DbModels\ProductReturnAndDeliveryOption;
use App\Http\Requests\ProductReturnAndDeliveryOption\IndexRequest;
use App\Http\Requests\ProductReturnAndDeliveryOption\StoreRequest;
use App\Http\Requests\ProductReturnAndDeliveryOption\UpdateRequest;
use App\Http\Resources\ProductReturnAndDeliveryOptionResource;
use App\Http\Resources\ProductReturnAndDeliveryOptionResourceCollection;
use App\Repositories\Contracts\ProductReturnAndDeliveryOptionRepository;
use Illuminate\Http\JsonResponse;


class ProductReturnAndDeliveryOptionController extends Controller
{
    /**
     * @var ProductReturnAndDeliveryOptionRepository
     */
    protected $productReturnAndDeliveryOptionRepository;

    /**
     * ProductReturnAndDeliveryOptionController constructor.
     * @param ProductReturnAndDeliveryOptionRepository $productReturnAndDeliveryOptionRepository
     */
    public function __construct(ProductReturnAndDeliveryOptionRepository $productReturnAndDeliveryOptionRepository)
    {
        $this->productReturnAndDeliveryOptionRepository = $productReturnAndDeliveryOptionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ProductReturnAndDeliveryOptionResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $productReturnAndDeliveryOptions = $this->productReturnAndDeliveryOptionRepository->findBy($request->all());

        return new ProductReturnAndDeliveryOptionResourceCollection($productReturnAndDeliveryOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return ProductReturnAndDeliveryOptionResource
     */
    public function store(StoreRequest $request)
    {
        $productReturnAndDeliveryOption = $this->productReturnAndDeliveryOptionRepository->save($request->all());

        return new ProductReturnAndDeliveryOptionResource($productReturnAndDeliveryOption);
    }

    /**
     * Display the specified resource.
     *
     * @param  ProductReturnAndDeliveryOption  $productReturnAndDeliveryOption
     * @return ProductReturnAndDeliveryOptionResource
     */
    public function show(ProductReturnAndDeliveryOption $productReturnAndDeliveryOption)
    {
        return new ProductReturnAndDeliveryOptionResource($productReturnAndDeliveryOption);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ProductReturnAndDeliveryOption $productReturnAndDeliveryOption
     * @return ProductReturnAndDeliveryOptionResource
     */
    public function update(UpdateRequest $request, ProductReturnAndDeliveryOption $productReturnAndDeliveryOption)
    {
        $productReturnAndDeliveryOption = $this->productReturnAndDeliveryOptionRepository->update($productReturnAndDeliveryOption, $request->all());

        return new ProductReturnAndDeliveryOptionResource($productReturnAndDeliveryOption);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ProductReturnAndDeliveryOption  $productReturnAndDeliveryOption
     * @return JsonResponse
     */
    public function destroy(ProductReturnAndDeliveryOption $productReturnAndDeliveryOption)
    {
        $this->productReturnAndDeliveryOptionRepository->delete($productReturnAndDeliveryOption);

        return response()->json(null, 204);
    }
}
