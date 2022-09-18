<?php

namespace App\Http\Controllers;

use App\DbModels\User;
use App\DbModels\UserAccount;
use App\Http\Requests\UserAccount\IndexRequest;
use App\Http\Requests\UserAccount\StoreRequest;
use App\Http\Requests\UserAccount\UpdateRequest;
use App\Http\Resources\UserAccountResource;
use App\Http\Resources\UserAccountResourceCollection;
use App\Repositories\Contracts\UserAccountRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserAccountController extends Controller
{
    /**
     * @var UserAccountRepository
     */
    protected $userAccountRepository;

    /**
     * UserAccountController constructor.
     * @param UserAccountRepository $userAccountRepository
     */
    public function __construct(UserAccountRepository $userAccountRepository)
    {
        $this->userAccountRepository = $userAccountRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return UserAccountResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [UserAccount::class, $request->get('userId')]);

        $userAccounts = $this->userAccountRepository->findBy($request->all());

        return new UserAccountResourceCollection($userAccounts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return UserAccountResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', User::class);

        $userAccount = $this->userAccountRepository->save($request->all());

        return new UserAccountResource($userAccount);
    }

    /**
     * Display the specified resource.
     *
     * @param UserAccount $userAccount
     * @return UserAccountResource
     * @throws AuthorizationException
     */
    public function show(UserAccount $userAccount)
    {
        $this->authorize('show', $userAccount);

        return new UserAccountResource($userAccount);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UserAccount $userAccount
     * @return UserAccountResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, UserAccount $userAccount)
    {
        $this->authorize('store', User::class);

        $userAccount = $this->userAccountRepository->update($userAccount, $request->all());

        return new UserAccountResource($userAccount);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserAccount $userAccount
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(UserAccount $userAccount)
    {
        $this->authorize('destroy', $userAccount);

        $this->userAccountRepository->delete($userAccount);

        return response()->json(null, 204);
    }
}
