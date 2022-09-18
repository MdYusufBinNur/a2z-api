<?php

namespace App\Http\Controllers;

use App\DbModels\SubCategory;
use App\Http\Resources\SubCategoryResource;
use App\Http\Requests\SubCategory\IndexRequest;
use App\Http\Requests\SubCategory\StoreRequest;
use App\Http\Requests\SubCategory\UpdateRequest;
use App\Http\Resources\SubCategoryResourceCollection;
use App\Repositories\Contracts\SubCategoryRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubCategoryController extends Controller
{
        /**
     * @var SubCategoryRepository
     */
    protected $subCategoryRepository;


    public function __construct(SubCategoryRepository $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return SubCategoryResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $subCategories = $this->subCategoryRepository->findBy($request->all());

        return new SubCategoryResourceCollection($subCategories);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return SubCategoryResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', SubCategory::class);

        $subCategory = $this->subCategoryRepository->save($request->all());

        return new SubCategoryResource($subCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param SubCategory $subCategory
     * @return SubCategoryResource
     */
    public function show(SubCategory $subCategory)
    {
        return new SubCategoryResource($subCategory);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param SubCategory $subCategory
     * @return SubCategoryResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, SubCategory $subCategory)
    {
        $this->authorize('update', $subCategory);

        $subCategory = $this->subCategoryRepository->update($subCategory, $request->all());

        return new SubCategoryResource($subCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SubCategory $subCategory
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(SubCategory $subCategory)
    {
        $this->authorize('destroy', $subCategory);

        $this->subCategoryRepository->delete($subCategory);

        return response()->json(null, 204);
    }
}
