<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $panel = '';

        if (auth()->user()->hasRole(config('template.admin_role'))) {
            $panel = 'admin';
        } else if(auth()->user()->hasRole(config('template.cashier_role'))) {
            $panel = 'cashier';
        }else{
            $panel = 'member';
        }
        
        return view('app.dashboard.'.$panel);
    }

    public function customer(Request $request)
    {
        return json_encode(User::all());
    }
}
