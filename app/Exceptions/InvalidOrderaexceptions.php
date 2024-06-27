<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class InvalidOrderaexceptions extends Exception
{
    // @params  \Illuminate\Http\Request

    public function render(Request $request)
    {
        return Redirect::route('home')->withInput()->withErrors([
            'message' => $this->getMessage()
        ])
            ->with(
                'info',
                $this->getMessage()
            );
    }
}