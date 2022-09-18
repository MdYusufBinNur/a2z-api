<?php

namespace App\Http\Controllers;

use App\DbModels\Expense;
use App\Http\Requests\Expense\IndexRequest;
use App\Http\Requests\Expense\StoreRequest;
use App\Http\Requests\Expense\UpdateRequest;
use App\Http\Resources\ExpenseResource;
use App\Http\Resources\ExpenseResourceCollection;
use App\Repositories\Contracts\ExpenseRepository;
use Illuminate\Auth\Access\AuthorizationException;

class ExpenseController extends Controller
{

    /**
     * @var ExpenseRepository
     */
    protected $expenseRepository;

    public function __construct(ExpenseRepository $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ExpenseResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [Expense::class, $request->input('propertyId')]);

        $expenses = $this->expenseRepository->findBy($request->all());

        return new ExpenseResourceCollection($expenses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return ExpenseResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [Expense::class, $request->input('propertyId')]);

        $expense = $this->expenseRepository->save($request->all());

        return new ExpenseResource($expense);
    }

    /**
     * Display the specified resource.
     *
     * @param Expense $expense
     * @return ExpenseResource
     * @throws AuthorizationException
     */
    public function show(Expense $expense)
    {
        $this->authorize('show', $expense);

        return new ExpenseResource($expense);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Expense $expense
     * @return ExpenseResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Expense $expense)
    {
        $this->authorize('update', $expense);

        $expense = $this->expenseRepository->update($expense, $request->all());

        return new ExpenseResource($expense);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Expense $expense
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Expense $expense)
    {
        $this->authorize('destroy', $expense);

        $this->expenseRepository->delete($expense);

        return response()->json(null, 204);
    }
}
