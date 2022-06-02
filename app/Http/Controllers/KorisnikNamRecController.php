<?php

namespace App\Http\Controllers;

use App\Models\ReceptModel;
use Illuminate\Http\Request;
use App\Models\KorisnikModel;
use App\Models\NamirniceKorisnikModel;
use App\Models\NamirniceReceptModel;

/**
 * Autor: Nikola Jovanovic 0440/2019
 */

 /**
  * Klasa KorisnikNameRecController je klasa koja sadrzi metode koje vrse funkcionalnosti ocenjivanja recepta, azuriranja 
  * korisnikovih namirnica, listanja recepata na osnovu namirnica kod kuce
  */
class KorisnikNamRecController extends BaseController
{

    /**
     * Funkcija koja vraca pocetnu stranicu za ulogovanog korisnika na kojoj se listaju svi recepti
     */
    public function recepti(Request $request)
    {
        $recepti = ReceptModel::dohvatiRecepte();
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('pocetna', ['recepti' => $recepti, 'kor' => $kor]);
    }

    /**
     * Funkcija koja obavlja pretragu recepata na osnovu naziva ili kategorije i vraca pocetnu stranicu za ulogovanog
     * korisnika  na kojoj su izlistani recepti koje je pretraga nasla
     */
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

    /**
     * Funkcija koja obavlja pretragu recepata na osnovu naziva ili kategorije i vraca pocetnu stranicu za gosta
     * na kojoj su izlistani recepti koje je pretraga nasla
     */
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

    /**
     * Funkcija koja lista recepte koji se mogu napraviti od namirnica koje korisnik ima kod kuce i koja vraca
     * stranicu na kojoj se nalaze recepti koje korisnik moze da napravi.
     */
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

    /**
     * Funkcija u kojoj se recept ocenjuje, tj formira se novi zbir ocena i inkrementira se broj ocena
     */
    public function oceniRecept(Request $request, $ReceptId, $ocena)
    {
        $rec = ReceptModel::oceniRecept($ReceptId, $ocena);
        return response()->json([
            'id' => $rec[0]['ReceptId'],
            'ZbirOcena' => $rec[0]['ZbirOcena'],
            'BrojOcena' => $rec[0]['BrojOcena']
        ]);
    }

    /**
     * Funkcija koja lista namirnice koje korisnik ima kod kuce i vraca stranicu na kojoj se lista tih namirnica nalazi
     */
    public function prikaziKorisnikoveNamirnice(Request $request, $id)
    {
        $namirnice = NamirniceKorisnikModel::dohvatiKorisnikoveNamirnice($id);
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('korisnikoveNamirnice', ['namirnice' => $namirnice, "kor" => $kor]);
    }

    /**
     * Funkcija koja vrsi dodavanje namirnica u listu namirnica koje korisnik ima kod kuce
     */
    public function dodajNamirnicu(Request $request, $id, $naziv, $kolicina)
    {
        $namirnica = NamirniceKorisnikModel::dodajKorisnikuNamirnicu($id, $naziv, $kolicina);
        return response()->json([
            'id' => $namirnica->NamId,
            'Naziv' => $namirnica->Naziv,
            'Kolicina' => $namirnica->Kolicina
        ]);
    }

    /**
     * Funkcija koja vrsi brisanje namirnica iz liste namirnica koje korisnik ima kod kuce
     */
    public function ukloniNamirnicu(Request $request, $id)
    {
        NamirniceKorisnikModel::obrisiNamirnicu($id);
        return http_response_code(200);
    }
}
