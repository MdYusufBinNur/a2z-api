<?php

namespace App\Http\Validators;

class ListValidators
{
    /**
     * Register the list validation which validates a comma separated list of values
     *
     * @return boolean
     */
    public function validateList($attribute, $value, $parameters, $validator)
    {
        $valueArray = explode(',', $value);

        switch ($parameters[0]) {
            case 'numeric':
                $callback = function ($val) {
                    return is_numeric($val);
                };
                break;
            case 'string':
                $callback = function ($val) {
                    return is_string($val);
                };
                break;
            case 'email':
                $callback = function ($val) {
                    return filter_var($val, FILTER_VALIDATE_EMAIL) !== false;
                };
                break;
        }

        $passedMapping = array_map($callback, $valueArray);

        $passed = array_reduce($passedMapping, function ($carry, $item) {
            return $carry && $item;
        }, true);

        return $passed;
    }

    /**
     * Replace original message with our custom one
     *
     * @return string
     */
    public function validationMessage($message, $attribute, $rule, $parameters)
    {
        return sprintf('The %s field must be a valid comma separated list of %s values', $attribute, $parameters[0]);
    }
}
