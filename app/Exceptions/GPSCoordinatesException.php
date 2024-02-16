<?php

namespace App\Exceptions;

use Exception;

class GPSCoordinatesException extends Exception
{
    /**
     * @throws GPSCoordinatesException
     */
    public static function validateInput($coordinates): float
    {
        if (is_numeric($coordinates)) {
            return $coordinates;
        }

        throw new GPSCoordinatesException('Invalid GPS coordinates: '. $coordinates);
    }
}
