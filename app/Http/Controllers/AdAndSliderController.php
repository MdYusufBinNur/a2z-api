<?php

namespace App\Http\Controllers;

use App\DbModels\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use App\DbModels\AdAndSlider;
use App\Http\Resources\AdAndSliderResource;
use App\Http\Requests\AdAndSliders\IndexRequest;
use App\Http\Requests\AdAndSliders\StoreRequest;
use App\Http\Requests\AdAndSliders\UpdateRequest;
use App\Http\Resources\AdAndSliderResourceCollection;
use App\Repositories\Contracts\AdAndSliderRepository;

class AdAndSliderController extends Controller
{
    /**
     * @var AdAndSliderRepository
     */
    protected $adAndSlidersRepository;

    public function __construct(AdAndSliderRepository $adAndSliderRepository)
    {
        $this->adAndSlidersRepository = $adAndSliderRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return AdAndSliderResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $adAndSlider = $this->adAndSlidersRepository->findBy($request->all());

        return new AdAndSliderResourceCollection($adAndSlider);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return AdAndSliderResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', User::class);

        $adAndSliders = $this->adAndSlidersRepository->save($request->all());

        return new AdAndSliderResource($adAndSliders);
    }

    /**
     * Display the specified resource.
     *
     * @param AdAndSlider $adAndSlider
     * @return AdAndSliderResource
     */
    public function show(AdAndSlider $adAndSlider)
    {
        return new AdAndSliderResource($adAndSlider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param AdAndSlider $adAndSlider
     * @return AdAndSliderResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, AdAndSlider $adAndSlider)
    {
        $this->authorize('update', [User::class, $adAndSlider]);

        $adAndSlider = $this->adAndSlidersRepository->update($adAndSlider, $request->all());

        return new AdAndSliderResource($adAndSlider);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AdAndSlider $adAndSlider
     * @return JsonResponse
     */
    public function destroy(AdAndSlider $adAndSlider)
    {
//        $this->authorize('destroy', [User::class, $adAndSlider]);

        $this->adAndSlidersRepository->delete($adAndSlider);

        return response()->json(null, 204);
    }
}
