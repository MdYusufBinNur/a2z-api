<?php

namespace App\Http\Controllers;

use App\DbModels\IncomeCategory;
use App\Http\Requests\IncomeCategory\IndexRequest;
use App\Http\Requests\InventoryCategory\StoreRequest;
use App\Http\Requests\InventoryCategory\UpdateRequest;
use App\Http\Resources\InventoryCategoryResource;
use App\Http\Resources\InventoryCategoryResourceCollection;
use App\Repositories\Contracts\IncomeCategoryRepository;
use Illuminate\Auth\Access\AuthorizationException;

class IncomeCategoryController extends Controller
{
    /**
     * @var IncomeCategoryRepository
     */
    protected $incomeCategoryRepository;

    /**
     * IncomeCategoryController constructor.
     * @param IncomeCategoryRepository $incomeCategoryRepository
     */
    public function __construct(IncomeCategoryRepository $incomeCategoryRepository)
    {
        $this->incomeCategoryRepository = $incomeCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return InventoryCategoryResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [IncomeCategory::class, $request->input('propertyId')]);

        $incomeCategories = $this->incomeCategoryRepository->findBy($request->all());

        return new InventoryCategoryResourceCollection($incomeCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return InventoryCategoryResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [IncomeCategory::class, $request->input('propertyId')]);

        $incomeCategory = $this->incomeCategoryRepository->save($request->all());

        return new InventoryCategoryResource($incomeCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param IncomeCategory $incomeCategory
     * @return InventoryCategoryResource
     * @throws AuthorizationException
     */
    public function show(IncomeCategory $incomeCategory)
    {
        $this->authorize('show', $incomeCategory);

        return new InventoryCategoryResource($incomeCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param IncomeCategory $incomeCategory
     * @return InventoryCategoryResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, IncomeCategory $incomeCategory)
    {
        $this->authorize('update', $incomeCategory);

        $incomeCategory = $this->incomeCategoryRepository->update($incomeCategory,$request->all());

        return new InventoryCategoryResource($incomeCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param IncomeCategory $incomeCategory
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(IncomeCategory $incomeCategory)
    {
        $this->authorize('destroy', $incomeCategory);

        $this->incomeCategoryRepository->delete($incomeCategory);

        return response()->json(null, 204);
    }
}
