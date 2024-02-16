<?php

namespace Tests\Feature;

use App\Http\Controllers\AffiliateController;
use App\Services\AffiliateService;
use App\Services\FileReaderService;
use App\Services\GreatCircleService;
use Tests\TestCase;

class AffiliateTest extends TestCase
{
    private AffiliateController $affiliateController;
    public function setUp(): void
    {
        $file = New FileReaderService();
        $file->path = substr($file->path, 3);
        $this->affiliateController = new AffiliateController(
            new AffiliateService(
                fileReaderService: $file,
                greatCircleService: new GreatCircleService()
            )
        );

        parent::setUp();
    }

    public function test_the_application_returns_a_successful_view(): void
    {
        $view = $this->view('affiliates.index', $this->affiliateController->index()->getData());

        $view->assertViewHas('affiliates');
        $view->assertSee('Distance');
        $view->assertSee('Terence Wall');
        $view->assertDontSee('Hadiya Terrell');
    }
}
