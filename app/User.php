<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use phpDocumentor\Reflection\Types\Integer;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role', "role_id", "id");
    }
    public function hasRole($role_name)
    {
        return $this->role()->first()->role_name == $role_name;
    }
    public function konsultacije()
    {
        return $this->belongsToMany('App\Konsultacija', 'konsultacija_users', 'user_id', 'konsultacija_id');
    }
    public function mojeKonsultacije()
    {
        return $this->hasMany('App\Konsultacija', 'zakazao_id', 'id');
    }
    public function mojiCasovi()
    {
        return $this->hasMany('App\PrivatanCas', 'zakazao_id', 'id');
    }
    private function maxKonsultacija()
    {
        if ($this->hasRole('normal'))
            return 5;
        return PHP_INT_MAX;
    }
    public function imaMestaZaKonsultaciju()
    {
        $brojKonsultacija = $this->mojeKonsultacije()->count();
        return $brojKonsultacija < $this->maxKonsultacija();
    }
    private function maxCasova()
    {
        if ($this->hasRole('normal'))
            return 7;
        return PHP_INT_MAX;
    }
    public function imaMestaZaCas()
    {
        $brojCasova = $this->mojiCasovi()->count();
        return $brojCasova < $this->maxCasova();
    }
    public function postojiUKonsultaciji($id)
    {
        $exists = $this->konsultacije()->get()->contains($id);
        return $exists;
    }
}
