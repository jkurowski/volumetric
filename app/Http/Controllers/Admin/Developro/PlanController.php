<?php

namespace App\Http\Controllers\Admin\Developro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Investment;

class PlanController extends Controller
{

    public function index(Investment $investment)
    {
        $investment->load('plan');

        return view('admin.investment_plan.index', ['investment' => $investment]);
    }

    public function update(Request $request, Investment $investment)
    {
        if ($request->hasFile('qqfile')) {
            $investment->planUpload($request->file('qqfile'));
        }
        return response()->json(['success' => true]);
    }
}
