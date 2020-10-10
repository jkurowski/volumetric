<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index()
    {

        $get = Notification::orderBy('id', 'desc')->get();
        $list = $get->map(function($m) {
            $m->data = json_decode($m->data);
            return $m;
        });

        return view('admin.inbox.index', ['list' => $list]);
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
        $get = Notification::whereId($id)->get();
        $message = $get->map(function($m) {
            $m->data = json_decode($m->data);
            return $m;
        });

        return view('admin.inbox.show', ['message' => $message]);
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
