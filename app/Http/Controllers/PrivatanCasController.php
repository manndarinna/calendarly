<?php

namespace App\Http\Controllers;

use App\PrivatanCas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivatanCasController extends Controller
{
    public function index()
    {
        $casovi = Auth::user()->mojiCasovi()->paginate(6);
        return view('casovi')->with('casovi', $casovi);
    }
    public function store(Request $request)
    {

        if (Auth::user()->imaMestaZaCas())
            PrivatanCas::create([
                'zakazao_id' => Auth::user()->id,
                'max_prijava' => $request->max_prijava,
                'datum' => $request->datum,
                'trajanje' => $request->trajanje,
            ]);
        else return response()->json([
            'err' => "Vec imate maksimalan broj casova kreiranih!"
        ]);
    }
    public function destroy($id)
    {
        if (Auth::user()->mojiCasovi()->find($id)->exists())
            PrivatanCas::find($id)->delete();
    }
    public function show($id)
    {
        $cas = PrivatanCas::find($id);
        $rezervisao = $cas->rezervisao()->first();
        return view('konsultacije', [
            'cas' => $cas,
            'rezervisao' => $rezervisao,
        ]);
    }
    public function update($id)
    {
        echo $id;
        $cas = PrivatanCas::find($id);
        if (!$cas->rezervisao_id)
            $cas->rezervisao_id = Auth::user()->id;
        $cas->save();
        return redirect('home');
    }
}
