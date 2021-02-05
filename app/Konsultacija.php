<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsultacija extends Model
{

    public $table = "konsultacija";
    public $timestamps = false;
    protected $fillable = [
        'naziv', 'opis', 'max_prijava', 'zakazao_id'
    ];

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
        if ($this->max_prijava >= $this->broj_prijava) {
            $this->broj_prijava++;
            $this->save();
        }
    }
    public function smanji()
    {
        if ($this->broj_prijava >= 0) {
            $this->broj_prijava--;
            $this->save();
        }
    }
}
