<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivatanCas extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'naziv', 'zakazao_id', 'rezervisao_id', 'datum', 'trajanje', 'prilozeniDokument'
    ];
    public function zakazao()
    {
        return $this->belongsTo('App\User', 'zakazao_id', 'id');
    }

    public function rezervisao()
    {
        return $this->belongsTo('App\User', 'rezervisao_id', 'id');
    }
}
