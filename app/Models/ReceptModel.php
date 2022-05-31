<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ReceptModel extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table = 'recepti';
    protected $primaryKey = 'ReceptId';
    protected $keyType = 'int';

    protected $fillable = [
         'Naziv', 'Kategorija','SlikaJela','Postupak','VremeIzrade','Datum' ,'KorId'
    ];

   /* public function getAuthPassword()
    {
        return $this->Lozinka;
    }*/
}
