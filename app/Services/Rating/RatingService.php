<?php


namespace App\Services\Rating;


use App\DbModels\RatingAndReview;
use App\Repositories\Contracts\RatingAndReviewRepository;
use Illuminate\Support\Facades\DB;

class RatingService
{
    /**
     * get resident access request states
     *
     * @param $searchCriteria
     * @return array
     */
    public static function sumAndAverageRating($searchCriteria)
    {
        $ratingAndReviewRepository = app(RatingAndReviewRepository::class);
        $ratingAndReviewModelTable = $ratingAndReviewRepository->getModel()->getTable();

        if(isset($searchCriteria['productId'])) {
            $whereField = 'productId';
            $type = RatingAndReview::TYPE_PRODUCT;
        } else {
            $whereField = 'vendorId';
            $type = RatingAndReview::TYPE_VENDOR;
        }

        $ratings =  DB::table($ratingAndReviewModelTable)
            ->select('rating', DB::raw('count(id) as amount'))
            ->where($whereField, $searchCriteria[$whereField])
            ->where('type', $type)
            ->groupBy('rating')
            ->get();

        $totalRatings = $ratings->sum('amount');

        $ratingTotal = 0;

        foreach ($ratings as $rating) {
            $ratingTotal += $rating->rating * $rating->amount;
        }
        if($ratingTotal == 0) {
            $avgRatings = 0;
        } else {
            $avgRatings = $ratingTotal / $totalRatings;
        }

        return ['ratings' => $ratings, 'totalRatings' => $totalRatings, 'avgRatings' => round($avgRatings, 1)];

    }
}
