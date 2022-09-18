<?php

namespace App\Http\Controllers;

use App\DbModels\ExpenseCategory;
use App\Http\Requests\ExpenseCategory\IndexRequest;
use App\Http\Requests\ExpenseCategory\StoreRequest;
use App\Http\Requests\ExpenseCategory\UpdateRequest;
use App\Http\Resources\ExpenseCategoryResource;
use App\Http\Resources\ExpenseCategoryResourceCollection;
use App\Repositories\Contracts\ExpenseCategoryRepository;
use Illuminate\Auth\Access\AuthorizationException;

class ExpenseCategoryController extends Controller
{
    /**
     * @var ExpenseCategoryRepository
     */
    protected $expenseCategoryRepository;

    /**
     * ExpenseCategoryController constructor.
     * @param ExpenseCategoryRepository $expenseCategoryRepository
     */
    public function __construct(ExpenseCategoryRepository $expenseCategoryRepository)
    {
        $this->expenseCategoryRepository = $expenseCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ExpenseCategoryResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [ExpenseCategory::class, $request->input('propertyId')]);

        $expenseCategories = $this->expenseCategoryRepository->findBy($request->all());

        return new ExpenseCategoryResourceCollection($expenseCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ExpenseCategoryResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [ExpenseCategory::class, $request->input('propertyId')]);

        $expenseCategory = $this->expenseCategoryRepository->save($request->all());

        return new ExpenseCategoryResource($expenseCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param ExpenseCategory $expenseCategory
     * @return ExpenseCategoryResource
     * @throws AuthorizationException
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        $this->authorize('show', $expenseCategory);

        return new ExpenseCategoryResource($expenseCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ExpenseCategory $expenseCategory
     * @return ExpenseCategoryResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ExpenseCategory $expenseCategory)
    {
        $this->authorize('update', $expenseCategory);

        $expenseCategory = $this->expenseCategoryRepository->update($expenseCategory, $request->all());

        return new ExpenseCategoryResource($expenseCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ExpenseCategory $expenseCategory
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        $this->authorize('destroy', $expenseCategory);

        $this->expenseCategoryRepository->delete($expenseCategory);

        return response()->json(null, 204);
    }
}
