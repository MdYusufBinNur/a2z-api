<?php

namespace App\Rules;

use App\DbModels\ProductOffer;
use App\Repositories\Contracts\OrderCashbackRepository;
use Illuminate\Contracts\Validation\Rule;

class OrderCashbackAmountValidate implements Rule
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
            $this->messages[] = 'Cashback amount should be greater than 0.';
            return false;
        } else {
            $orderDetailId = $this->requestValues->get('orderDetailId');

            $orderCashbackRepository = app(OrderCashbackRepository::class);
            $orderDetail = $orderCashbackRepository->getACashbackAbleOrderDetail(['orderDetailId' => $orderDetailId]);

            $cashback = '';
            $cashbackType = '';
            $productQuantity = '';
            $productPrice = '';

            foreach ($orderDetail as $key => $v) {
                if($key === 'cashback') {
                    $cashback = $v;
                }
                if($key === 'cashbackType') {
                    $cashbackType = $v;
                }
                if($key === 'productQuantity') {
                    $productQuantity = $v;
                }
                if($key === 'productPrice') {
                    $productPrice = $v;
                }

                if(!empty($cashbackType) && !empty($cashback) && !empty($productQuantity) && !empty($productPrice)) {
                    $cashbackAmount = $this->getCashbackAmount($cashback, $cashbackType, $productQuantity, $productPrice);
                    if((float) $cashbackAmount !== (float) $value) {
                        $this->messages[] = 'Cashback amount is invalid.';
                        return false;
                    }
                }
            }
        }

        return true;
    }

    protected function getCashbackAmount($cashback, $cashbackType, $productQuantity, $productPrice)
    {
        if($cashbackType === ProductOffer::TYPE_FLAT) {
            return (float) $cashback;
        } else {
            return floor((((int) $productQuantity * (float) $productPrice) / 100) * (float) $cashback);
        }
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
