<?php

namespace App\Services;

use App\Enums\DistanceEnum;
use App\Exceptions\GPSCoordinatesException;

class GreatCircleService
{
    public const DUBLIN_OFFICE_LATITUDE = 53.3340285;
    public const DUBLIN_OFFICE_LONGITUDE = -6.2535495;

    /**
     * @throws GPSCoordinatesException
     */
    public function distance($latitude, $longitude): float
    {
        $dublinLatitude = deg2rad(self::DUBLIN_OFFICE_LATITUDE);
        $dublinLongitude = deg2rad(self::DUBLIN_OFFICE_LONGITUDE);
        $latitude = deg2rad(GPSCoordinatesException::validateInput($latitude));
        $longitude = deg2rad(GPSCoordinatesException::validateInput($longitude));

        $longitudeDelta = $longitude - $dublinLongitude;
        $a = pow(cos($latitude) * sin($longitudeDelta),2) + pow(cos($dublinLatitude) * sin($latitude) - sin($dublinLatitude) * cos($latitude) * cos($longitudeDelta),2);
        $b = sin($dublinLatitude) * sin($latitude) + cos($dublinLatitude) * cos($latitude) * cos($longitudeDelta);
        $angle = atan2(sqrt($a) , $b);

        return round($angle * DistanceEnum::EARTH_RADIUS_IN_KILOMETERS->value, 2);
    }
}
