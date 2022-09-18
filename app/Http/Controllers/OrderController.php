<?php

namespace App\Http\Controllers;

use App\DbModels\Order;
use App\Http\Requests\Order\IndexRequest;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Requests\Order\UpdateRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderResourceCollection;
use App\Repositories\Contracts\OrderRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     * @param IndexRequest $request
     * @return OrderResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list',  [Order::class, $request->input('createdByUserId')]);

        $orders = $this->orderRepository->findBy($request->all());
        return new OrderResourceCollection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return OrderResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store',  [Order::class, $request->input('createdByUserId')]);

        $order = $this->orderRepository->save($request->all());

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     *
     * @param $invoice
     * @return JsonResponse|OrderResource
     * @throws AuthorizationException
     */
    public function show($invoice)
    {
        $order = $this->orderRepository->findOneBy(['invoice' => $invoice]);

        if (!$order instanceof Order) {
            return response()->json(['status' => 404, 'message' => 'Resource not found with the specific invoice.'], 404);
        }

        $this->authorize('show', $order);

        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Order $order
     * @return OrderResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Order $order)
    {
        $this->authorize('update', $order);

        $order = $this->orderRepository->update($order, $request->all());
        return new OrderResource($order);
    }
}
