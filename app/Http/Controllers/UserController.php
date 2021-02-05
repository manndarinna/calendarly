<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $korisnici = User::paginate(6);
        return view('korisnici')->with('korisnici', $korisnici);
    }

    // primeniti logiku za prikaz casova i konsultacija!
    public function show($id)
    {
        $korisnici = User::paginate(6);
        return view('korisnici')->with('korisnici', $korisnici);
    }
}
