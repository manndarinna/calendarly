<?php

namespace App\Http\Controllers;

use App\Konsultacija;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultacijaController extends Controller
{
    public function index()
    {
        $konsultacije = Auth::user()->mojeKonsultacije()->get();
        return view('konsultacije')->with('konsultacije', $konsultacije);
    }
    public function store(Request $request)
    {

        if (Auth::user()->imaMestaZaKonsultaciju())
            Konsultacija::create([
                'naziv' => $request->naziv,
                'opis' => $request->opis,
                'max_prijava' => $request->max_prijava,
                'zakazao_id' => $request->Auth::user()->id
            ]);
        else return response()->json([
            'err' => "Vec imate maksimalan broj konsultacija kreiranih!"
        ]);
    }
    public function destroy($id)
    {
        if (Auth::user()->mojeKonsultacije()->find($id)->exists())
            Konsultacija::find($id)->delete();
    }
    public function show($id)
    {
        $konsultacija = Konsultacija::find($id);
        $ucesnici = $konsultacija->prijavljeni()->orderBy('name', 'desc')->get();
        return view('konsultacije', [
            'konsultacija' => $konsultacija,
            'ucesnici' => $ucesnici,
        ]);
    }
}