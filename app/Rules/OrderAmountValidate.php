<?php

namespace App\Rules;

use App\DbModels\Product;
use App\DbModels\ProductOffer;
use App\Repositories\Contracts\ProductOfferRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\ProductStockRepository;
use App\Repositories\EloquentProductRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class OrderAmountValidate implements Rule
{
    /**
     * @var array
     */
    private $messages;

    /**
     * @var array
     */
    private $allowedValues;
    /**
     * @var array
     */
    private $requestValues;

    /**
     * Create a new rule instance.
     *
     * @param array $requestValues
     * @param array $allowedValues
     */
    public function __construct($requestValues = [], $allowedValues = [])
    {
        $this->messages = [];
        $this->requestValues = $requestValues;
        $this->allowedValues = $allowedValues;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        // allowed values array of object
        if (empty($value) || $value <= 0) {
            $this->messages[] = 'Invalid amount.';
            return false;
        } else if(empty($this->requestValues->get('products'))) {
            $this->messages[] = 'Invalid product lists.';
            return false;
        } else {
            $requestProducts = $this->requestValues->get('products');
            $givenAmount = $value;
            $campaignId = $this->requestValues->get('campaignId') ?? null;
            $vendorId = $this->requestValues->get('vendorId');
            $requestProductIds = array_column($requestProducts, 'productId');

            $productRepository = app(ProductRepository::class);
            $productOfferRepository = app(ProductOfferRepository::class);
            $productStockRepository = app(ProductStockRepository::class);
            $productTable = $productRepository->getModel()->getTable();
            $productOfferTable = $productOfferRepository->getModel()->getTable();
            $productStockTable = $productStockRepository->getModel()->getTable();

            $campaignQuery = !empty($campaignId) ? $productOfferTable . '.campaignId' . '='. $campaignId : '1 = 1';
            $ProductOfferQuery = $productOfferTable . '.isActive' . '=' . true;

            $products =  DB::table($productTable)
                ->select($productTable . '.id as productId', $productOfferTable . '.id as productOfferId', $productOfferTable . '.cashback', $productOfferTable . '.cashbackType', $productOfferTable . '.discount', $productOfferTable . '.discountType', $productStockTable . '.price')
                ->join($productOfferTable, $productOfferTable . '.productId', '=', $productTable . '.id')
                ->join($productStockTable, $productStockTable . '.productId', '=', $productTable . '.id')
                ->where($productTable . '.vendorId', $vendorId)
                ->whereRaw(DB::raw($campaignQuery))
                ->whereRaw(DB::raw($ProductOfferQuery))
                ->whereIn($productTable . '.id', $requestProductIds)
                ->groupBy('productId')
                ->get();

            $totalAmount = (float) 0;
            foreach($products as $product) {
                $productPrice = (float) 0;
                $productId = $product->productId;
                $requestProduct = current(array_filter($requestProducts, function($e) use($productId) { return $e['productId'] == $productId; }));

                if(!empty($product->discount)) {
                    if($product->discountType === ProductOffer::TYPE_FLAT) {
                        $productPrice = $product->price - $product->discount;
                    } else if($product->discountType === ProductOffer::TYPE_PERCENTAGE) {
                        $productPrice = $product->price -  round((($product->discount  * $product->price) / 100),2);
                    } else {
                        $productPrice = $product->price;
                    }

                    if((float) $requestProduct['productPrice'] !== ($productPrice * $requestProduct['productQuantity'])) {
                        $this->messages[] = 'Product pricing error.';
                        return false;
                    }
                    $totalAmount = $totalAmount + ($productPrice * $requestProduct['productQuantity']);
                } else {
                    $totalAmount = $totalAmount + ($product->price * $requestProduct['productQuantity']);
                }

                $productPrice = (float) 0;
            }

            if((float) $givenAmount !== $totalAmount) {
                $this->messages[] = 'Product total amount is invalid.';
                return false;
            }

        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return $this->messages;
    }
}
