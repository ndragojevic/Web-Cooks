<?php

namespace App\Http\Controllers;

use App\Models\ReceptModel;
use Illuminate\Http\Request;
use App\Models\KorisnikModel;
use App\Models\NamirniceKorisnikModel;
use App\Models\NamirniceReceptModel;

class KorisnikNamRecController extends BaseController
{

    public function recepti(Request $request)
    {
        $recepti = ReceptModel::dohvatiRecepte();
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('pocetna', ['recepti' => $recepti, 'kor' => $kor]);
    }

    public function filtrirajRecepte(Request $request)
    {
        $naziv = $request['naziv'];
        $kategorije = $request['kategorije'];
        if (is_null($naziv)) $naziv = "";
        if (is_null($kategorije)) $kategorije = "";
        $nizKategorija = explode(',', $kategorije);
        $recepti = ReceptModel::dohvatiReceptePoNazivuIKategoriji($naziv, $nizKategorija);
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('pocetna', ['recepti' => $recepti, 'kor' => $kor]);
    }


    public function filtrirajRecepteGost(Request $request)
    {
        $naziv = $request['naziv'];
        $kategorije = $request['kategorije'];
        if (is_null($naziv)) $naziv = "";
        if (is_null($kategorije)) $kategorije = "";
        $nizKategorija = explode(',', $kategorije);
        $recepti = ReceptModel::dohvatiReceptePoNazivuIKategoriji($naziv, $nizKategorija);
        return view('index', ['recepti' => $recepti]);
    }
    public function generisiReceptePoNamirnicamaKorinsika(Request $request, $id)
    {
        $namirniceKorisnik = NamirniceKorisnikModel::dohvatiKorisnikoveNamirnice($id);
        $receptiId = NamirniceReceptModel::dohvatiIdRecepataNaOsnovuNamirnica($namirniceKorisnik);
        $recepti = [];
        foreach ($receptiId as $receptId) {
            $recepti[] = ReceptModel::dohvatiReceptPoId($receptId)[0];
        }
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('pocetna', ['recepti' => $recepti, 'kor' => $kor]);
    }

    public function oceniRecept(Request $request, $ReceptId, $ocena)
    {
        $rec = ReceptModel::oceniRecept($ReceptId, $ocena);
        return response()->json([
            'id' => $rec[0]['ReceptId'],
            'ZbirOcena' => $rec[0]['ZbirOcena'],
            'BrojOcena' => $rec[0]['BrojOcena']
        ]);
    }

    public function prikaziKorisnikoveNamirnice(Request $request, $id)
    {
        $namirnice = NamirniceKorisnikModel::dohvatiKorisnikoveNamirnice($id);
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('korisnikoveNamirnice', ['namirnice' => $namirnice, "kor" => $kor]);
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
