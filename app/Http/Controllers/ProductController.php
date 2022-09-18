<?php

namespace App\Http\Controllers;

use App\DbModels\Product;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Requests\Product\IndexRequest;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductResourceCollection;
use App\Repositories\Contracts\ProductRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * ProductController constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ProductResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $products = $this->productRepository->findBy($request->all());

        return new ProductResourceCollection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return ProductResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', Product::class);

        $product = $this->productRepository->save($request->all());

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Product $product
     * @return ProductResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $product = $this->productRepository->update($product, $request->all());

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Product $product)
    {
        $this->authorize('destroy', $product);

        $this->productRepository->delete($product);

        return response()->json(null, 204);
    }
}
