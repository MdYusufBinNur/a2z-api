<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentLog;
use App\Http\Requests\PaymentLog\IndexRequest;
use App\Http\Requests\PaymentLog\StoreRequest;
use App\Http\Requests\PaymentLog\UpdateRequest;
use App\Http\Resources\PaymentLogResource;
use App\Http\Resources\PaymentLogResourceCollection;
use App\Repositories\Contracts\PaymentLogRepository;

class PaymentLogController extends Controller
{
    /**
     * @var PaymentLogRepository
     */
    protected $paymentItemLogRepository;

    /**
     * PaymentItemLogController constructor.
     * @param PaymentLogRepository $paymentItemLogRepository
     */
    public function __construct(PaymentLogRepository $paymentItemLogRepository)
    {
        $this->paymentItemLogRepository = $paymentItemLogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentLogResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $paymentItemLogs = $this->paymentItemLogRepository->findBy($request->all());

        return new PaymentLogResourceCollection($paymentItemLogs);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentLog $paymentItemLog
     * @return PaymentLogResource
     */
    public function show(PaymentLog $paymentItemLog)
    {
        return new PaymentLogResource($paymentItemLog);
    }
}
