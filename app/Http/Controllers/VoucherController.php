<?php

namespace App\Http\Controllers;

use App\DbModels\Voucher;
use App\Http\Requests\Voucher\IndexRequest;
use App\Http\Requests\Voucher\StoreRequest;
use App\Http\Requests\Voucher\UpdateRequest;
use App\Http\Resources\VoucherResource;
use App\Http\Resources\VoucherResourceCollection;
use App\Repositories\Contracts\VoucherRepository;
use Illuminate\Http\JsonResponse;


class VoucherController extends Controller
{
    protected $voucherRepository;

    public function __construct(VoucherRepository $voucherRepository)
    {
        $this->voucherRepository = $voucherRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return VoucherResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $request = $this->voucherRepository->findBy($request->all());
        return new VoucherResourceCollection($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return VoucherResource
     */
    public function store(StoreRequest $request)
    {
        $request = $this->voucherRepository->save($request->all());
        return new VoucherResource($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Voucher $voucher
     * @return VoucherResource
     */
    public function show(Voucher $voucher)
    {
        return new VoucherResource($voucher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Voucher $voucher
     * @return VoucherResource
     */
    public function update(UpdateRequest $request, Voucher $voucher)
    {
        $request = $this->voucherRepository->update($voucher, $request->all());
        return new VoucherResource($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Voucher $voucher
     * @return JsonResponse
     */
    public function destroy(Voucher $voucher)
    {
        $this->voucherRepository->delete($voucher);
        return response()->json(null,204);
    }
}
