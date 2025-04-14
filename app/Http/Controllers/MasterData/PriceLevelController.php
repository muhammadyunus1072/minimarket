<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PriceLevelController extends Controller
{
    public function index()
    {
        return view('app.master-data.price-level.index');
    }

    public function create()
    {
        return view('app.master-data.price-level.detail', ["objId" => null]);
    }

    public function edit(Request $request)
    {
        return view('app.master-data.price-level.detail', ["objId" => $request->id]);
    }
}
