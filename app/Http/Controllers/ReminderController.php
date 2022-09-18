<?php

namespace App\Http\Controllers;

use App\DbModels\Reminder;
use App\Http\Requests\Reminder\IndexRequest;
use App\Http\Requests\Reminder\StoreRequest;
use App\Http\Resources\ReminderResource;
use App\Http\Resources\ReminderResourceCollection;
use App\Repositories\Contracts\ReminderRepository;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    /**
     * @var ReminderRepository
     */
    protected $reminderRepository;

    /**
     * ReminderController constructor.
     * @param ReminderRepository $reminderRepository
     */
    public function __construct(ReminderRepository $reminderRepository)
    {
        $this->reminderRepository = $reminderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ReminderResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $reminders = $this->reminderRepository->findBy($request->all());

        return new ReminderResourceCollection($reminders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ReminderResource
     */
    public function store(StoreRequest $request)
    {
        $reminder = $this->reminderRepository->save($request->all());

        return new ReminderResource($reminder);
    }

    /**
     * Display the specified resource.
     *
     * @param Reminder $reminder
     * @return ReminderResource
     */
    public function show(Reminder $reminder)
    {
        return new ReminderResource($reminder);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reminder $reminder
     * @return void
     */
    public function destroy(Reminder $reminder)
    {
        $this->reminderRepository->delete($reminder);

        return response()->json(null, 204);
    }
}
