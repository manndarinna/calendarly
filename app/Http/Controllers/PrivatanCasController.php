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


    public function store(Request $request)
    {
        $trajanje = $request->sati * 3600 + $request->minuti * 60;
        if (Auth::user()->imaMestaZaCas()) {
            PrivatanCas::create([
                'naziv' => $request->naziv,
                'zakazao_id' => Auth::user()->id,
                'datum' => $request->datum,
                'trajanje' => $trajanje,
            ]);
            return back();
        } else return response()->json([
            'err' => "Vec imate maksimalan broj casova kreiranih! Kupite PRO account!"
        ]);
    }
    public function destroy($id)
    {
        if (Auth::user()->mojiCasovi()->find($id)->exists())
            PrivatanCas::find($id)->delete();
        return back();
    }

    public function update($id)
    {
        $cas = PrivatanCas::find($id);
        if (!$cas->rezervisao_id)
            $cas->rezervisao_id = Auth::user()->id;
        $cas->save();
        return redirect('home');
    }
}
