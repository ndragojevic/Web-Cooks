<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Namirnice_receptModel extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table = 'namirnicerecept';
    protected $primaryKey = 'NamId';
    protected $keyType = 'int';

    protected $fillable = [
        'Naziv','Kolicina','MerJed','ReceptId'
         
    ];

   /* public function getAuthPassword()
    {
        return $this->Lozinka;
    }*/
}
