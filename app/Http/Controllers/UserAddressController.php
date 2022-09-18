<?php

namespace App\Http\Controllers;

use App\DbModels\UserAddress;
use App\Http\Requests\UserAddress\IndexRequest;
use App\Http\Requests\UserAddress\StoreRequest;
use App\Http\Requests\UserAddress\UpdateRequest;
use App\Http\Resources\UserAddressResource;
use App\Http\Resources\UserAddressResourceCollection;
use App\Repositories\Contracts\UserAddressRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserAddressController extends Controller
{
    /**
     * @var UserAddressRepository
     */
    protected $userAddressRepository;

    /**
     * UserAddressController constructor.
     * @param UserAddressRepository $userAddressRepository
     */
    public function __construct(UserAddressRepository $userAddressRepository)
    {
        $this->userAddressRepository =$userAddressRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return UserAddressResourceCollection
     */
    public function index(IndexRequest $request): UserAddressResourceCollection
    {
        $this->authorize('list', [UserAddress::class, $request->get('userId')]);

        $userAddresses = $this->userAddressRepository->findBy($request->all());

        return new UserAddressResourceCollection($userAddresses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return UserAddressResource
     */
    public function store(StoreRequest $request): UserAddressResource
    {
        $this->authorize('store', [UserAddress::class, $request->get('userId')]);

        $userAddress = $this->userAddressRepository->save($request->all());

        return new UserAddressResource($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param UserAddress $userAddress
     * @return UserAddressResource
     */
    public function show(UserAddress $userAddress): UserAddressResource
    {
        $this->authorize('show', $userAddress);

        return new UserAddressResource($userAddress);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UserAddress $userAddress
     * @return UserAddressResource
     */
    public function update(UpdateRequest $request, UserAddress $userAddress): UserAddressResource
    {
        $this->authorize('update', $userAddress);

        $userAddress = $this->userAddressRepository->update($userAddress, $request->all());

        return new UserAddressResource($userAddress);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserAddress $userAddress
     * @return JsonResponse
     */
    public function destroy(UserAddress $userAddress)
    {
        $this->authorize('destroy', $userAddress);

        $this->userAddressRepository->delete($userAddress);

        return response()->json(null, 204);
    }
}
