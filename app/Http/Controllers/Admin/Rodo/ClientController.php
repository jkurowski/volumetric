<?php

namespace App\Http\Controllers\Admin\Rodo;

use App\Http\Controllers\Controller;
use App\Models\RodoClient;
use App\Models\RodoClientRules;

class ClientController extends Controller
{
    function index(){
        return view('admin.rodo_clients.index', [
            'list' => RodoClient::latest()->get()
        ]);
    }

    function show($id){
        return view('admin.rodo_clients.show', [
            'client' => RodoClient::whereId($id)->firstOrFail(),
            'list' => RodoClientRules::where('rodo_client_id', $id)->orderBy('id', 'desc')->with('rules')->get()
        ]);
    }
}
