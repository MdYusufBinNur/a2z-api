<?php


namespace App\Repositories;


use App\DbModels\MetaAndSlug;
use App\Repositories\Contracts\CampaignRepository;
use ArrayAccess;

class EloquentCampaignRepository extends EloquentBaseRepository implements CampaignRepository
{

    /**
     * inherit doc
     * @param array $data
     * @return ArrayAccess
     */
    public function save(array $data): \ArrayAccess
    {
        $campaign = parent::save($data);

        $metaAndSlug['type'] = MetaAndSlug::TYPE_CAMPAIGN;
        $metaAndSlug['routePath'] = MetaAndSlug::ROUTE_PATH_CAMPAIGN;
        $metaAndSlug['resourceId'] = $campaign->id;
        $metaAndSlug['slugPath'] = $campaign->slug;
        $metaAndSlug['keywords'] = $campaign->title;

        $campaign->metaAndSlug()->create($metaAndSlug);

        return $campaign;
    }

}
