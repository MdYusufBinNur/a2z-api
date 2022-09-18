<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CSVString implements Rule
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
     * Create a new rule instance.
     *
     * @param array $allowedValues
     * @return void
     */
    public function __construct($allowedValues = [])
    {
        $this->messages = [];
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
        // allowed values csv-string/numeric/array/stringify-json
        if (is_string($value)) {
            //stringify-json
            if (strpos($value,'[') !== false) {
                $ids = json_decode($value, true);
                if (is_null($ids)) {
                    $this->messages[] = 'Invalid list of strings value.';
                    return false;
                }
            } else {
                $ids = explode(',', $value);
            }
        } else if (is_numeric($value)) {
            $ids = [$value];
        } else if (is_array($value)) {
            $ids = $value;
        } else {
            $this->messages[] = 'Invalid list of strings.';
            return false;
        }

        //if only allowed fields
        if (!empty($this->allowedValues)) {
            foreach ($ids as $id) {
                if (!in_array($id, $this->allowedValues)) {
                    $this->messages[] = 'Invalid allowable fields.';
                    return false;
                }
            }
        }

        request()->merge([ $attribute => array_unique($ids) ]);

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
