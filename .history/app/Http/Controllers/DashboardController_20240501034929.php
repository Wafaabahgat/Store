<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public  function index()
    {
        $users = "dashboard";
        return view('dashboard',[
            'users' => "dashboard",
            ''

        ]);
    }
}
