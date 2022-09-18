<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentTransaction;
use App\Http\Requests\PaymentTransaction\IndexRequest;
use App\Http\Requests\PaymentTransaction\NotifyRequest;
use App\Http\Requests\PaymentTransaction\StoreRequest;
use App\Http\Requests\PaymentTransaction\UpdateRequest;
use App\Http\Requests\Request;
use App\Http\Resources\PaymentItemResource;
use App\Http\Resources\PaymentTransactionResource;
use App\Http\Resources\PaymentTransactionResourceCollection;
use App\Repositories\Contracts\PaymentTransactionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class
PaymentTransactionController extends Controller
{
    /**
     * @var PaymentTransactionRepository
     */
    protected $paymentTransactionRepository;

    /**
     * PaymentItemTransactionController constructor.
     * @param PaymentTransactionRepository $paymentTransactionRepository
     */
    public function __construct(PaymentTransactionRepository $paymentTransactionRepository)
    {
        $this->paymentTransactionRepository = $paymentTransactionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentTransactionResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $paymentTransactions = $this->paymentTransactionRepository->findBy($request->all());

        return new PaymentTransactionResourceCollection($paymentTransactions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return PaymentTransactionResource
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store' , [PaymentTransaction::class, $request->get('paymentId')]);

        $paymentTransaction = $this->paymentTransactionRepository->save($request->all());

        return new PaymentTransactionResource($paymentTransaction);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentTransaction $paymentTransaction
     * @return PaymentTransactionResource
     */
    public function show(PaymentTransaction $paymentTransaction)
    {
        return new PaymentTransactionResource($paymentTransaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PaymentTransaction $paymentTransaction
     * @return PaymentTransactionResource
     */
    public function update(UpdateRequest $request, PaymentTransaction $paymentTransaction)
    {
        $this->authorize('update', $paymentTransaction);

        $paymentTransaction = $this->paymentTransactionRepository->update($paymentTransaction, $request->all());

        return new PaymentTransactionResource($paymentTransaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentTransaction $paymentTransaction
     * @return Response
     */
    public function destroy(PaymentTransaction $paymentTransaction)
    {
        $this->authorize('destroy', $paymentTransaction);

        $this->paymentTransactionRepository->delete($paymentTransaction);

        return response()->json(null, 204);
    }


    /**
     * notify a transaction
     *
     * @param NotifyRequest $request
     * @return PaymentTransactionResource
     */
    public function notify(NotifyRequest $request)
    {
        $paymentTransaction = $this->paymentTransactionRepository->findOneBy(['providerName' => $request->get('providerName'), 'providerId' => $request->get('providerId')]);

        if (!$paymentTransaction instanceof PaymentTransaction) {
            return response()->json(['status' => 404, 'message' => 'Resource not found with the specific id.'], 404);
        }

        $this->paymentTransactionRepository->updateTransaction($paymentTransaction, $request->get('providerId'));

        return new PaymentTransactionResource($paymentTransaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function aamarpaySuccess(\Illuminate\Http\Request $request)
    {
        $response = $this->paymentTransactionRepository->aamarpaySuccessfulPayment($request->all());
        $url = config('app.pgw_callback_url') . $response['invoice'];
        return redirect()->away($url);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function aamarpayFailed(\Illuminate\Http\Request $request)
    {
        $response = $this->paymentTransactionRepository->aamarpayFailedPayment($request->all());

        return response()->json($response, 200);
    }

}
