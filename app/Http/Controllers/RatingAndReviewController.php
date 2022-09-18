<?php

namespace App\Http\Controllers;

use App\DbModels\RatingAndReview;
use App\Http\Requests\RatingAndReview\IndexRequest;
use App\Http\Requests\RatingAndReview\StoreRequest;
use App\Http\Resources\RatingAndReviewResource;
use App\Http\Resources\RatingAndReviewResourceCollection;
use App\Repositories\Contracts\RatingAndReviewRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class RatingAndReviewController extends Controller
{
    /**
     * @var RatingAndReviewRepository
     */
    protected $productReviewRepository;

    /**
     * ProductController constructor.
     * @param RatingAndReviewRepository $productReviewRepository
     */
    public function __construct(RatingAndReviewRepository $productReviewRepository)
    {
        $this->productReviewRepository = $productReviewRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return RatingAndReviewResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $request = $this->productReviewRepository->findBy($request->all());

        return new RatingAndReviewResourceCollection($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return RatingAndReviewResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [RatingAndReview::class, $request->input('createdByUserId')]);

        $request = $this->productReviewRepository->save($request->all());
        return new RatingAndReviewResource($request);
    }

    /**
     * Display the specified resource.
     *
     * @param RatingAndReview $productReview
     * @return RatingAndReviewResource
     * @throws AuthorizationException
     */
    public function show(RatingAndReview $productReview)
    {
        $this->authorize('show', $productReview);

        return new RatingAndReviewResource($productReview);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RatingAndReview $productReview
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(RatingAndReview $productReview)
    {
        $this->authorize('destroy', $productReview);

        $this->productReviewRepository->delete($productReview);
        return response()->json(null, 204);
    }
}
