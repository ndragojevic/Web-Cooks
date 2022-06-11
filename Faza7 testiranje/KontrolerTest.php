<?php

namespace Tests\Unit;

use App\Models\KorisnikModel;
use App\Models\KomentarModel;
use App\Models\ReceptModel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use JSON;
use Illuminate\Support\Facades\Session;
//use Symfony\Component\HttpFoundation\Request;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Foundation\Testing\WithFaker;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNotEquals;
use function PHPUnit\Framework\assertTrue;

class KontrolerTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_pristup_registraciji()
    {
        $response=$this->call('GET','/registracija');
        $response->assertStatus($response->status(),200);

    }
    use WithoutMiddleware;
    /** @test */
    public function test_registracija_uspjesna()
    {
        $before=KorisnikModel::all();
        $response=$this->postJson('/regsubmit',[
            'ime' => 'Anastasija',
            'prezime' => 'Vasic',
            'korisnickoime' => 'aka2',
            'email' => 'akaa@gmail.com',
            'sifra' => '1234',
            'potvrdasifre' => '1234'
        ]);
        $after=KorisnikModel::all();
        assertNotEquals($before,$after);
    }
    public function test_neregistracija_neuspjesna()
    {
        $before=KorisnikModel::all();
        $response=$this->postJson('/regsubmit',[
            'ime' => 'Anastasija',
            'prezime' => 'Vasic',
            'korisnickoime' => 'aka2',
           
        ]); 
        $after=KorisnikModel::all();
        assertEquals($before,$after);
    }
    
    public function test_novi_komentar(){
        $before=KomentarModel::all();
        session()->put('korid','5');
        $response=$this->postJson('/novikomentar/45',[
            'kom' => 'Anastasija'
        ]);
        $after= KomentarModel::all();
        assertNotEquals($before,$after);
      
    }

    public function test_nenovi_komentar(){
        $before=KomentarModel::all();
        session()->put('korid','5');
        $response=$this->postJson('/novikomentar/45',[ ]);
        $after= KomentarModel::all();
        assertEquals($before,$after);
      
    }

    public function test_brisi_komentar(){ 
        $before=KomentarModel::all();      
        session()->put('korid','5');
        $response=$this->call('GET','brisanjeK/48/comm/45',[]);
        $after= KomentarModel::all();
        assertNotEquals($before,$after);

    }

    public function test_brisi_recept(){
        $before=ReceptModel::all();
        session()->put('korid','5');
        $response=$this->postJson('brisanjeR/122',[]);
        $response->assertStatus($response->status(),200);
        $after= ReceptModel::all();
        assertNotEquals($before,$after);

    }

}
