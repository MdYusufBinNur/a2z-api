<?php

namespace App\Http\Controllers;

use App\DbModels\Income;
use App\Http\Requests\Income\IndexRequest;
use App\Http\Requests\Income\StoreRequest;
use App\Http\Requests\Income\UpdateRequest;
use App\Http\Resources\IncomeResource;
use App\Http\Resources\IncomeResourceCollection;
use App\Repositories\Contracts\IncomeRepository;
use Illuminate\Auth\Access\AuthorizationException;

class IncomeController extends Controller
{
    /**
     * @var IncomeRepository
     */
    protected $incomeRepository;

    /**
     * IncomeController constructor.
     * @param IncomeRepository $incomeRepository
     */
    public function __construct(IncomeRepository $incomeRepository)
    {
        $this->incomeRepository = $incomeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return IncomeResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [Income::class, $request->input('propertyId')]);

        $incomes = $this->incomeRepository->findBy($request->all());

        return new IncomeResourceCollection($incomes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return IncomeResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [Income::class, $request->input('propertyId')]);

        $income = $this->incomeRepository->save($request->all());

        return new IncomeResource($income);
    }

    /**
     * Display the specified resource.
     *
     * @param Income $income
     * @return IncomeResource
     * @throws AuthorizationException
     */
    public function show(Income $income)
    {
        $this->authorize('show', $income);

        return new IncomeResource($income);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Income $income
     * @return IncomeResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Income $income)
    {
        $this->authorize('update', $income);

        $income = $this->incomeRepository->update($income, $request->all());

        return new IncomeResource($income);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Income $income
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(Income $income)
    {
        $this->authorize('destroy', $income);

        $this->incomeRepository->delete($income);

        return response()->json(null, 204);
    }
}
