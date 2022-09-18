<?php

namespace App\Http\Controllers;

use App\DbModels\Campaign;
use App\Http\Requests\Campaign\IndexRequest;
use App\Http\Requests\Campaign\StoreRequest;
use App\Http\Requests\Campaign\UpdateRequest;
use App\Http\Resources\CampaignResource;
use App\Http\Resources\CampaignResourceCollection;
use App\Repositories\Contracts\CampaignRepository;
use Illuminate\Http\JsonResponse;

class CampaignController extends Controller
{
    /**
     * @var CampaignRepository
     */
    protected $campaignRepository;

    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return CampaignResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $campaigns = $this->campaignRepository->findBy($request->all());

        return new CampaignResourceCollection($campaigns);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return CampaignResource
     */
    public function store(StoreRequest $request)
    {
        $campaign = $this->campaignRepository->save($request->all());

        return new CampaignResource($campaign);
    }

    /**
     * Display the specified resource.
     *
     * @param Campaign $campaign
     * @return CampaignResource
     */
    public function show(Campaign $campaign)
    {
        return new CampaignResource($campaign);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Campaign $campaign
     * @return CampaignResource
     */
    public function update(UpdateRequest $request, Campaign $campaign)
    {
        $campaign = $this->campaignRepository->update($campaign, $request->all());

        return new CampaignResource($campaign);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Campaign $campaign
     * @return JsonResponse
     */
    public function destroy(Campaign $campaign)
    {
        $this->campaignRepository->delete($campaign);

        return response()->json(null, 204);
    }
}
