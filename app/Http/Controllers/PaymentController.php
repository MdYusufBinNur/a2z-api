<?php

namespace App\Http\Controllers;

use App\DbModels\Payment;
use App\Http\Requests\Payment\DeleteRequest;
use App\Http\Requests\Payment\IndexRequest;
use App\Http\Requests\Payment\StoreRequest;
use App\Http\Requests\Payment\UpdateRequest;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\PaymentResourceCollection;
use App\Repositories\Contracts\PaymentRepository;
use Illuminate\Auth\Access\AuthorizationException;

class PaymentController extends Controller
{
    /**
     * @var PaymentRepository
     */
    protected $paymentRepository;

    /**
     * PaymentController constructor.
     * @param PaymentRepository $paymentRepository
     */
    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $allRequests = $request->all();

//        $this->authorize('list', [Payment::class);

        $payments = $this->paymentRepository->findBy($allRequests);

        return new PaymentResourceCollection($payments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PaymentResource
     */
    public function store(StoreRequest $request)
    {
        $allRequests = $request->all();

//        $this->authorize('store', [Payment::class, $allRequests['propertyId'], $allRequests['toUnitIds'] ?? [], $allRequests['toUserIds'] ?? []]);

        $payment = $this->paymentRepository->savePayment($allRequests);

        return new PaymentResource($payment);
    }

    /**
     * Display the specified resource.
     *
     * @param Payment $payment
     * @return PaymentResource
     * @throws AuthorizationException
     */
    public function show(Payment $payment)
    {
        $this->authorize('show', $payment);

        return new PaymentResource($payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Payment $payment
     * @return PaymentResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Payment $payment)
    {
        $this->authorize('update', $payment);

        $payment = $this->paymentRepository->updatePayment($payment, $request->all());

        return new PaymentResource($payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Payment $payment
     * @param DeleteRequest $request
     * @return PaymentResource
     * @throws AuthorizationException
     */
    public function destroy(DeleteRequest $request, Payment $payment)
    {
        $this->authorize('destroy', $payment);

        $this->paymentRepository->removePayment($payment);

        return response()->json(null, 204);
    }
}
