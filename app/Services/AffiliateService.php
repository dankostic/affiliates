<?php

namespace App\Services;

use App\Exceptions\GPSCoordinatesException;
use App\Interfaces\ReaderInterface;
use App\Patterns\AffiliateFactory;
use App\Traits\ArrayHelper;
use Illuminate\Support\Facades\Log;

class AffiliateService
{
    use ArrayHelper;

    public array $affiliates = [];
    public function __construct(
        private readonly ReaderInterface $fileReaderService,
        private readonly GreatCircleService $greatCircleService
    ) {
    }

    public function calculateDistance(): array
    {
        foreach ($this->fileReaderService->read() as $value) {
            try {
                $this->affiliates[] = (new AffiliateFactory($this->greatCircleService))->createAffiliate($value);
            } catch (GPSCoordinatesException $GPSCoordinatesException) {
                Log::info('GPS coordinates for {name} are in wrong format.', ['name' => $value->name]);
                echo sprintf('Message is: %s', $GPSCoordinatesException->getMessage());
            }
        }

        return $this->sortByAffiliateId(
            $this->matchingAffiliatesByDistance($this->affiliates));
    }
}
