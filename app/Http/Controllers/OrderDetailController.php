<?php

namespace App\Http\Controllers;

use App\DbModels\OrderDetail;
use App\Http\Requests\OrderDetail\IndexRequest;
use App\Http\Resources\CashbackAbleOrderProductResourceCollection;
use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\OrderDetailResourceCollection;
use App\Repositories\Contracts\OrderDetailRepository;
use Illuminate\Auth\Access\AuthorizationException;


class OrderDetailController extends Controller
{
    /**
     * @var OrderDetailRepository
     */
    protected $orderDetailRepository;

    /**
     * OrderDetailController constructor.
     * @param OrderDetailRepository $orderDetailRepository
     */
    public function __construct(OrderDetailRepository $orderDetailRepository)
    {
        $this->orderDetailRepository = $orderDetailRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return OrderDetailResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [OrderDetail::class, $request->input('createdByUserId')]);

        $orderDetails = $this->orderDetailRepository->findBy($request->all());
        return new OrderDetailResourceCollection($orderDetails);
    }

    /**
     * Display the specified resource.
     *
     * @param OrderDetail $orderDetail
     * @return OrderDetailResource
     * @throws AuthorizationException
     */
    public function show(OrderDetail $orderDetail)
    {
        $this->authorize('show', $orderDetail);

        return new OrderDetailResource($orderDetail);
    }
}
