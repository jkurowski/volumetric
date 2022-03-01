<?php

namespace App\Http\Controllers\Admin\Developro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// CMS
use App\Models\Investment;
use App\Services\InvestmentService;

class PlanController extends Controller
{
    private $service;

    public function __construct(InvestmentService $service)
    {
        $this->service = $service;
    }

    public function index(Investment $investment)
    {
        $investment->load('plan');
        return view('admin.investment_plan.index', ['investment' => $investment]);
    }

    public function update(Request $request, Investment $investment)
    {
        if ($request->hasFile('qqfile')) {
            $this->service->uploadPlan($investment, $request->file('qqfile'));
        }
        return response()->json(['success' => true]);
    }
}
