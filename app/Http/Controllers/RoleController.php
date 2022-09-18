<?php

namespace App\Http\Controllers;

use App\DbModels\Role;
use App\Http\Requests\Role\IndexRequest;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\RoleResourceCollection;
use App\Repositories\Contracts\RoleRepository;
use Illuminate\Auth\Access\AuthorizationException;

class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * RoleController constructor.
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return RoleResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [Role::class]);

        $roles = $this->roleRepository->findBy($request->all());

        return new RoleResourceCollection($roles);
    }

    /**
     * create a Role
     *
     * @param  StoreRequest $request
     * @return RoleResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [Role::class]);

        $role = $this->roleRepository->save($request->all());

        return new RoleResource($role);
    }

    /**
     * Display the specified Role resource.
     *
     * @param Role $role
     * @return RoleResource
     * @throws AuthorizationException
     */
    public function show(Role $role)
    {
        $this->authorize('show', $role);

        return new RoleResource($role);
    }

    /**
     * Update the specified Role resource in storage.
     *
     * @param UpdateRequest $request
     * @param Role $role
     * @return RoleResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Role $role)
    {
        $this->authorize('update', $role);

        $role = $this->roleRepository->update($role, $request->all());

        return new RoleResource($role);
    }

    /**
     * Remove the specified Role resource from storage.
     *
     * @param Role $role
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Role $role)
    {
        $this->authorize('destroy', $role);

        $this->roleRepository->delete($role);

        return response()->json(null, 204);
    }
}
