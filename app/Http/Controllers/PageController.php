<?php

namespace App\Http\Controllers;

use App\Konsultacija;
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
    public function rezervisaniCasovi()
    {
        return view('cas/rezervisaniCasovi');
    }
    public function kalendar()
    {
        $konsultacije = Konsultacija::select('naziv', 'datum', 'users.name', 'konsultacija.id')->join('users', 'zakazao_id', 'users.id')->get();
        return view('prikazKalendara', [
            'konsultacije' => $konsultacije

        ]);
    }
}
