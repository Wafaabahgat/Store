<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public  function index()
    {
        $title = 'Storey';
        return view('dashboard',[
            'user' => "dashboard",
            'title' => $title

        ]);
    }
}
