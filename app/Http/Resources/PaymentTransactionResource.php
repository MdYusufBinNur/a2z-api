<?php

namespace App\Http\Resources;

class PaymentTransactionResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getIdOrUuid(),

            'paymentItemId' => $this->paymentItemId,
            'paymentItem' => $this->when($this->needToInclude($request, 'pit.paymentItem'), function () {
                return new PaymentItemResource($this->paymentItem);
            }),
            'providerName' => $this->providerName,
            'providerId' => $this->providerId,
            'status' => $this->status,
            'rawData' => $this->rawData,
        ];
    }
}
