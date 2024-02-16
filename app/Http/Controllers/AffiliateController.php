<?php

namespace App\Http\Controllers;

use App\Services\AffiliateService;
use Illuminate\View\View;

class AffiliateController extends Controller
{
    public function __construct(
        private readonly AffiliateService $affiliateService
    ) {
    }

    public function index(): View
    {
        return view('affiliates.index')->with('affiliates', $this->affiliateService->calculateDistance());
    }
}
