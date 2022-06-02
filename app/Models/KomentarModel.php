<?php
/*Autori: Anastasija Vasić 0430/2019,
          Nikola Jovanović 0440/2019,
          Natalija Dragojević 0325/2019 */
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/*KomentarModel - klasa pomoću koje se pristupa tabeli Komentari u bazi, izvodi se iz Authenticatable
    verzija 1.0 */

class KomentarModel extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * @var boolean $timestamps
     */

    public $timestamps = false;
    /**
     * @var string $table 
     */
    protected $table = 'komentari';
    /**
     * @var int $primaryKey
     */
    protected $primaryKey = 'KomId';
    /**
     * @var string $keyType
     */
    protected $keyType = 'int';

    /**
     * @var array $fillable
     */
    protected $fillable = [
         'Tekst', 'ReceptId','KorId'
    ];

  
}
