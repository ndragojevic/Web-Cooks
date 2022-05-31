<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class KorisnikModel extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'korisnici';
    protected $primaryKey = 'KorId';
    protected $keyType = 'int';

    protected $fillable = [
         'Ime', 'Prezime', 'KorisnickoIme', 'Lozinka','rola','mejl'
    ];

    public function getAuthPassword()
    {
        return $this->Lozinka;
    }
}
