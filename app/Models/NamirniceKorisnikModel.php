<?php
/*Autori: Anastasija Vasić 0430/2019,
          Nikola Jovanović 0440/2019
          Natalija Dragojević 0325/2019 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * klasa NamirniceKorisnikModel - klasa pomoću koje se pristupa tabeli namirnicekorisnik u bazi, 
 * izvodi se iz Modela
 * verzija 1.0
 */

class NamirniceKorisnikModel extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'namirnicekorisnik';
    /**
     * @var string $primaryKey
     */
    protected $primaryKey = 'NamId';

    /**
     * @var boolean $timestamps
     */
    public $timestamps = false;

    /**
     * @var array $fillable
     */
    protected $fillable = [
        "Naziv",
        "NamId",
        "Kolicina",
        "KorId"
    ];

    /**
     * Funkcija koja vraća niz namirnica koje su vezane za 1 korisnika (pomoću KorId), tj koje je korisnik sa KorId ubacio u bazu
     * 
     */
    public static function dohvatiKorisnikoveNamirnice($KorId)
    {
        return NamirniceKorisnikModel::where("KorId", $KorId)->get()->toArray();
    }

    /**
     * Funkcija koja ubacuje u tabelu namirnicekorisnik novu namirnicu koju je korisnik KorId ubacio
     */
    public static function dodajKorisnikuNamirnicu($KorId, $Naziv, $Kolicina)
    {
        return NamirniceKorisnikModel::create([
            "Naziv" => $Naziv,
            "Kolicina" => $Kolicina,
            "KorId" => $KorId
        ]);
    }

    /**
     * Funkcija koja briše određenu (NamId) namirnicu iz tabele namirnicekorisnik
     * @return void
     */
    public static function obrisiNamirnicu($NamId)
    {
        NamirniceKorisnikModel::where("NamId", $NamId)->delete();
    }
}
