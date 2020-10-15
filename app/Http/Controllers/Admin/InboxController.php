<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index()
    {
        return view('admin.inbox.index', ['list' => Notification::orderBy('id', 'desc')->get()]);
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('admin.inbox.show', ['message' => Notification::whereId($id)->get()]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
