<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class KomentarModel extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table = 'komentari';
    protected $primaryKey = 'KomId';
    protected $keyType = 'int';

    protected $fillable = [
         'Tekst', 'ReceptId','KorId'
    ];

  
}
