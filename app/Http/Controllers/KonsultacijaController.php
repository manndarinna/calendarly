<?php

namespace App\Http\Controllers;

use App\Konsultacija;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultacijaController extends Controller
{

    public function get()
    {
        $konsultacije = Auth::user()->mojeKonsultacije()->paginate(3);
        return response()->json(['konsultacije' => $konsultacije]);
    }
    public function create()
    {
        return view('konsultacija/formaZaKonsultaciju');
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
            return response()->json([
                'message' => "Uspesno ste kreirali novu konsultaciju!"
            ], 200);
        } else return response()->json([
            'message' => "Vec imate maksimalan broj konsultacija kreiranih!"
        ], 400);
    }
    public function destroy($id)
    {
        if (Auth::user()->mojeKonsultacije()->find($id)->exists()) {
            Konsultacija::find($id)->delete();
            return response()->json([
                'message' => "Konsultacija uspesno obrisana."
            ], 200);
        }
        return response()->json([
            'message' => "Ta konsultacija nije Vasa."
        ], 400);
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

        $konsultacija = Konsultacija::find($id);
        if ($konsultacija->zakazao_id == Auth::id())
            return response()->json([
                'message' => 'Ne mozete se prijaviti za Vasu konsultaciju!'
            ], 400);

        if (Auth::user()->postojiUKonsultaciji($id)) {
            return response()->json([
                'message' => 'Vec ste prijavljeni za ovu konsultaciju!'
            ], 400);
        }
        $konsultacija->prijavljeni()->attach([Auth::id()]);

        $konsultacija->povecaj();
        return response()->json([
            'message' => 'Uspesna prijava za konsultaciju, vidimo se!'
        ], 200);
    }
}
