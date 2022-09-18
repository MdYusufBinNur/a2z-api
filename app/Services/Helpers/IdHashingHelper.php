<?php

namespace App\Services\Helpers;

use Hashids\Hashids;

class IdHashingHelper
{
    public static function encode($number){
        $HashIdsInstance = new Hashids(env('ID_HASHING_ENTROPY'), env('ID_HASHING_PADDING'));

        return $HashIdsInstance->encode($number);
    }

    public static function decode($hash){
        $HashIdsInstance = new Hashids(env('ID_HASHING_ENTROPY'), env('ID_HASHING_PADDING'));
        if(!is_numeric($hash)) {
            return $HashIdsInstance->decode($hash)[0];
        } else {
            return $hash;
        }
    }
}
