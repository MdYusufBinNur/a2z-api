<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;

class OrderReportResource extends Resource
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

            'createdByUserId' => $this->createdByUserId,
            'createdByUser' => $this->when($this->needToInclude($request, 'or.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),            'id' => $this->getIdOrUuid(),

            'updatedByUserId' => $this->updatedByUserId,
            'updatedByUser' => $this->when($this->needToInclude($request, 'or.updatedByUser'), function () {
                return new UserResource($this->updatedByUser);
            }),

            'invoice' => $this->order->invoice,

            'orderId' => $this->orderId,
            'order' => $this->when($this->needToInclude($request, 'or.order'), function () {
                return new OrderResource($this->order);
            }),

            'orderReportComments' => $this->when($this->needToInclude($request, 'or.orderReportComments'), function () {
                return new OrderReportCommentResourceCollection($this->orderReportComments);
            }),

            'isCommentableOrderReport' => $this->isCommentableOrderReport(),
            'type' => $this->type,
            'status' => $this->status,
            'comments' => $this->comments,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
