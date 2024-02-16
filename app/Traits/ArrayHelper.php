<?php

namespace App\Traits;

use App\Enums\DistanceEnum;

trait ArrayHelper
{
    public function matchingAffiliatesByDistance(array $array): array
    {
        foreach ($array as $key => $value) {
            if($value->distance > DistanceEnum::DISTANCE_FROM_DUBLIN_OFFICE->value ){
                unset($array[$key]);
            }
        }

        return $array;
    }

    public function sortByAffiliateId(array $array): array
    {
        usort($array, fn($a, $b) => $a->affiliate_id <=> $b->affiliate_id);

        return $array;
    }
}
