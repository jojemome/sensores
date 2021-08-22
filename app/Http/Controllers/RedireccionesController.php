<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedireccionesController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function regest()
    {
        return view('regest');
    }

    public function gratemp()
    {
        return view('gratemp');
    }

    public function grahum()
    {
        return view('grahum');
    }

    public function muestramonitor()
    {
        return view('muestramonitor');
    }

    public function formtest()
    {
        return view('formtest');
    }

    public function mgt()
    {
        return view('mgt');
    }

    public function mtt()
    {
        return view('mtt');
    }
}
