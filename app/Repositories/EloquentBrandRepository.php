<?php


namespace App\Repositories;


use App\DbModels\MetaAndSlug;
use App\Repositories\Contracts\BrandRepository;
use App\Repositories\Contracts\MetaAndSlugRepository;
use App\Repositories\Contracts\ProductOfferRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\ProductSpecsAndStateRepository;
use App\Repositories\Contracts\SubCategoryRepository;
use ArrayAccess;
use Illuminate\Support\Facades\DB;

class EloquentBrandRepository extends EloquentBaseRepository implements BrandRepository
{
    /**
     * inherit doc
     * @param array $searchCriteria
     * @param bool $withTrashed
     * @return mixed
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria = $this->applyFilterInBrandSearch($searchCriteria);

        return parent::findBy($searchCriteria, $withTrashed); // TODO: Change the autogenerated stub
    }


    /**
     * inherit doc
     * @param array $data
     * @return ArrayAccess
     */
    public function save(array $data): \ArrayAccess
    {
        $brand = parent::save($data);

        $metaAndSlug['type'] = MetaAndSlug::TYPE_BRAND;
        $metaAndSlug['routePath'] = MetaAndSlug::ROUTE_PATH_BRAND;
        $metaAndSlug['resourceId'] = $brand->id;
        $metaAndSlug['slugPath'] = $brand->slug;
        $metaAndSlug['keywords'] = $brand->title;

        $brand->metaAndSlug()->create($metaAndSlug);

        return $brand;
    }


    /**
     * shorten the search based on search criteria
     *
     * @param $searchCriteria
     * @return mixed
     */
    private function applyFilterInBrandSearch($searchCriteria)
    {
        if (isset($searchCriteria['query'])) {
            $searchCriteria['id'] = $this->model
                ->where('title', 'like', '%'.$searchCriteria['query'].'%')
                ->orWhere('ownerName', 'like', '%'.$searchCriteria['query'].'%')
                ->pluck('id')->toArray();
            unset($searchCriteria['query']);
        }

        if (isset($searchCriteria['campaignId'])) {
            $productOfferRepository = app(ProductOfferRepository::class);
            $queryBuilder = $productOfferRepository->model->select('brandId');

            $queryBuilder = $queryBuilder->where('campaignId', $searchCriteria['campaignId']);
            $queryBuilder = $queryBuilder->where('isActive', true);

            $brandIds = $queryBuilder->pluck('brandId')->toArray();

            if (isset($searchCriteria['id'])) {
                if (is_array($searchCriteria['id'])) {
                    $searchCriteria['id'] = array_intersect($searchCriteria['id'], $brandIds);
                } else {
                    $searchCriteria['id'] = array_intersect(explode(',', $searchCriteria['id']), $brandIds);
                }
            } else {
                $searchCriteria['id'] = $brandIds;
            }

            unset($searchCriteria['campaignId']);
        }

        if (isset($searchCriteria['subCategoryId'])) {
            $subCategoryRepository = app(SubCategoryRepository::class);
            $searchCriteria['categoryId'] = $subCategoryRepository->model->select('categoryId')
                ->where('id', $searchCriteria['subCategoryId'])
                ->pluck('categoryId')->first();
            unset($searchCriteria['subCategoryId']);
        }

        if (isset($searchCriteria['id'])) {
            $searchCriteria['id'] = is_array($searchCriteria['id']) ? implode(",", array_unique($searchCriteria['id'])) : $searchCriteria['id'];
        }

        return $searchCriteria;
    }
}