<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class OmiljeniModel extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table = 'korisnikomiljenirecepti';
    protected $primaryKey = 'OmiljeniId';
    protected $keyType = 'int';

    protected $fillable = [
         'ReceptId' ,'KorId'
    ];

   /* public function getAuthPassword()
    {
        return $this->Lozinka;
    }*/
}
