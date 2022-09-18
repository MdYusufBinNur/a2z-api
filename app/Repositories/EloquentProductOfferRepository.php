<?php


namespace App\Repositories;


use App\Repositories\Contracts\ProductOfferRepository;
use App\Repositories\Contracts\ProductRepository;
use ArrayAccess;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentProductOfferRepository extends EloquentBaseRepository implements ProductOfferRepository
{
    /**
     * update a user
     *
     * @param array $data
     * @return ArrayAccess
     */
    public function saveProductOffer(array $data): ArrayAccess
    {
        DB::beginTransaction();
        $productIds = $data['productIds'];

        unset($data['productIds']);
        $productOffers = [];
        foreach ($productIds as $productId) {
            $productRepository = app(ProductRepository::class);
            $queryBuilder = $productRepository->model->select('brandId');

            $queryBuilder = $queryBuilder->where('id', $productId);
            $brandId = $queryBuilder->first()->brandId;
            $data['productId'] = $productId;
            $data['brandId'] = $brandId;

            $this->save($data);
        }

        $productOffers = $this->model
            ->where('vendorId', $data['vendorId'])
            ->where('campaignId', $data['campaignId'])
            ->where('startDate', $data['startDate'])
            ->where('endDate', $data['endDate'])
            ->whereIn('productId', $productIds)->get();

        DB::commit();


        return $productOffers;
    }

}
