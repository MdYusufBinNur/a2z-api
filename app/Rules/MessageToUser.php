<?php

namespace App\Rules;

use App\DbModels\Message;
use App\DbModels\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class MessageToUser implements Rule
{
    /**
     * @var array
     */
    private $invalidValues;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->invalidValues = [];
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
        $toUsers = explode(',', $value);
        foreach ($toUsers as $user) {
            if (is_numeric($user)) {
                $userDoesNotExists = User::where('id', $user)
                    ->doesntExist();
                if ($userDoesNotExists) {
                    $this->invalidValues[] = $user;
                }
            } else {
                if (!in_array($user, [
                    Message::GROUP_ENTIRE_PROPERTY,
                    Message::GROUP_ALL_RESIDENTS,
                    Message::GROUP_ALL_STAFFS,
                    Message::GROUP_SPECIFIC_TOWER,
                    Message::GROUP_SPECIFIC_FLOOR,
                    Message::GROUP_SPECIFIC_LINE,
                    Message::GROUP_ALL_TENANTS,
                    Message::GROUP_ALL_OWNERS,
                    Message::GROUP_SPECIFIC_UNITS,
                    ])) {

                    $this->invalidValues[] = $user;

                }
            }
        }

        if (count($this->invalidValues)) {
            return false;
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
        return count($this->invalidValues)
            ? $this->invalidValues
            : 'Invalid units.';
    }
}
