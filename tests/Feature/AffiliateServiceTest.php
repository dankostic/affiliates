<?php

namespace Tests\Feature;

use App\Enums\DistanceEnum;
use App\Services\AffiliateService;
use App\Services\FileReaderService;
use App\Services\GreatCircleService;
use Tests\TestCase;

class AffiliateServiceTest extends TestCase
{
    private AffiliateService $affiliateService;
    public function setUp(): void
    {
        $file = New FileReaderService();
        $file->path = substr($file->path, 3);
        $this->affiliateService = new AffiliateService(
            fileReaderService: $file,
            greatCircleService: new GreatCircleService()
        );

        parent::setUp();
    }

    public function test_distance_from_dublin_office_for_invited_affiliates(): void
    {
        $response = $this->affiliateService->calculateDistance();
        $numberOfAffiliates = count($response);

        for ($i=0; $i<$numberOfAffiliates; $i++) {
            $this->assertLessThan(DistanceEnum::DISTANCE_FROM_DUBLIN_OFFICE->value, $response[$i]->distance);
        }
    }

    public function test_matching_affiliates_by_distance(): void
    {
        $response = $this->affiliateService->matchingAffiliatesByDistance($this->provideData());

        $this->assertSame(2, count($response));
    }

    public function test_sorting_affiliates_by_ids(): void
    {
        $response = $this->affiliateService->sortByAffiliateId($this->provideData());

        $this->assertSame(55, $response[3]->affiliate_id);
    }

    private function provideData(): array
    {
        return [
            (object)[
                'affiliate_id' => 15,
                'name' => 'John Doe',
                'distance' => 64.224,
            ],
            (object)[
                'affiliate_id' => 55,
                'name' => 'Paul David Hewson',
                'distance' => 302.14,
            ],
            (object)[
                'affiliate_id' => 44,
                'name' => 'Robbie Keane',
                'distance' => 99.999,
            ],
            (object)[
                'affiliate_id' => 33,
                'name' => 'Cameron Diaz',
                'distance' => 129.5,
            ],
        ];
    }
}
