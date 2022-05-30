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

    public static function dohvatiReceptPoId($ReceptId)
    {
        return ReceptModel::where('ReceptId', $ReceptId)->get();
    }

    public static function dohvatiReceptePoNazivuIKategoriji($naziv, $kategorije)
    {
        $recepti = ReceptModel::select('*')->get()->toArray();
        $filtered = array_filter($recepti, function ($recept) use ($naziv, $kategorije) {
            $pripadaKategoriji = false;
            foreach ($kategorije as $kategorija) {
                if ($kategorija == "")
                    $pripadaKategoriji = true;
                else if (strcasecmp($kategorija, $recept['Kategorija']) === 0) {
                    $pripadaKategoriji = true;
                    break;
                }
            }
            $pripadaNaziv = false;
            if ($naziv == "") $pripadaNaziv = true;
            else $pripadaNaziv = !is_bool(stripos($recept['Naziv'], $naziv));
            return $pripadaNaziv && $pripadaKategoriji;
        });
        return $filtered;
    }


    public static function oceniRecept($ReceptId, $ocena)
    {

        ReceptModel::where('ReceptId', $ReceptId)->increment('ZbirOcena', $ocena);
        ReceptModel::where('ReceptId', $ReceptId)->increment('BrojOcena');
        return ReceptModel::where('ReceptId', $ReceptId)->get()->toArray();
    }
}
