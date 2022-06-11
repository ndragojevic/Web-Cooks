<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Http\Controllers\Gost;
use Illuminate\Http\Request;

class GostTest extends TestCase
{


    public function testUspesnaPrijava()
    {
        $ime = "nikola123";
        $lozinka = "nikola123";
        $response = $this->post("/loginsubmit", ["korime" => $ime, "lozinka" => $lozinka]);
        $korime = "Nikola";
        $response->assertSeeText($korime);
    }

    public function testNeUspesnaPrijava()
    {
        $ime = "nikola123";
        $lozinka = "nikola1234";
        $response = $this->post("/loginsubmit", ["korime" => $ime, "lozinka" => $lozinka]);
        $korime = "Nikola";
        $response->assertDontSeeText($korime);
    }

    public function testUspesanPregledRecepataGost()
    {
        $response = $this->get("/");
        $response->assertSeeText("Pastrmka");
    }
}
