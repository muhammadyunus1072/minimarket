<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessPartnerController extends Controller
{
    public function index()
    {
        return view('app.master-data.business-partner.index');
    }

    public function create()
    {
        return view('app.master-data.business-partner.detail', ["objId" => null]);
    }

    public function edit(Request $request)
    {
        return view('app.master-data.business-partner.detail', ["objId" => $request->id]);
    }
}
