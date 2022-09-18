<?php

namespace App\Http\Validators;


use Illuminate\Support\Facades\DB;

class JsonIdsValidators
{
    /**
     * Register the json ids' validation which validates
     *
     * @return boolean
     */
    public function validateJsonIds($attribute, $value, $parameters, $validator)
    {
        $tableName = $parameters[0];
        $column = $parameters[1];

        if (!is_string($value)) {
            return false;
        }

        $ids = \json_decode($value);

        if (!$this->isValidIdsList($ids)) {
            return false;
        }

        if (!is_null($ids)) {
            $notFoundRows = [];
            foreach ($ids as $id) {
                if (is_array($id)) {
                    return false;
                }
                $table = DB::table($tableName);
                $rowFound = $table->where($column, $id)->count();
                if ($rowFound < 1) {
                    $notFoundRows[] = $id;
                }
            }

            return count($notFoundRows) === 0;
        } else {
            return true;
        }


    }

    /**
     * Replace original message with our custom one
     *
     * @return string
     */
    public function validationMessage($message, $attribute, $rule, $parameters)
    {
        return sprintf('Some of the id of field %s doesn\'t exist', $attribute);
    }

    /**
     * is list of valid Ids
     *
     * @param mixed $list
     * @return bool
     */
    private function isValidIdsList($list)
    {
        if (!is_array($list)) {
            return false;
        }
        $isValid = true;
        foreach ($list as $item) {
            if (is_object($item)) {
                $isValid = false;
            }
        }

        return $isValid;
    }
}
