<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamirniceReceptModel extends Model
{
    use HasFactory;

    protected $table = 'namirnicerecept';
    protected $primaryKey = 'NamId';

    public $timestamps = false;

    protected $fillable = [
        "Naziv",
        "Kolicina",
        "ReceptId"
    ];

    public static function dohvatiReceptNamirnice($ReceptId)
    {
        return NamirniceReceptModel::where("ReceptId", $ReceptId)->get();
    }

    public static function dohvatiIdRecepataNaOsnovuNamirnica($namirniceKorisnika)
    {
        $receptiId = [];
        $namirniceRecepti = NamirniceReceptModel::all()->groupBy('ReceptId')->toArray();
        foreach ($namirniceRecepti as $namirniceRecept) {
            $dovoljnoNamirnica = true;
            foreach ($namirniceRecept as $namirnicaRecept) {
                $dovoljnoNamirnicaKodKuce = false;
                foreach ($namirniceKorisnika as $namirnicaKorisnika) {
                    if (strcasecmp($namirnicaKorisnika['Naziv'], $namirnicaRecept['Naziv']) === 0 && floatval($namirnicaKorisnika['Kolicina']) >= floatval($namirnicaRecept['Kolicina'])) {
                        $dovoljnoNamirnicaKodKuce = true;
                        break;
                    }
                }
                if (!$dovoljnoNamirnicaKodKuce) {
                    $dovoljnoNamirnica = false;
                    break;
                }
            }
            if ($dovoljnoNamirnica) $receptiId[] = $namirniceRecept[0]['ReceptId'];
        }
        return $receptiId;
    }
}
