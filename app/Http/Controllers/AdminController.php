<?php

namespace App\Http\Controllers;

use App\DbModels\Admin;
use App\Http\Requests\Admin\DestroyRequest;
use App\Http\Requests\Admin\IndexRequest;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Http\Resources\AdminResource;
use App\Http\Resources\AdminResourceCollection;
use App\Repositories\Contracts\AdminRepository;
use Illuminate\Auth\Access\AuthorizationException;

class AdminController extends Controller
{
    /**
     * @var AdminRepository
     */
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return AdminResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', Admin::class);

        $admins = $this->adminRepository->findBy($request->all());

        return new AdminResourceCollection($admins);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return AdminResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [Admin::class, $request->get('level', Admin::LEVEL_STANDARD)]);

        $admin = $this->adminRepository->save($request->all());

        return new AdminResource($admin);
    }

    /**
     * Display the specified resource.
     *
     * @param Admin $admin
     * @return AdminResource
     * @throws AuthorizationException
     */
    public function show(Admin $admin)
    {
        $this->authorize('show', $admin);

        return new AdminResource($admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Admin $admin
     * @return AdminResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Admin $admin)
    {
        $this->authorize('update', $admin);

        $admin = $this->adminRepository->update($admin,$request->all());

        return new AdminResource($admin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param Admin $admin
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(Admin $admin, DestroyRequest $request)
    {
        $this->authorize('destroy', $admin);

        $this->adminRepository->deleteAdminUser($admin, $request->all());

        return response()->json(null, 204);
    }
}
