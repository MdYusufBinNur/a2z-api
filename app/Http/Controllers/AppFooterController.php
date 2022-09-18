<?php

namespace App\Http\Controllers;

use App\DbModels\AppFooter;
use App\Http\Requests\AppFooter\IndexRequest;
use App\Http\Requests\AppFooter\StoreRequest;
use App\Http\Requests\AppFooter\UpdateRequest;
use App\Http\Resources\AppFooterResource;
use App\Http\Resources\AppFooterResourceCollection;
use App\Repositories\Contracts\AppFooterRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AppFooterController extends Controller
{
    /**
     * @var AppFooterRepository
     */
    protected $appFooterRepository;

    /**
     * BrandController constructor.
     * @param AppFooterRepository $appFooterRepository
     */
    public function __construct(AppFooterRepository $appFooterRepository)
    {
        $this->appFooterRepository = $appFooterRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return AppFooterResourceCollection
     */
    public function index(IndexRequest $request)
    {
        return new AppFooterResourceCollection($this->appFooterRepository->findBy($request->all()));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return AppFooterResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', AppFooter::class);

        return new AppFooterResource($this->appFooterRepository->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param AppFooter $appFooter
     * @return AppFooterResource
     */
    public function show(AppFooter $appFooter)
    {
        return new AppFooterResource($appFooter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param AppFooter $appFooter
     * @return AppFooterResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, AppFooter $appFooter)
    {
        $this->authorize('update', $appFooter);
        return new AppFooterResource($this->appFooterRepository->update($appFooter, $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AppFooter $appFooter
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(AppFooter $appFooter)
    {
        $this->authorize('destroy', $appFooter);
        $this->appFooterRepository->delete($appFooter);
        return response()->json(null, 204);
    }
}
