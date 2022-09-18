<?php

namespace App\Http\Resources;

use App\Services\Rating\RatingService;
use Illuminate\Http\Request;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getIdOrUuid(),
            'slug' => $this->slug,
            'resourceId' => $this->when($this->needToInclude($request, 'product.resourceId'), function () {
                return $this->id;
            }),
            'createdByUserId' => $this->createdByUserId,
            'name' => $this->name,
            'surname' => $this->surname,
            'shortIntroduction' => $this->shortIntroduction,
            'description' => $this->description,
            'quantity' => 1,
            'campaignId' => $this->getCampaignId(),

            'productStock' => $this->when($this->needToInclude($request, 'product.productStock'), function () {
                return new ProductStockResource($this->productStock);
            }),

            'productSpecsAndState' => $this->when($this->needToInclude($request, 'product.productSpecsAndState'), function () {
                return new ProductSpecsAndStateResource($this->productSpecsAndState);
            }),

            'productStockInLogLatest' => $this->when($this->needToInclude($request, 'product.productStockInLogLatest'), function () {
                return new ProductStockInLogResource($this->productStockInLogLatest);
            }),

            'productStockInLog' => $this->when($this->needToInclude($request, 'product.productStockInLog'), function () {
                return new ProductStockInLogResourceCollection($this->productStockInLog);
            }),

            'productStockOutLog' => $this->when($this->needToInclude($request, 'product.productStockOutLog'), function () {
                return new ProductStockOutLogResourceCollection($this->productStockOutLog);
            }),

            'productRatingAndReviews' => $this->when($this->needToInclude($request, 'product.productRatingAndReviews'), function () {
                return new RatingAndReviewResourceCollection($this->productRatingAndReviews);
            }),

            'productRating' => $this->when($this->needToInclude($request, 'product.productRating'), function () {
                return RatingService::sumAndAverageRating(['productId' => $this->id]);
            }),

            'productOffer' => $this->when($this->needToInclude($request, 'product.productOffer'), function () {
                return new ProductOfferResource($this->productOffer);
            }),

            'productPricing' => $this->when($this->needToInclude($request, 'product.productPricing'), function () {
                return new ProductPricingResource($this->productPricing());
            }),

            'campaign' => $this->when($this->needToInclude($request, 'product.campaign'), function () {
                return new CampaignResource($this->campaign);
            }),

            'parentId' => $this->parentId,
            'parent' => $this->when($this->needToInclude($request, 'product.parent'), function () {
                return new ProductResource($this->parent);
            }),

            'categoryId' => $this->categoryId,
            'category' => $this->when($this->needToInclude($request, 'product.category'), function () {
                return new CategoryResource($this->category);
            }),

            'subCategoryId' => $this->subCategoryId,
            'subCategory' => $this->when($this->needToInclude($request, 'product.subCategory'), function () {
                return new SubCategoryResource($this->subCategory);
            }),

            'brandId' => $this->brandId,
            'brand' => $this->when($this->needToInclude($request, 'product.brand'), function () {
                return new BrandResource($this->brand);
            }),

            'vendorId' => $this->vendorId,
            'vendor' => $this->when($this->needToInclude($request, 'product.vendor'), function () {
                return new VendorResource($this->vendor);
            }),

            'image' => $this->when($this->needToInclude($request, 'product.image'), function () {
                return new AttachmentResource($this->image);
            }),

            'images' => $this->when($this->needToInclude($request, 'product.images'), function () {
                return new AttachmentResourceCollection($this->images);
            }),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
