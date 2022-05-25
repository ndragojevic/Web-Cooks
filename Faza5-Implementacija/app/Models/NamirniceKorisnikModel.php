<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamirniceKorisnikModel extends Model
{
    use HasFactory;

    protected $table = 'namirnicekorisnik';
    protected $primaryKey = 'NamId';

    public $timestamps = false;

    protected $fillable = [
        "Naziv",
        "NamId",
        "Kolicina",
        "KorId"
    ];

    public static function dohvatiKorisnikoveNamirnice($KorId)
    {
        return NamirniceKorisnikModel::where("KorId", $KorId)->get()->toArray();
    }

    public static function dodajKorisnikuNamirnicu($KorId, $Naziv, $Kolicina)
    {
        return NamirniceKorisnikModel::create([
            "Naziv" => $Naziv,
            "Kolicina" => $Kolicina,
            "KorId" => $KorId
        ]);
    }

    public static function obrisiNamirnicu($NamId)
    {
        NamirniceKorisnikModel::where("NamId", $NamId)->delete();
    }
}
