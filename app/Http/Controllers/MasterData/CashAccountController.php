<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashAccountController extends Controller
{
    public function index()
    {
        return view('app.master-data.cash-account.index');
    }

    public function create()
    {
        return view('app.master-data.cash-account.detail', ["objId" => null]);
    }

    public function edit(Request $request)
    {
        return view('app.master-data.cash-account.detail', ["objId" => $request->id]);
    }
}
