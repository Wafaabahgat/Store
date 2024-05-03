<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

public function __

    public  function index()
    {
        $title = 'Storey';
        return view('dashboard/index', [
            'user' => "WaFaa",
            'title' => $title,
        ]);
    }
}
