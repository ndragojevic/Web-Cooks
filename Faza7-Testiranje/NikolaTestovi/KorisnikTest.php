<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Http\Controllers\Korisnik;
use App\Models\OmiljeniModel;

class KorisnikTest extends TestCase
{

    private function prijavi()
    {
        $ime = "nikola123";
        $lozinka = "nikola123";
        $this->post("/loginsubmit", ["korime" => $ime, "lozinka" => $lozinka]);
        $korime = "Nikola";
    }

    public function testUspesanPregledRecepataKorisnik()
    {
        $this->prijavi();
        $response = $this->get("/pocetna");
        $response->assertSeeText("Pastrmka");
    }

    public function testUspesnoDodavanjeRecepta()
    {
        $this->prijavi();
        $receptNaziv = "recnaziv";
        $this->post("/novirecept", [
            'Naziv' => $receptNaziv,
            'Kategorija' => "Glavna Jela",
            'SlikaJela' => file('public/img/jaja.jpg'),
            'Postupak' => "Neki postupak",
            'VremeIzrade' => "25",
            'Datum' => now(),
            'KorId' => session()->get("korid"),
            'TezinaIzrade' => "Lako"
        ]);
        $response = $this->get("/pocetna");
        $response->assertSeeText($receptNaziv);
    }

    public function testNeUspesnoDodavanjeRecepta()
    {
        // fali slika
        $this->prijavi();
        $response = $this->post("/novirecept", [
            'Naziv' => "_naziv_recept",
            'Kategorija' => "Glavna Jela",
            'Postupak' => "Neki postupak",
            'VremeIzrade' => "25",
            'Datum' => now(),
            'KorId' => session()->get("korid"),
            'TezinaIzrade' => "Lako"
        ]);
        $response->assertSeeText("Polje slika je obavezno");
        $response = $this->get("/pocetna");
        $response->assertDontSeeText("_naziv_recept");
    }

    public function testUspesnoDodavanjeReceptaUOmiljene()
    {
        $this->prijavi();
        $receptId = "47";
        $receptNaziv = "Pica sa spanacem i sirom";
        $this->get("/dodajomiljeni" . "/" . $receptId);
        $response = $this->get("/omrecepti");
        $response->assertSeeText($receptNaziv);
    }
}
