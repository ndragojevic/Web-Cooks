<?php

namespace App\Http\Controllers;

use App\Models\ReceptModel;
use Illuminate\Http\Request;
use App\Models\KorisnikModel;
use App\Models\NamirniceKorisnikModel;
use App\Models\NamirniceReceptModel;
use TheSeer\Tokenizer\XMLSerializer;

class KorisnikController extends BaseController
{

    function __construct()
    {
        //$this->middleware('auth');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('index');
    }

    //        return redirect()->route('vest', ['id' => $vest->id]);

    public function recepti(Request $request)
    {
        $recepti = ReceptModel::dohvatiRecepte();
        return view('recepti', ['recepti' => $recepti]);
    }

    public function filtrirajRecepte(Request $request, $naziv, $kategorije)
    {
        $nizKategorija = explode(',', $kategorije);
        $recepti = ReceptModel::dohvatiReceptePoNazivuIKategoriji($naziv, $nizKategorija);
        dd($recepti);
    }

    public function generisiReceptePoNamirnicamaKorinsika(Request $request, $id)
    {
        $namirniceKorisnik = NamirniceKorisnikModel::dohvatiKorisnikoveNamirnice($id);
        $receptiId = NamirniceReceptModel::dohvatiIdRecepataNaOsnovuNamirnica($namirniceKorisnik);
        dd($receptiId);
    }

    public function oceniRecept(Request $request, $ReceptId, $ocena)
    {
        $rec = ReceptModel::oceniRecept($ReceptId, $ocena);
        dd($rec);
    }

    public function prikaziKorisnikoveNamirnice(Request $request, $id)
    {
        $namirnice = NamirniceKorisnikModel::dohvatiKorisnikoveNamirnice($id);
        return view('korisnikoveNamirnice', ['namirnice' => $namirnice]);
    }

    public function dodajNamirnicu(Request $request, $id, $naziv, $kolicina)
    {
        $namirnica = NamirniceKorisnikModel::dodajKorisnikuNamirnicu($id, $naziv, $kolicina);
        return response()->json([
            'id' => $namirnica->NamId,
            'Naziv' => $namirnica->Naziv,
            'Kolicina' => $namirnica->Kolicina
        ]);
    }

    public function ukloniNamirnicu(Request $request, $id)
    {
        NamirniceKorisnikModel::obrisiNamirnicu($id);
        return http_response_code(200);
    }
}
