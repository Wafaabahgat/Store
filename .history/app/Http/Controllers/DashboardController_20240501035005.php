<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public  function index()
    {
        $title = "dashboard";
        return view('dashboard',[
            'users' => "dashboard",
            'title' => title

        ]);
    }
}
