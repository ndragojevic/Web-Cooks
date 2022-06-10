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
        $response->assertViewHas("kor", $ime);
    }
}
