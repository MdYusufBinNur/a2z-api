<?php

namespace App\Http\Controllers;

use App\DbModels\ContentModule;
use App\Http\Requests\ContentModule\IndexRequest;
use App\Http\Requests\ContentModule\StoreRequest;
use App\Http\Resources\ContentModuleResource;
use App\Http\Resources\ContentModuleResourceCollection;
use App\Repositories\Contracts\ContentModuleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContentModuleController extends Controller
{
    /**
     * @var ContentModuleRepository
     */
    protected $contentModuleRepository;

    /**
     * ContentModuleController constructor.
     * @param ContentModuleRepository $contentModuleRepository
     */
    public function __construct(ContentModuleRepository  $contentModuleRepository)
    {
        $this->contentModuleRepository = $contentModuleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ContentModuleResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $contentModules = $this->contentModuleRepository->findBy($request->all());

        return new ContentModuleResourceCollection($contentModules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return ContentModuleResource
     */
    public function store(StoreRequest $request)
    {
        $contentModule = $this->contentModuleRepository->save($request->all());

        return new ContentModuleResource($contentModule);
    }

    /**
     * Display the specified resource.
     *
     * @param ContentModule $contentModule
     * @return ContentModuleResource
     */
    public function show(ContentModule $contentModule)
    {
        return new ContentModuleResource($contentModule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ContentModule $contentModule
     * @return ContentModuleResource
     */
    public function update(Request $request, ContentModule $contentModule)
    {
        $this->contentModuleRepository->update($contentModule, $request->all());

        return new ContentModuleResource($contentModule);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ContentModule $contentModule
     * @return JsonResponse
     */
    public function destroy(ContentModule $contentModule)
    {
        $this->contentModuleRepository->delete($contentModule);

        return response()->json(null, 204);
    }
}
