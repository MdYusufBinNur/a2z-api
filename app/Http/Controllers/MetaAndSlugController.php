<?php

namespace App\Http\Controllers;

use App\DbModels\MetaAndSlug;
use App\Http\Requests\MetaAndSlug\IndexRequest;
use App\Http\Requests\MetaAndSlug\StoreRequest;
use App\Http\Resources\MetaAndSlugResource;
use App\Http\Resources\MetaAndSlugResourceCollection;
use App\Repositories\Contracts\MetaAndSlugRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MetaAndSlugController extends Controller
{
    /**
     * @var MetaAndSlugRepository
     */
    protected $metaAndSlugRepository;

    /**
     * MessageUserController constructor.
     * @param MetaAndSlugRepository $metaAndSlugRepository
     */
    public function __construct(MetaAndSlugRepository $metaAndSlugRepository)
    {
        $this->metaAndSlugRepository = $metaAndSlugRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return MetaAndSlugResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $metaAndSlugs = $this->metaAndSlugRepository->findBy($request->all());

        return new MetaAndSlugResourceCollection($metaAndSlugs);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return MetaAndSlugResource
     */
    public function store(StoreRequest $request)
    {
        $metaAndSlug = $this->metaAndSlugRepository->save($request->all());

        return new MetaAndSlugResource($metaAndSlug);
    }

    /**
     * Display the specified resource.
     *
     * @param $metaAndSlug
     * @return MetaAndSlugResource
     */
    public function show(MetaAndSlug $metaAndSlug)
    {
        return new MetaAndSlugResource($metaAndSlug);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $metaAndSlug
     * @return MetaAndSlugResource
     */
    public function update(Request $request, MetaAndSlug $metaAndSlug)
    {
        $metaAndSlug = $this->metaAndSlugRepository->update($metaAndSlug, $request->all());

        return new MetaAndSlugResource($metaAndSlug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $metaAndSlug
     * @return JsonResponse
     */
    public function destroy(MetaAndSlug $metaAndSlug)
    {
        $this->metaAndSlugRepository->delete($metaAndSlug);

        return response()->json(null, 204);
    }
}
