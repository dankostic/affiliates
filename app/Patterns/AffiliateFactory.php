<?php

namespace App\Patterns;

use App\Exceptions\GPSCoordinatesException;
use App\Services\GreatCircleService;
use stdClass;

class AffiliateFactory
{
    public function __construct(
        private readonly GreatCircleService $greatCircleService
    ) {
    }

    /**
     * @throws GPSCoordinatesException
     */
    public function createAffiliate($value): stdClass
    {
        $affiliate = new stdClass();
        $affiliate->affiliate_id = $value->affiliate_id;
        $affiliate->name = $value->name;
        $affiliate->distance = $this->greatCircleService->distance(latitude: $value->latitude, longitude: $value->longitude);

        return $affiliate;
    }
}
