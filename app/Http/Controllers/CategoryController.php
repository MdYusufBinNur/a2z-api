<?php

namespace App\Http\Controllers;

use App\DbModels\Category;
use App\Http\Requests\Category\IndexRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryResourceCollection;
use App\Repositories\Contracts\CategoryRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return CategoryResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $categories = $this->categoryRepository->findBy($request->all());

        return new CategoryResourceCollection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return CategoryResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', Category::class);

        $category = $this->categoryRepository->save($request->all());

        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Category $category
     * @return CategoryResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $this->authorize('update', $category);

        $category = $this->categoryRepository->update($category, $request->all());

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Category $category)
    {
        $this->authorize('destroy', $category);

        $this->categoryRepository->delete($category);

        return response()->json(null, 204);
    }
}
