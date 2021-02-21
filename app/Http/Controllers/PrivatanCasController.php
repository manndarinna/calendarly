<?php

namespace App\Http\Controllers;

use App\PrivatanCas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PrivatanCasController extends Controller
{
    public function get()
    {
        $casovi = Auth::user()->mojiCasovi()->with('rezervisao')->paginate(2);

        return response()->json(['casovi' => $casovi]);
    }
    public function show($idCasa)
    {
        $cas = PrivatanCas::find($idCasa);

        return view('cas', ['cas' => $cas]);
    }
    public function create()
    {

        return view('cas/formaZaCas');
    }


    public function store(Request $request)
    {
        $trajanje =  $request->get("sati") * 3600 + $request->get("minuti") * 60;
        $prilozeniDokument = null;
        if ($request->has('prilozeniDokument'))
            $prilozeniDokument = $request->file('prilozeniDokument')->store('casoviDokumenti', 'public');

        if (Auth::user()->imaMestaZaCas()) {
            PrivatanCas::create([
                'naziv' => $request->naziv,
                'zakazao_id' => Auth::user()->id,
                'datum' => $request->datum,
                'trajanje' => $trajanje,
                'prilozeniDokument' => $prilozeniDokument,
            ]);
            return response()->json([
                'message' => "Uspesno dodat cas"
            ]);
        } else return response()->json([
            'message' => "Vec imate maksimalan broj casova kreiranih! Kupite PRO account!"
        ]);
    }
    public function destroy($id)
    {
        if (Auth::user()->mojiCasovi()->find($id)->exists()) {
            PrivatanCas::find($id)->delete();
            return response()->json([
                'message' => "Cas uspesno obrisan."
            ], 200);
        }
        return response()->json([
            'message' => "Taj cas nije Vas."
        ], 400);
    }

    public function update($id)
    {
        $cas = PrivatanCas::find($id);
        if ($cas->zakazao_id == Auth::id())
            return response()->json([
                'message' => 'Ne mozete se prijaviti za Vas cas!'
            ], 400);


        if (!$cas->rezervisao_id) {
            $cas->rezervisao_id = Auth::user()->id;
            $cas->save();
            return response()->json([
                'message' => 'Uspesna prijava za cas, vidimo se!'
            ], 200);
        } else return response()->json([
            'message' => 'Cas je vec rezervisan!'
        ], 400);
    }
}
