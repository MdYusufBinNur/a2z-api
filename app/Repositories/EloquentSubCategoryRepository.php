<?php


namespace App\Repositories;

use App\DbModels\MetaAndSlug;
use App\Repositories\Contracts\SubCategoryRepository;
use ArrayAccess;

class EloquentSubCategoryRepository extends EloquentBaseRepository implements SubCategoryRepository
{

    /**
     * inherit doc
     * @param array $data
     * @return ArrayAccess
     */
    public function save(array $data): \ArrayAccess
    {
        $subCategory = parent::save($data);

        $metaAndSlug['type'] = MetaAndSlug::TYPE_SUB_CATEGORY;
        $metaAndSlug['routePath'] = MetaAndSlug::ROUTE_PATH_SUB_CATEGORY;
        $metaAndSlug['keywords'] = $subCategory->name;
        $metaAndSlug['resourceId'] = $subCategory->id;
        $metaAndSlug['slugPath'] = $subCategory->slug;

        $subCategory->metaAndSlug()->create($metaAndSlug);

        return $subCategory;
    }

}
