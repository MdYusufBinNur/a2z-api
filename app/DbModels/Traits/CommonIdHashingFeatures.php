<?php

namespace App\DbModels\Traits;

use App\Services\Helpers\IdHashingHelper;
use Illuminate\Database\Eloquent\Model;

trait CommonIdHashingFeatures
{
    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        if($this->getRouteKeyName() == 'id') {
            return $this->where('id', IdHashingHelper::decode($value))->firstOrFail();
        } else {
            return $this->where($this->getRouteKeyName(), $value)->firstOrFail();
        }
    }

}
