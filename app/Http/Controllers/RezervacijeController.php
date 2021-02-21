<?php

namespace App\Http\Controllers;

use App\Konsultacija;
use App\PrivatanCas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RezervacijeController extends Controller
{
    public function rezervisaniCasovi()
    {
        $query = PrivatanCas::select('naziv', 'datum', 'trajanje', 'users.name', 'privatan_cas.id')->join("users", "users.id", "zakazao_id")->where('rezervisao_id', Auth::id());
        return datatables($query)->make(true);
    }
}
