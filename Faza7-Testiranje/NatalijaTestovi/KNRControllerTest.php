<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\KorisnikNamRecController;
use App\Models\ReceptModel;

class KNRControllerTest extends TestCase
{
    /**
     * Fja koja testira funkcionalnost pretrage recepata prema zadatom nazivu ('Palacinke') i to radi za registrovanog korisnika
     * ili admina
     * @return void
     */
    public function test_filtrirajRecepteNaziv(){
        //prijava na sajt:
        $ime='nadja123';
        $lozinka='nadjica';
        $response=$this->post('login/submit', ['korime'=> $ime, 'lozinka'=>$lozinka]);
        $nazivZadati='Palacinke';
        $kategorijaZadata='';
        $response=$this->post('/recepti', ['naziv'=> $nazivZadati, 'kategorije'=> $kategorijaZadata]);
        $response->assertSeeText($nazivZadati);
    }

    /**
     * Fja koja testira funkcionalnost pretrage recepata prema zadatoj kategoriji ('Glavna jela') i to radi za registrovanog korisnika
     * ili admina
     * @return void
     */
    public function test_filtrirajRecepteKategorija(){
        //prijava na sajt:
        $ime='nadja123';
        $lozinka='nadjica';
        $response=$this->post('login/submit', ['korime'=> $ime, 'lozinka'=>$lozinka]);
        $nazivZadati='';
        $kategorijaZadata='Glavna jela';
        $response=$this->post('/recepti', ['naziv'=> $nazivZadati, 'kategorije'=> $kategorijaZadata]);
        $response->assertSeeText('Pica');
    }

    /**
     * Fja koja testira funkcionalnost pretrage recepata prema zadatom nazivu ('Pasta') i to radi za gosta
     * @return void
     */
    public function test_filtrirajRecepteGostNaziv(){
        $nazivZadati='Pasta';
        $kategorijaZadata='';
        $response=$this->post('/receptiGost', ['naziv'=> $nazivZadati, 'kategorije'=> $kategorijaZadata]);
        $response->assertSeeText($nazivZadati);
        $response->assertSeeText('Registracija');
    }

    /**
     * Fja koja testira funkcionalnost pretrage recepata prema zadatoj kategoriji ('Torte i kolaci') i to radi za gosta
     * @return void
     */
    public function test_filtrirajRecepteGostKategorija(){
        $nazivZadati='';
        $kategorijaZadata='Torte i kolaci';
        $response=$this->post('/receptiGost', ['naziv'=> $nazivZadati, 'kategorije'=> $kategorijaZadata]);
        $response->assertSeeText('Kroasani');
        $response->assertSeeText('Registracija');
    }

    /**
     * Fja koja testira funkcionalnost prikazivanja liste namirnica koje korisnik ima kod kuce 
     * (tu opciju imaju registrovani korisnik i admin)
     * @return void
     */
    public function test_prikaziKorisnikoveNamirnice(){
        $ime='nadja123';
        $lozinka='nadjica';
        $response=$this->post('login/submit', ['korime'=> $ime, 'lozinka'=>$lozinka]);
        $id=session()->get('korid');
        $this->get("/namirnice" . "/" . $id); //ruta

        $response = $this->get("/namirnice/4");
        $response->assertSeeText("nadja123 namirnice:");
    }

    /**
     * Fja koja testira funkcionalnost dodavanja namirnice u listu namirnica koje korisnik ima kod kuce
     * (tu opciju imaju registrovani korisnik i admin)
     * @return void
     */
    public function test_dodajNamirnicu(){
        $ime='nadja123';
        $lozinka='nadjica';
        $response=$this->post('login/submit', ['korime'=> $ime, 'lozinka'=>$lozinka]);
        $id=session()->get("korid");

        $this->get("/namirnice" . "/" . $id);
        $response=$this->get('/namirnice/4');

        $nazivNam='Grozdje';
        $kolicinaNam='1000';
        $this->post("/namirnice/id=4/naziv=" . $nazivNam . "/Kolicina=" . $kolicinaNam, [
            'Naziv' => $nazivNam,
            'Kolicina' => $kolicinaNam,
            'KorId' => $id
        ]);
        $response=$this->get("/namirnice/4");
        $response->assertSeeText("Grozdje");
    }

    /**
     * Fja koja testira funkcionalnost uklanjanja namirnice iz liste namirnica koje korisnik ima kod kuce
     * (tu opciju imaju registrovani korisnik i admin)
     * Preduslov: u bazi postoji namirnica tikvice sa namId=29
     * @return void
     */
    public function test_ukloniNamirnicu(){
        $ime='nadja123';
        $lozinka='nadjica';
        $response=$this->post('login/submit', ['korime'=> $ime, 'lozinka'=>$lozinka]);
        $id=session()->get("korid");

        $this->get("/namirnice" . "/" . $id);
        $response=$this->get('/namirnice/4');
        $namId='29';
        $response=$this->delete('/namirnice/ukloni' . '/' . $namId, ['NamId'=> $namId]);
        $response=$this->get("/namirnice/4");
        $response->assertSeeText("Tikvice");
    }

    /**
     * Fja koja testira funkcionalnost ocenjivanja recepta
     * (tu opciju imaju registrovani korisnik i admin)
     * @return void
     */
    public function test_oceniRecept(){
        $ime='nadja123';
        $lozinka='nadjica';
        $response=$this->post('login/submit', ['korime'=> $ime, 'lozinka'=>$lozinka]);
        $id=session()->get("korid");

        $this->get("/recepti");
        $recId="48";
        $stariZbir=ReceptModel::where('ReceptId', $recId)->get('ZbirOcena');
        $ocena="4";
        $response=$this->patch("/recepti/id=" . $recId . "/ocena=" . $ocena, ['ReceptId'=>$recId,'ZbirOcena'=>$ocena]);
        $noviZbir=ReceptModel::where('ReceptId', $recId)->get('ZbirOcena');
        $this->assertNotEquals($stariZbir, $noviZbir, "");
    }
  
    /**
     * Fja koja testira funkcionalnost generisanja recepata na osnovu namirnica koje korisnik ima kod kuce
     * (tu opciju imaju registrovani korisnik i admin)
     * @return void
     */
    public function test_generisiReceptePoNamirnicamaKorinsika(){
        $ime='nadja123';
        $lozinka='nadjica';
        $response=$this->post('login/submit', ['korime'=> $ime, 'lozinka'=>$lozinka]);
        $id=session()->get("korid");

        $response=$this->post("/recepti" . "/" . $id);
        $response->assertSeeText("Kroasani");
    }
    
}
