<?php

namespace App\Http\Controllers;

use App\PrivatanCas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivatanCasController extends Controller
{
    public function index()
    {
        $casovi = Auth::user()->mojiCasovi()->with('rezervisao')->paginate(6);
        return view('casovi')->with('casovi', $casovi);
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
