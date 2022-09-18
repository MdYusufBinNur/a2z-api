<?php

namespace App\Rules;

use App\DbModels\ProductOffer;
use App\Repositories\Contracts\OrderCashbackRepository;
use App\Repositories\Contracts\PaymentRepository;
use Illuminate\Contracts\Validation\Rule;

class RefundRequestAmountValidate implements Rule
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
        if (empty($value) || $value <= 0) {
            $this->messages[] = 'Request amount should be greater than 0.';
            return false;
        } else {
            $paymentId = $this->requestValues->get('paymentId');

            $paymentRepository = app(PaymentRepository::class);
            $payment = $paymentRepository->findOne($paymentId);


            foreach ($payment as $key => $v) {
                if((float) $payment->paid !== (float) $value) {
                    $this->messages[] = 'Refund Request amount is invalid.';
                    return false;
                }

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
