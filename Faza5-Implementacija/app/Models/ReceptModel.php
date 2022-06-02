<?php
/*Autori: Anastasija Vasić 0430/2019,
          Nikola Jovanović 0440/2019
          Natalija Dragojević 0325/2019 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * klasa ReceptModel - klasa pomocu koje se pristupa tabeli recepti u bazi, izvodi se iz Modela
 * verzija 1.0
 */

class ReceptModel extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'recepti';
    /**
     * @var string $primaryKey
     */
    protected $primaryKey = 'ReceptId';

    /**
     * @var boolean $timestamps
     */
    public $timestamps = false;

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'Naziv',
        'Kategorija',
        'ZbirOcena',
        'BrojOcena',
        "SlikaJela",
        "Postupak",
        "VremeIzrade",
        "Datum",
        "KorId",
        "TezinaIzrade"
    ];

    /**
     * @var ? $casts
     */
    protected $casts = [
        'options' => AsArrayObject::class,
    ];

    /**
     * funkcija koja dohvata sve recepte iz baze
     */
    public static function dohvatiRecepte()
    {
        return ReceptModel::get();
    }

    /**
     * funkcija koja dohvata 1 recept iz baze na osnovu ReceptId
     */
    public static function dohvatiReceptPoId($ReceptId)
    {
        return ReceptModel::where('ReceptId', $ReceptId)->get();
    }

    /**
     * funkcija koja dohvata recepte koji sadrze odredjenu rec u sebi ili pripadaju jednoj od kategorija,
     * prolazi kroz sve recepte i recepte koji sadrze $naziv ili pripadaju zadatoj kategoriji $kategorije 
     * smesta u zaseban niz array_filter 
     */
    public static function dohvatiReceptePoNazivuIKategoriji($naziv, $kategorije)
    {
        $recepti = ReceptModel::select('*')->get()->toArray();
        $filtered = array_filter($recepti, function ($recept) use ($naziv, $kategorije) {
            /**
             * @var boolean $pripadaKategoriji
             */
            $pripadaKategoriji = false;
            foreach ($kategorije as $kategorija) {
                if ($kategorija == "")
                    $pripadaKategoriji = true;
                else if (strcasecmp($kategorija, $recept['Kategorija']) === 0) {
                    $pripadaKategoriji = true;
                    break;
                }
            }
            /**
             * @var boolean $pripadaNaziv
             */
            $pripadaNaziv = false;
            if ($naziv == "") $pripadaNaziv = true;
            else $pripadaNaziv = !is_bool(stripos($recept['Naziv'], $naziv));
            return $pripadaNaziv && $pripadaKategoriji;
        });
        return $filtered;
    }

    /**
     * funkcija koja ocenjuje recept, povecava se kolona ZbirOcena za vrednost $ocena i inkrementira se kolona BrojOcena
     */
    public static function oceniRecept($ReceptId, $ocena)
    {
        ReceptModel::where('ReceptId', $ReceptId)->increment('ZbirOcena', $ocena);
        ReceptModel::where('ReceptId', $ReceptId)->increment('BrojOcena');
        return ReceptModel::where('ReceptId', $ReceptId)->get()->toArray();
    }
}
