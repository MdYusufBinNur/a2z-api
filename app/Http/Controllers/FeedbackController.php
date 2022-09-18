<?php

namespace App\Http\Controllers;

use App\DbModels\Feedback;
use App\Http\Requests\Feedback\IndexRequest;
use App\Http\Requests\Feedback\StoreRequest;
use App\Http\Requests\Feedback\UpdateRequest;
use App\Http\Resources\FeedbackResource;
use App\Http\Resources\FeedbackResourceCollection;
use App\Repositories\Contracts\FeedbackRepository;
use Illuminate\Auth\Access\AuthorizationException;

class FeedbackController extends Controller
{
    /**
     * @var FeedbackRepository
     */
    protected $feedbackRepository;

    /**
     * FeedbackController constructor.
     *
     * @param FeedbackRepository $feedbackRepository
     */
    public function __construct(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return FeedbackResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', Feedback::class);

        $feedbacks = $this->feedbackRepository->findBy($request->all());

        return new FeedbackResourceCollection($feedbacks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return FeedbackResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [Feedback::class, $request->input('propertyId')]);

        $feedback = $this->feedbackRepository->save($request->all());

        return new FeedbackResource($feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param Feedback $feedback
     * @return FeedbackResource
     * @throws AuthorizationException
     */
    public function show(Feedback $feedback)
    {
        $this->authorize('show', $feedback);

        return new FeedbackResource($feedback);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Feedback $feedback
     * @return FeedbackResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Feedback $feedback)
    {
        $this->authorize('update', $feedback);

        $feedback = $this->feedbackRepository->update($feedback, $request->all());

        return new FeedbackResource($feedback);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Feedback $feedback
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Feedback $feedback)
    {
        $this->authorize('destroy', $feedback);

        $this->feedbackRepository->delete($feedback);

        return response()->json(null, 204);
    }
}
