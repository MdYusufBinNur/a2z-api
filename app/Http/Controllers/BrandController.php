<?php

namespace App\Http\Controllers;

use App\DbModels\Brand;
use App\Http\Requests\Brand\IndexRequest;
use App\Http\Requests\Brand\StoreRequest;
use App\Http\Requests\Brand\UpdateRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\BrandResourceCollection;
use App\Repositories\Contracts\BrandRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    /**
     * @var BrandRepository
     */
    protected $brandRepository;

    /**
     * BrandController constructor.
     * @param BrandRepository $brandRepository
     */
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return BrandResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $brands = $this->brandRepository->findBy($request->all());

        return new BrandResourceCollection($brands);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return BrandResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', Brand::class);

        $brand = $this->brandRepository->save($request->all());

        return new BrandResource($brand);
    }

    /**
     * Display the specified resource.
     *
     * @param Brand $brand
     * @return BrandResource
     */
    public function show(Brand $brand)
    {
        return new BrandResource($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Brand $brand
     * @return BrandResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Brand $brand)
    {
        $this->authorize('update', $brand);

        $brand = $this->brandRepository->update($brand, $request->all());

        return new BrandResource($brand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Brand $brand
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Brand $brand)
    {
        $this->authorize('destroy', $brand);

        $this->brandRepository->delete($brand);

        return response()->json(null, 204);
    }
}
