<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{

    public function index()
    {
        return view('admin.log.index', ['list' => Activity::all()]);
    }

    public function destroy($id)
    {
        //
    }
}
