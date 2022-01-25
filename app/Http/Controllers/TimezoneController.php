<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;



class TimezoneController extends Controller
{

    public function __invoke($tz)
    {
        $value = str_replace(' ', '/', $tz);
        Session::put('tz', $value);
        return back();
    }
}
