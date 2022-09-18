<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentItem;
use App\Http\Requests\PaymentItem\IndexRequest;
use App\Http\Requests\PaymentItem\StoreRequest;
use App\Http\Requests\PaymentItem\UpdateRequest;
use App\Http\Resources\PaymentItemResource;
use App\Http\Resources\PaymentItemResourceCollection;
use App\Repositories\Contracts\PaymentItemRepository;
use Illuminate\Http\JsonResponse;

class PaymentItemController extends Controller
{
    /**
     * @var PaymentItemRepository
     */
    protected $paymentItemRepository;

    /**
     * PaymentItemController constructor.
     * @param PaymentItemRepository $paymentItemRepository
     */
    public function __construct(PaymentItemRepository $paymentItemRepository)
    {
        $this->paymentItemRepository = $paymentItemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentItemResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $paymentItems = $this->paymentItemRepository->findBy($request->all());

        return new PaymentItemResourceCollection($paymentItems);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return array|Object|String
     */
    public function store(StoreRequest $request)
    {
        $paymentItem = $this->paymentItemRepository->generateTransaction($request->all());

        return new PaymentItemResource($paymentItem);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentItem $paymentItem
     * @return PaymentItemResource
     */
    public function show(PaymentItem $paymentItem)
    {
        return new PaymentItemResource($paymentItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PaymentItem $paymentItem
     * @return PaymentItemResource
     */
    public function update(UpdateRequest $request, PaymentItem $paymentItem)
    {
        $paymentItem = $this->paymentItemRepository->update($paymentItem, $request->all());

        return new PaymentItemResource($paymentItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentItem $paymentItem
     * @return JsonResponse
     */
    public function destroy(PaymentItem $paymentItem)
    {
        $this->paymentItemRepository->delete($paymentItem);

        return response()->json(null, 204);
    }

}
