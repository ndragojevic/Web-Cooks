<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReceptModel;
use App\Models\NamirniceReceptModel;
use App\Models\KomentarModel;
use App\Models\OmiljeniModel;
use App\Models\KorisnikModel;

/**
 * Autori: Anastasija Vasic 0430/2019,
 *          Natalija Dragojevic 0325/2019
 */

/**
 * Klasa Korisnik - izvodi se iz klase Controller, sadrzi funkcije koje obavljaju funkcionalnosti registrovanog korisnika i admina
 * verzija 1.0
 */
class Korisnik extends Controller
{

    /**
     * Funkcija koja vraca odgovarajucu pocetnu stranicu web aplikacije za registrovanog korisnika i admina
     */
    public function pocetna()
    {
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('pocetna', ['kor' => $kor]);
    }

    /**
     * Funkcija koja vraca stranicu na kojoj se vrsi dodavanje recepta
     */
    public function dodajrecept()
    {
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('dodajrecept', ['kor' => $kor]);
    }

    /**
     * Funkcija koja kupi podatke iz forme za dodavanje recepta, proverava da li su uneti svi obavezni podaci, kreira novi 
     * recept i vraca stranicu za dodavanje namirnica za isti recept
     */
    public function novirecept(Request $request)
    {
       $this->validate($request, [
        'name' => 'required',
        'slika' => 'required',
        'username' => 'required',
        'Workduration' => 'required'
    ], [
        'required' => 'Polje :attribute je obavezno',
    ]);
   
        $recept = ReceptModel::create([
            'Naziv' => $request->name,
            'Kategorija' => $request->category,
            'SlikaJela' => $request->slika,
            'Postupak' => $request->username,
            'VremeIzrade' => $request->Workduration,
            'Datum' => now(),
            'KorId' => $request->session()->get('korid'),
            'TezinaIzrade' => $request->level
        ]);
        $recept->save();
        $request->session()->put('rid', $recept->ReceptId);
        $namirnice = array();
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('dodajnamirnice', ['namirnice' => $namirnice, 'kor' => $kor]);
    }

    /**
     * Funkcija koja proverava da li su uneti svi obavezni podaci prilikom dodavanja namirnice, kreira novu namirnicu, cuva je u
     * bazi i vraca istu stranicu za dodavanje namirnica sa dodatim namirnicama
     */
    public function novanamirnica(Request $request)
    {
        $this->validate($request, [
            'imenam' => 'required',
            'kolicina' => 'required'
        ], [
            'required' => 'Polje :attribute je obavezno'
        ]);
        $namirnica = NamirniceReceptModel::create([
            'Naziv' => $request->imenam,
            'Kolicina' => $request->kolicina,
            'MerJed' => $request->mernajed,
            'ReceptId' =>  $request->session()->get('rid')
        ]);
        $namirnica->save();
        $namirnice = NamirniceReceptModel::where('ReceptId', $request->session()->get('rid'))->get();

        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();

        return view('dodajnamirnice', ['namirnice' => $namirnice, 'kor' => $kor]);
    }

    /**
     * Funkcija koja vraca pocetnu stranicu na kojoj su izlistani svi recepti
     */
    public function pregled()
    {
        $r = ReceptModel::all();
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        //DODAJ
        return view("recepti", ['pocetna' => $r, 'kor' => $kor]);
    }

    /**
     * Funkcija koja lista omiljene recepte i vraca stranicu sa omiljenim receptima za ulogovanog korisnika
     */
    public function omrecepti()
    {
        $om = OmiljeniModel::where('KorId', session()->get('korid'))->get();
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('omiljeni', ['omiljeni' => $om, 'kor' => $kor]);
    }

    /**
     * Funkcija koja lista recepte koje je ulogovani korisnik napravio i vraca stranicu sa njegovim receptima
     */
    public function mojirecepti()
    {
        $r = ReceptModel::where('KorId', session()->get('korid'))->get();
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('mojirec', ['recepti' => $r, 'kor' => $kor]);
    }

    /**
     * Funkcija koja se poziva klikom na dugme 'Pregled recepata' i vraca pocetnu stranicu za ulogovanog korisnika na kojoj 
     * su izlistani svi recepti
     */
    public function pregledrecepataK()
    {
        $r = ReceptModel::all();
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('pocetna', ['recepti' => $r, 'kor' => $kor]);
    }

    /**
     * Funkcija koja sluzi za dodavanje novog komentara ispod recepta. Proverava da li su uneti svi obavezni podaci, kreira se
     * novi komentar i dodaje se u bazu. Funkcija vraca stranicu na kojoj se prikazuje recept odakle se moze otici na prikaz komentara
     */
    public function novikomentarr(Request $request, $recept){
        $this->validate($request, [
            'kom' => 'required'
        ], [
            'required' => 'Polje :attribute je obavezno'
        ]);
        $kom = KomentarModel::create([
            'ReceptId' => $recept,
            'KorId' => $request->session()->get('korid'),
            'Tekst' => $request->kom
        ]);
        $kom->save();
        $r = ReceptModel::find($recept);
        $kom = KomentarModel::where('ReceptId', $recept)->get();
        $namirnice = NamirniceReceptModel::where('ReceptId', $recept)->get();
        $korisnik = KorisnikModel::where('KorId', session()->get('korid'))->first();
        $korisnik2 = KorisnikModel::where('KorId',$r->KorId)->first();
        if ($korisnik->rola == 'user'){
        return view('recept', ['recept' => $r, 'komentari' => $kom, 'namirnice' => $namirnice, "kor" => $korisnik,'autor'=>$korisnik2]);
        }
        else  return view('receptA', ['recept' => $r, 'komentari' => $kom, 'namirnice' => $namirnice, "kor" => $korisnik,'autor'=>$korisnik2]);

    }
    /**
     * Funkcija za dodavanje recepta u omiljene, ako korisnik vec nije dodao dati recept u omiljene onda preko modela dodajemo u tabelu
     * nov omiljeni recept za datog korisnika
     */
    public function dodajomiljeni($recept){

        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        $om=OmiljeniModel::where('KorId',$kor->KorId)->where('ReceptId',$recept)->first();
        if($om!=null){
            $r = ReceptModel::find($recept);
            $kom = KomentarModel::where('ReceptId', $recept)->get();
            $namirnice = NamirniceReceptModel::where('ReceptId', $recept)->get();
            $korisnik2 = KorisnikModel::where('KorId',$r->KorId)->first();
            if ($kor->rola == 'user'){
            return view('recept', ['recept' => $r, 'komentari' => $kom, 'namirnice' => $namirnice, "kor" => $kor,'autor'=>$korisnik2]);
            }
            else  return view('receptA', ['recept' => $r, 'komentari' => $kom, 'namirnice' => $namirnice, "kor" => $kor,'autor'=>$korisnik2]);
    
        }
        $omiljeni = OmiljeniModel::create([
            'ReceptId' => $recept,
    
            'KorId' => session()->get('korid')
            ]);
            $omiljeni->save();
        
            $r = ReceptModel::find($recept);
            $kom = KomentarModel::where('ReceptId', $recept)->get();
            $namirnice = NamirniceReceptModel::where('ReceptId', $recept)->get();
            $korisnik2 = KorisnikModel::where('KorId',$r->KorId)->first();
            if ($kor->rola == 'user'){
                return view('recept', ['recept' => $r, 'komentari' => $kom, 'namirnice' => $namirnice, "kor" => $kor,'autor'=>$korisnik2]);
                }
                else  return view('receptA', ['recept' => $r, 'komentari' => $kom, 'namirnice' => $namirnice, "kor" => $kor,'autor'=>$korisnik2]);

    }
    /**
     * Funkcija za brisanje namirnice za odredjeni recept, vraca se stranica gde se dodaju namirnice za recept
     */

    public function obrisimirnicu($nim){
        NamirniceReceptModel::where('NamId', $nim)->delete();
        $namirnice = NamirniceReceptModel::where('ReceptId', session()->get('rid'))->get();
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('dodajnamirnice', ['namirnice' => $namirnice,'kor'=>$kor]);
    }
    /**
    * Funkcija koja vraca prikaz recepta
    */
    public function receptpregled($recept){

        $r = ReceptModel::find($recept);
        $kom = KomentarModel::where('ReceptId', $recept)->get();
        $namirnice = NamirniceReceptModel::where('ReceptId', $recept)->get();
        $korisnik = KorisnikModel::where('KorId', session()->get('korid'))->first();
        $korisnik2 = KorisnikModel::where('KorId',$r->KorId)->first();
        if ($korisnik->rola == 'user') {
            return view('recept', ['recept' => $r, 'komentari' => $kom, 'namirnice' => $namirnice,'kor'=>$korisnik,'autor'=>$korisnik2]);
        } else  return view('receptA', ['recept' => $r, 'komentari' => $kom, 'namirnice' => $namirnice,'kor'=>$korisnik, 'autor'=>$korisnik2]);

    }
    /**
     * Funkcija za prikaz komentara za dati recept
     */
    public function komentarir($rid){
        $kom = KomentarModel::where('ReceptId', $rid)->get();
        $r = ReceptModel::where('ReceptId', $rid)->first();

        $korisnik = KorisnikModel::where('KorId', session()->get('korid'))->first();

        if ($korisnik->rola == 'user') {
            return view('komentar', ['kom' => $kom, 'recept' => $r, "kor" => $korisnik]);
        } else {
            return view('komentarA', ['kom' => $kom, 'recept' => $r, "kor" => $korisnik]);
        }
    }

    /**
     * Funkcija za brisanje komentara za odredjeni recept od strane admina
     */
    public function brisanjeK($kid, $rid){
        KomentarModel::where('KomId', $kid)->delete();
        $kom = KomentarModel::where('ReceptId', $rid)->get();
        $r = ReceptModel::where('ReceptId', $rid)->first();
        $korisnik = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('komentarA', ['kom' => $kom, 'recept' => $r, "kor" => $korisnik]);

    }

    /**
     * Funkcija kojom se ulogovani korisnik odjavljuje i prelazi se na pocetnu stranicu
     */
    public function odjava(Request $request){
        
        $request->session()->flush();
        $r = ReceptModel::all();
        return view('index', ['recepti' => $r]);

    }

    /**
     * Funkcija za brisanje komentara od strane admina, vracamo se na stranicu koja prikazuje komentare za neki recept
     */
    public function brisanjeR(Request $request, $recept){
        NamirniceReceptModel::where('ReceptId', $recept)->delete();
        KomentarModel::where('ReceptId', $recept)->delete();
        OmiljeniModel::where('ReceptId', $recept)->delete();
        ReceptModel::where('ReceptId', $recept)->delete();
        $r = ReceptModel::all();
        $korisnik = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view("pocetna", ['recepti' => $r, "kor" => $korisnik]);

    }

}
