<?php
/*Autori: Anastasija Vasić 0430/2019,
          Nikola Jovanović 0440/2019
          Natalija Dragojević 0325/2019 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * klasa NamirniceReceptModel - klasa pomoću koje se pristupa tabeli namirnicerecept u bazi, 
 * izvodi se iz Modela
 * verzija 1.0
 */


class NamirniceReceptModel extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'namirnicerecept';
    /**
     * @var string $table
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
        'Naziv','Kolicina','MerJed','ReceptId'
         
    ];
  
    /**
     * Funkcija koja vraca namirnice u odredjenom receptu na osnovu ReceptId
     * @return void
     */
    public static function dohvatiReceptNamirnice($ReceptId)
    {
        return NamirniceReceptModel::where("ReceptId", $ReceptId)->get();
    }

    /**
     * Funkcija koja vraca niz ReceptId svih recepata u kome se pojavljuju namirnice koje korisnik ima kod kuce
     */
    public static function dohvatiIdRecepataNaOsnovuNamirnica($namirniceKorisnika)
    {
        /**
         * @var array $receptiId
         */
        $receptiId = [];
        /**
         * @var array $namirniceRecepti
         */
        $namirniceRecepti = NamirniceReceptModel::all()->groupBy('ReceptId')->toArray();
        foreach ($namirniceRecepti as $namirniceRecept) {
            /**
             * @var boolean $dovoljnoNamirnica
             */
            $dovoljnoNamirnica = true;
            foreach ($namirniceRecept as $namirnicaRecept) {
                /**
                 * @var boolean $dovoljnoNamirnicaKodKuce
                 */
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
