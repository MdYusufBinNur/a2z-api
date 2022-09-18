<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentItemResource extends Resource
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
            'createdByUser' =>  $this->when($this->needToInclude($request, 'pi.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'refId' => $this->refId,
            'paymentMethodId' => $this->paymentMethodId,
            'paymentMethod' =>  $this->when($this->needToInclude($request, 'pi.paymentMethod'), function () {
                return new PaymentMethodResource($this->paymentMethod);
            }),
            'voucherId' => $this->voucherId,
            'paymentId' => $this->paymentItemId,
            'payment' =>  $this->when($this->needToInclude($request, 'pi.payment'), function () {
                return new PaymentResource($this->payment);
            }),

            'paymentProcessURL' => $this->paymentProcessURL,
            'invoice' => $this->invoice,
            'providerName' => $this->providerName,
            'paymentDate' => $this->paymentDate,
            'amount' => $this->amount,
            'status' => $this->status,
            'note' => $this->note,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
