<?php

namespace App\Listeners\Product;

use App\Events\Product\ProductCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\ProductStockInLogRepository;
use App\Repositories\Contracts\ProductStockRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleProductCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param ProductCreatedEvent $event
     * @return void
     */
    public function handle(ProductCreatedEvent $event)
    {
        $eventOptions = $event->options;
        $product = $event->product;
        $productStock = $event->productStock;
        $productStockInLog = $event->productStockInLog;

        $createdByUserId = $eventOptions['request']['loggedInUserId'];
        $availableQuantity = $productStockInLog["receivedQuantity"];

        $productStockInLogRepository = app(ProductStockInLogRepository::class);

        // save product stock in logs
        $productStockInLogRepository->save([
            'createdByUserId' => $createdByUserId,
            'productId' => $product->id,
            'vendorId' => $product->vendorId ?? null,
            'date' => $productStockInLog["date"],
            'note' => $productStockInLog["note"],
            'cost' => $productStockInLog["cost"],
            'startingQuantity' => $availableQuantity,
            'receivedQuantity' => $availableQuantity,
            'availableQuantity' => $availableQuantity,
        ]);

        $productStock['productId'] = $product->id;
        $productStock['availableQuantity'] =$availableQuantity;
        $productStock['createdByUserId'] = $createdByUserId;

        $productStockRepository = app(ProductStockRepository::class);

        // save product stock
        $productStockRepository->save($productStock);
    }
}
