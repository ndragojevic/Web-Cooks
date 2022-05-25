<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class ReceptModel extends Model
{
    use HasFactory;

    protected $table = 'recepti';
    protected $primaryKey = 'ReceptId';

    public $timestamps = false;

    protected $fillable = [
        'Naziv',
        'Kategorija',
        'ZbirOcena',
        'BrojOcena',
        //"SlikaJela",
        "Postupak",
        "VremeIzrade",
        "Datum",
        "KorId",
        "TezinaIzrade"
    ];

    protected $casts = [
        'options' => AsArrayObject::class,
    ];

    public static function dohvatiRecepte()
    {
        return ReceptModel::get();
    }

    public static function dohvatiReceptePoNazivuIKategoriji($naziv, $kategorije)
    {
        $recepti = ReceptModel::select('Naziv', 'Kategorija')->get()->toArray();
        $filtered = array_filter($recepti, function ($recept) use ($naziv, $kategorije) {
            $pripadaKategoriji = false;
            foreach ($kategorije as $kategorija) {
                if (strcasecmp($kategorija, $recept['Kategorija']) === 0) {
                    $pripadaKategoriji = true;
                    break;
                }
            }
            return !is_bool(strpos($recept['Naziv'], $naziv)) && $pripadaKategoriji;
        });
        return $filtered;
    }


    public static function oceniRecept($ReceptId, $ocena)
    {

        ReceptModel::where('ReceptId', $ReceptId)->increment('ZbirOcena', $ocena);
        return ReceptModel::where('ReceptId', $ReceptId)->increment('BrojOcena');
    }
}
