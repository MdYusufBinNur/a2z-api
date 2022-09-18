<?php

namespace App\Http\Controllers;

use App\DbModels\OrderCashback;
use App\Http\Requests\OrderCashback\IndexRequest;
use App\Http\Requests\OrderCashback\StoreRequest;
use App\Http\Resources\CashbackAbleOrderProductResourceCollection;
use App\Http\Resources\OrderCashbackResource;
use App\Http\Resources\OrderCashbackResourceCollection;
use App\Repositories\Contracts\OrderCashbackRepository;
use Illuminate\Http\JsonResponse;

class OrderCashbackController extends Controller
{
    /**
     * @var OrderCashbackRepository
     */
    protected $orderCashbackRepository;

    /**
     * OrderCashbackController constructor.
     * @param OrderCashbackRepository $orderCashbackRepository
     */
    public function __construct(OrderCashbackRepository $orderCashbackRepository)
    {
        $this->orderCashbackRepository = $orderCashbackRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return OrderCashbackResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $orderCashBacks = $this->orderCashbackRepository->findBy($request->all());

        return new OrderCashbackResourceCollection($orderCashBacks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return OrderCashbackResource
     */
    public function store(StoreRequest $request)
    {
        $orderCashBack = $this->orderCashbackRepository->save($request->all());

        return new OrderCashbackResource($orderCashBack);
    }

    /**
     * Display the specified resource.
     *
     * @param OrderCashback $orderCashback
     * @return JsonResponse
     */
    public function show(OrderCashback $orderCashback)
    {
        $this->orderCashbackRepository->delete($orderCashback);

        return response()->json(null, 204);
    }

    /**
     * Display the specified resource.
     *
     * @param IndexRequest $request
     * @return CashbackAbleOrderProductResourceCollection
     */
    public function getCashbackAbleOrderLists(IndexRequest $request)
    {
        $cashbackAbleOrderLists = $this->orderCashbackRepository->getCashbackAbleOrderLists($request->all());

        return new CashbackAbleOrderProductResourceCollection($cashbackAbleOrderLists);
    }
}
