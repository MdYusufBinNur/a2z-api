<?php

namespace App\Http\Controllers;

use App\DbModels\OrderType;
use App\Http\Requests\OrderType\IndexRequest;
use App\Http\Requests\OrderType\StoreRequest;
use App\Http\Requests\OrderType\UpdateRequest;
use App\Http\Resources\OrderTypeResource;
use App\Http\Resources\OrderTypeResourceCollection;
use App\Repositories\Contracts\OrderTypeRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderTypeController extends Controller
{
    /**
     * @var OrderTypeRepository
     */
    protected $orderTypeRepository;

    /**
     * OrderTypeController constructor.
     * @param OrderTypeRepository $orderTypeRepository
     */
    public function __construct(OrderTypeRepository $orderTypeRepository)
    {
        $this->orderTypeRepository = $orderTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return OrderTypeResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', OrderType::class);
        $orderTypes = $this->orderTypeRepository->findBy($request->all());

        return new OrderTypeResourceCollection($orderTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return OrderTypeResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', OrderType::class);
        $orderType = $this->orderTypeRepository->save($request->all());

        return new OrderTypeResource($orderType);
    }

    /**
     * Display the specified resource.
     *
     * @param OrderType $orderType
     * @return OrderTypeResource
     * @throws AuthorizationException
     */
    public function show(OrderType $orderType)
    {
        $this->authorize('show', $orderType);

        return new OrderTypeResource($orderType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param OrderType $orderType
     * @return OrderTypeResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, OrderType $orderType)
    {
        $this->authorize('update', $orderType);
        $orderType = $this->orderTypeRepository->update($orderType, $request->all());

        return new OrderTypeResource($orderType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param OrderType $orderType
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(OrderType $orderType)
    {
        $this->authorize('delete', $orderType);

        $this->orderTypeRepository->delete($orderType);

        return response()->json(null, 204);
    }
}
