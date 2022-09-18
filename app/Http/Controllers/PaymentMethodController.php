<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentMethod;
use App\Http\Requests\PaymentMethod\IndexRequest;
use App\Http\Requests\PaymentMethod\StoreRequest;
use App\Http\Requests\PaymentMethod\UpdateRequest;
use App\Http\Resources\PaymentMethodResource;
use App\Http\Resources\PaymentMethodResourceCollection;
use App\Repositories\Contracts\PaymentMethodRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

class PaymentMethodController extends Controller
{
    /**
     * @var PaymentMethodRepository
     */
    protected $paymentMethodRepository;

    /**
     * PaymentMethodController constructor.
     * @param PaymentMethodRepository $paymentMethodRepository
     */
    public function __construct(PaymentMethodRepository $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentMethodResourceCollection
     */
    public function index(IndexRequest $request)
    {
//        $this->authorize('list', [PaymentMethod::class, $request->input('propertyId')]);

        $paymentMethods = $this->paymentMethodRepository->findBy($request->all());

        return new PaymentMethodResourceCollection($paymentMethods);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return PaymentMethodResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
//        $this->authorize('store', [PaymentMethod::class, $request->get('propertyId', null)]);

        $paymentMethod = $this->paymentMethodRepository->save($request->all());

        return new PaymentMethodResource($paymentMethod);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentMethod $paymentMethod
     * @return PaymentMethodResource
     * @throws AuthorizationException
     */
    public function show(PaymentMethod $paymentMethod)
    {
//        $this->authorize('show', $paymentMethod);

        return new PaymentMethodResource($paymentMethod);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PaymentMethod $paymentMethod
     * @return PaymentMethodResource
     */
    public function update(UpdateRequest $request, PaymentMethod $paymentMethod)
    {
//        $this->authorize('update', $paymentMethod);

        $paymentMethod = $this->paymentMethodRepository->update($paymentMethod, $request->all());

        return new PaymentMethodResource($paymentMethod);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentMethod $paymentMethod
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
//        $this->authorize('destroy', $paymentMethod);

        $this->paymentMethodRepository->delete($paymentMethod);

        return response()->json(null, 204);
    }
}
