<?php
/*Autori: Anastasija Vasić 0430/2019,
          Nikola Jovanović 0440/2019
          Natalija Dragojević 0325/2019 */
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
/*KorisnikModel - klasa pomoću koje se pristupa tabeli Korisnik u bazi, izvodi se iz Authenticatable
    verzija 1.0 */
class KorisnikModel extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * @var boolean $timestamps
     */
    public $timestamps = false;
    /**
     * @var string $table
     */
    protected $table = 'korisnici';
    /**
     * @var string $primaryKey
     */
    protected $primaryKey = 'KorId';
    /**
     * @var string $keyType
     */
    protected $keyType = 'int';


    /**
     * @var array $fillable
     */
    protected $fillable = [
         'Ime', 'Prezime', 'KorisnickoIme', 'Lozinka','rola','mejl'
    ];

    /**
     * (koristi se prilikom provere ispravnosti lozinke)
     */
    public function getAuthPassword()
    {
        return $this->Lozinka;
    }
}
