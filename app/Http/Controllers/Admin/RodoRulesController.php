<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\RodoRules;
use Illuminate\Http\Request;

class RodoRulesController extends Controller
{
    public function index()
    {
        return view('admin.rodo_rules.index', ['list'=>RodoRules::all()]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(RodoRules $rodoRules)
    {
        //
    }

    public function edit(RodoRules $rodoRules)
    {
        //
    }

    public function update(Request $request, RodoRules $rodoRules)
    {
        //
    }

    public function destroy(RodoRules $rodoRules)
    {
        //
    }
}
