<?php

namespace App\Http\Controllers;

use App\DbModels\Brand;
use App\DbModels\ProductOffer;
use App\Http\Requests\ProductOffer\IndexRequest;
use App\Http\Requests\ProductOffer\StoreRequest;
use App\Http\Requests\ProductOffer\UpdateRequest;
use App\Http\Resources\ProductOfferResource;
use App\Http\Resources\ProductOfferResourceCollection;
use App\Repositories\Contracts\BrandRepository;
use App\Repositories\Contracts\ProductOfferRepository;
use http\Message;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductOfferController extends Controller
{
    /**
     * @var BrandRepository
     */
    protected $productOfferRepository;

    /**
     * BrandController constructor.
     * @param ProductOfferRepository $productOfferRepository
     */
    public function __construct(ProductOfferRepository $productOfferRepository)
    {
        $this->productOfferRepository = $productOfferRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ProductOfferResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $productOffers = $this->productOfferRepository->findBy($request->all());

        return new ProductOfferResourceCollection($productOffers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return ProductOfferResourceCollection
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', ProductOffer::class);

        $productOffers = $this->productOfferRepository->saveProductOffer($request->all());

        return new ProductOfferResourceCollection($productOffers);
    }

    /**
     * Display the specified resource.
     *
     * @param Brand $brand
     * @return ProductOfferResource
     */
    public function show(Brand $brand)
    {
        return new ProductOfferResource($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ProductOffer $productOffer
     * @return ProductOfferResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ProductOffer $productOffer)
    {
        $this->authorize('update', $productOffer);

        $productOffer = $this->productOfferRepository->update($productOffer, $request->all());

        return new ProductOfferResource($productOffer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductOffer $productOffer
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(ProductOffer $productOffer)
    {
        $this->authorize('destroy', $productOffer);

        $this->productOfferRepository->delete($productOffer);

        return response()->json(null, 204);
    }
}
