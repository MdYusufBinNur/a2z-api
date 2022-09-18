<?php

namespace App\Http\Controllers;

use App\DbModels\UserRole;
use App\Http\Requests\UserRole\IndexRequest;
use App\Http\Requests\UserRole\StoreRequest;
use App\Http\Requests\UserRole\UpdateRequest;
use App\Http\Resources\UserRoleResource;
use App\Http\Resources\UserRoleResourceCollection;
use App\Repositories\Contracts\UserRoleRepository;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * @var UserRoleRepository
     */
    protected $userRoleRepository;

    /**
     * UserRoleController constructor.
     * @param UserRoleRepository $userRoleRepository
     */
    public function __construct(UserRoleRepository $userRoleRepository)
    {
        $this->userRoleRepository = $userRoleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return UserRoleResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $userRoles = $this->userRoleRepository->findBy($request->all());

        return new UserRoleResourceCollection($userRoles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return UserRoleResource
     */
    public function store(StoreRequest $request)
    {
        $userRole = $this->userRoleRepository->save($request->all());

        return new UserRoleResource($userRole);
    }

    /**
     * Display the specified resource.
     *
     * @param UserRole $userRole
     * @return UserRoleResource
     */
    public function show(UserRole $userRole)
    {
        return new UserRoleResource($userRole);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UserRole $userRole
     * @return UserRoleResource
     */
    public function update(UpdateRequest $request, UserRole $userRole)
    {
        $userRole = $this->userRoleRepository->update($userRole, $request->all());

        return new UserRoleResource($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserRole $userRole
     * @return void
     */
    public function destroy(UserRole $userRole)
    {
        $this->userRoleRepository->delete($userRole);

        return response()->json(null, 204);
    }
}
