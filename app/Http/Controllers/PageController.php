<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function korisnici()
    {
        return view('korisnici');
    }
    public function casovi()
    {
        return view('casovi');
    }
    public function konsultacije()
    {
        return view('konsultacije');
    }
}
