<?php

namespace App\Http\Requests\PaymentTransaction;

use App\Http\Requests\Request;

class NotifyRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'providerName' => 'required',
            'providerId' => 'required',
            'status' => 'required',
            'internalId' => 'required',
        ];
    }
}
