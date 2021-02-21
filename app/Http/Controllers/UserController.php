<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    public function get()
    {

        $korisnici = User::where('id', '!=', Auth::id())->paginate(1);
        return response()->json(['korisnici' => $korisnici]);
    }
    public function search(Request $request)
    {
        $korisnici = User::where('name', 'like', '%' . $request->name . '%')->get();
        return response()->json(['korisnici' => $korisnici]);
    }

    public function getByName(Request $request)
    {
        $id = null;
        $korisnik = User::where('name', $request->query('name'))->first();
        if (!$korisnik) {
            return Redirect::to('http://127.0.0.1:8000/korisnici');
        } else
            $id = $korisnik->id;

        return Redirect::to('http://127.0.0.1:8000/korisnik/' . $id);
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
