<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return view('app.master-data.product-category.index');
    }

    public function create()
    {
        return view('app.master-data.product-category.detail', ["objId" => null]);
    }

    public function edit(Request $request)
    {
        return view('app.master-data.product-category.detail', ["objId" => $request->id]);
    }
}
