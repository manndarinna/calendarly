<?php

namespace App\Http\Controllers;

use App\Konsultacija;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultacijaController extends Controller
{
    public function index()
    {
        $konsultacije = Auth::user()->mojeKonsultacije()->paginate(3);
        return view('konsultacije')->with('konsultacije', $konsultacije);
    }
    public function store(Request $request)
    {

        if (Auth::user()->imaMestaZaKonsultaciju()) {
            Konsultacija::create([
                'naziv' => $request->naziv,
                'opis' => $request->opis,
                'datum' => $request->datum,
                'max_prijava' => $request->max_pristalica,
                'zakazao_id' => Auth::user()->id
            ]);
            return back();
        } else return response()->json([
            'err' => "Vec imate maksimalan broj konsultacija kreiranih!"
        ]);
    }
    public function destroy($id)
    {
        if (Auth::user()->mojeKonsultacije()->find($id)->exists())
            Konsultacija::find($id)->delete();
        return back();
    }
    public function show($id)
    {
        $konsultacija = Konsultacija::find($id);
        $ucesnici = $konsultacija->prijavljeni()->orderBy('name', 'desc')->get();
        return view('konsultacija', [
            'konsultacija' => $konsultacija,
            'ucesnici' => $ucesnici,
        ]);
    }
    public function update($id)
    {
        if (Auth::user()->postojiUKonsultaciji($id)) {
            return back();
        }
        $konsultacija = Konsultacija::find($id);
        $konsultacija->prijavljeni()->attach([Auth::id()]);

        $konsultacija->povecaj();
        return back();
    }
}
