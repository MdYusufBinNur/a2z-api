<?php

namespace App\Http\Controllers;

use App\DbModels\Tag;
use App\Http\Requests\Tag\IndexRequest;
use App\Http\Requests\Tag\StoreRequest;
use App\Http\Requests\Tag\UpdateRequest;
use App\Http\Resources\TagResource;
use App\Http\Resources\TagResourceCollection;
use App\Repositories\Contracts\TagRepository;

class TagController extends Controller
{
    /**
     * @var TagRepository
     */
    protected $tagRepository;

    /**
     * TagController constructor.
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return TagResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $tags = $this->tagRepository->findBy($request->all());

        return new TagResourceCollection($tags);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return TagResource
     */
    public function store(StoreRequest $request)
    {
        $tag = $this->tagRepository->save($request->all());

        return new TagResource($tag);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return TagResource
     */
    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Tag $tag
     * @return TagResource
     */
    public function update(UpdateRequest $request, Tag $tag)
    {
        $tag = $this->tagRepository->update($tag, $request->all());

        return new TagResource($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $this->tagRepository->delete($tag);

        return response()->json(null, 204);
    }
}
