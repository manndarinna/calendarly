<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsultacija extends Model
{
    public $table = "konsultacija";
    public $timestamps = false;

    public function zakazao()
    {
        return $this->belongsTo('App\User', 'zakazao_id', 'id');
    }
    public function prijavljeni()
    {
        return $this->belongsToMany('App\User', 'konsultacija_users', 'konsultacija_id', 'user_id');
    }
    public function povecaj()
    {
        $this->broj_prijava++;
        $this->save();
    }
    public function smanji()
    {
        $this->broj_prijava++;
        $this->save();
    }
}
