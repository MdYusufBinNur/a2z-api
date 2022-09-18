<?php

namespace App\Rules;

use App\Repositories\Contracts\OrderCashbackRepository;
use Illuminate\Contracts\Validation\Rule;

class OrderCashbackUserAccountValidate implements Rule
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
            $userAccountId = $this->requestValues->get('userAccountId');

            $orderCashbackRepository = app(OrderCashbackRepository::class);
            $orderDetail = $orderCashbackRepository->getACashbackAbleOrderDetail(['orderDetailId' => $orderDetailId]);

            foreach ($orderDetail as $key => $v) {
                if($key == $attribute && ((int) $v !== (int) $userAccountId)) {
                    $this->messages[] = 'Invalid user account.';
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
