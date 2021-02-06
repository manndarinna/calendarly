<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $korisnici = User::where('id', '!=', Auth::id())->paginate(6);
        return view('korisnici')->with('korisnici', $korisnici);
    }

    public function show($id)
    {
        $korisnik = User::find($id);
        $konsultacije = $korisnik->mojeKonsultacije()->paginate(6);
        $casovi = $korisnik->mojiCasovi()->paginate(6);
        return view('korisnik', [
            'korisnik' => $korisnik,
            'casovi' => $casovi,
            'konsultacije' => $konsultacije
        ]);
    }
}
