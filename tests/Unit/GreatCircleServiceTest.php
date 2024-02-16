<?php

namespace Tests\Unit;

use App\Exceptions\GPSCoordinatesException;
use App\Services\GreatCircleService;
use PHPUnit\Framework\TestCase;

class GreatCircleServiceTest extends TestCase
{
    private GreatCircleService $greatCircleService;
    public function setUp(): void
    {
        $this->greatCircleService = new GreatCircleService();
    }

    /**
     * @throws GPSCoordinatesException
     */
    public function test_does_method_returns_desired_value(): void
    {
        $result = $this->greatCircleService->distance(latitude: 52.833502, longitude: -8.522366);

        $this->assertIsFloat($result);
    }

    public function test_expect_exception_in_case_of_wrong_value()
    {
        $this->expectException(GPSCoordinatesException::class);

        $this->greatCircleService->distance(latitude: 52.833502, longitude: null);
    }
}
