<?php

namespace App\Http\Controllers;

use App\DbModels\OrderReportComment;
use App\Http\Requests\OrderReportComment\IndexRequest;
use App\Http\Requests\OrderReportComment\StoreRequest;
use App\Http\Resources\OrderReportCommentResource;
use App\Http\Resources\OrderReportCommentResourceCollection;
use App\Repositories\Contracts\OrderReportCommentRepository;
use Illuminate\Auth\Access\AuthorizationException;

class OrderReportCommentController extends Controller
{
    /**
     * @var OrderReportCommentRepository
     */
    protected $orderLogRepository;
    /**
     * @var OrderReportCommentRepository
     */
    protected $orderReportCommentRepository;

    /**
     * PackageController constructor.
     * @param OrderReportCommentRepository $orderReportCommentRepository
     */
    public function __construct(OrderReportCommentRepository $orderReportCommentRepository)
    {
        $this->orderReportCommentRepository = $orderReportCommentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return OrderReportCommentResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [OrderReportComment::class, $request->input('createdByUserId')]);

        $orderReportComments = $this->orderReportCommentRepository->findBy($request->all());
        return new OrderReportCommentResourceCollection($orderReportComments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return OrderReportCommentResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [OrderReportComment::class, $request->input('createdByUserId')]);

        $orderReportComment = $this->orderReportCommentRepository->save($request->all());
        return new OrderReportCommentResource($orderReportComment);
    }

    /**
     * Display the specified resource.
     *
     * @param OrderReportComment $orderReportComment
     * @return OrderReportCommentResource
     * @throws AuthorizationException
     */
    public function show(OrderReportComment $orderReportComment)
    {
        $this->authorize('show', $orderReportComment);

        return new OrderReportCommentResource($orderReportComment);
    }
}
