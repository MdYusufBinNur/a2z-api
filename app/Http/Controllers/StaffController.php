<?php

namespace App\Http\Controllers;

use App\DbModels\Staff;
use App\DbModels\User;
use App\Http\Requests\Staff\IndexRequest;
use App\Http\Requests\Staff\StoreRequest;
use App\Http\Requests\Staff\UpdateRequest;
use App\Http\Resources\StaffResource;
use App\Http\Resources\StaffResourceCollection;
use App\Repositories\Contracts\StaffRepository;
use Illuminate\Auth\Access\AuthorizationException;

class StaffController extends Controller
{
    /**
     * @var StaffRepository
     */
    protected $staffRepository;

    /**
     * UserController constructor.
     *
     * @param StaffRepository $staffRepository
     */
    public function __construct(StaffRepository $staffRepository)
    {
        $this->staffRepository = $staffRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return StaffResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', User::class);

        $users = $this->staffRepository->findBy($request->all());

        return new StaffResourceCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return StaffResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', User::class);

        $staff = $this->staffRepository->save($request->all());

        return new StaffResource($staff);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return StaffResource
     * @throws AuthorizationException
     */
    public function show($id)
    {
        $staff = $this->staffRepository->findOne($id);

        if (!$staff instanceof Staff) {
            return response()->json(['status' => 404, 'message' => 'Resource not found with the specific id.'], 404);
        }

        $this->authorize('show', $staff);

        return new StaffResource($staff);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Staff $staff
     * @return StaffResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Staff $staff)
    {
        $this->authorize('update', $staff);

        $staff = $this->staffRepository->update($staff, $request->all());

        return new StaffResource($staff);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Staff $staff
     * @return null;
     * @throws AuthorizationException
     */
    public function destroy(Staff $staff)
    {
        $this->authorize('destroy', $staff);

        $this->staffRepository->delete($staff);

        return response()->json(null, 204);
    }
}
