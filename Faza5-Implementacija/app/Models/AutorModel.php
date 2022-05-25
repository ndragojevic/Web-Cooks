<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class KorisnikModel extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'korisnici';
    protected $primaryKey = 'KorId';

    protected $fillable = [
        'KorisnickoIme', 'Lozinka', 'Ime', 'Prezime', 'mejl', 'rola'
    ];

    public function getAuthPassword()
    {
        return $this->lozinka;
    }

    public static function dohvId($KorisnickoIme)
    {
        return KorisnikModel::where('KorisnickoIme', $KorisnickoIme)->get()->KorId;
    }
}
