<?php

namespace App\Http\Controllers;

/**
 * Autori: Anastasija Vasic 0430/2019,
 *          Natalija Dragojevic 0325/2019
 */

use Illuminate\Http\Request;
use App\Models\ReceptModel;
use App\Models\KorisnikModel;
use App\Models\KomentarModel;
use App\Models\NamirniceReceptModel;

/**
 * Klasa Gost - izvodi se iz klase Controller, sadrzi funkcije koje obavljaju funkcionalnosti gosta
 * verzija 1.0
 */

class Gost extends Controller
{
    /**
     * Funkcija vraca pocetnu stranu web aplikacije kada joj pristupa gost. Na njoj se listaju svi recepti iz baze.
     */
    public function index()
    {
        $r = ReceptModel::all();
        return view('index', ['recepti' => $r]);
    }

    /**
     * Funkcija koja vraca stranicu na kojoj se vrsi prijava na sajt
     */
    public function prijava()
    {
        return view('login');
    }

    /**
     * Funkcija kojom se podaci uneti na stranici za prijavu proveravaju (da li korisnicko ime $korime i lozinka 
     * $lozinka zadovoljavaju format, da li su uneti svi obavezni podaci, da li je uneta odgovarajuca lozinka za korisnicki nalog),
     * te podatke pokupimo iz forme i funkcija nam vraca pocetnu stranicu web aplikacije za registrovanog 
     * korisnika na kojoj se listaju svi recepti
     */
    public function login_submit(Request $request)
    {

        $this->validate($request, [
            'korime' => 'required|min:3',
            'lozinka' => 'required|min:4'
        ], [
            'required' => 'Polje :attribute je obavezno',
            'min' => 'Polje :attribute mora da ima minimalno :min karaktera',
        ]);

        if (!auth()->attempt($request->only('korime', 'lozinka'))) {
            return back()->with('status', 'Loši kredencijali');
        }

        $korisnik = KorisnikModel::where('KorisnickoIme', $request->korime)->first();
        $request->session()->put('korid', $korisnik->KorId);

        $r = ReceptModel::all();
        return view('pocetna', ['recepti' => $r, 'kor' => $korisnik]);
    }

    /**
     * Funkcija koja vraca stranicu na kojoj se vrsi registracija na sajt
     */
    public function registracija()
    {

        return view("registracija");
    }

    /**
     * Funkcija kojom se podaci uneti na stranici za registraciju proveravaju (da li uneti podaci zadovoljavaju odgovarajuci format,
     * da li su uneti svi obavezni podaci, da li su lozinka i potvrda lozinke isti, da li postoji vec nalog sa istim imejlom ili
     * korisnickim imenom), te podatke iz forme pokupimo, kreiramo novog korisnika i onda nam funkcija vraca pocetnu stranicu web 
     * aplikacije gosta kojoj se listaju svi recepti i mozemo se onda prijaviti
     */
    public function regsubmit(Request $request)
    {

        $this->validate($request, [
            'ime' => 'required|regex:/^[a-zA-ZÑñ\s]+$/|max:20',
            'prezime' => 'required|regex:/^[a-zA-ZÑñ\s]+$/|max:20',
            'korisnickoime' => 'required|max:20',
            'email' => 'required|max:50|email',
            'sifra' => 'required|max:1000|min:3',
            'potvrdasifre' => 'required|same:sifra'
        ], [
            'required' => 'Polje :attribute je obavezno',
            'max'  => 'Polje :attribute je predugo',
            'min' => 'Polje :attribute je prekratko',
            'same:sifra' => 'Polje :attribute nije isto kao šifra',
        ]);
        $korisnik = KorisnikModel::where('KorisnickoIme', $request->korisnickoime)->first();
        if ($korisnik != null) {
            return back()->with('status', 'Korisničko ime je zauzeto');
        }

        $korisnik = KorisnikModel::where('mejl', $request->email)->first();

        if ($korisnik != null) {
            return back()->with('status', 'Postoji nalog sa tim imejlom');
        }

        $nov = KorisnikModel::create([
            'Ime' => $request->ime,
            'Prezime' => $request->prezime,
            'KorisnickoIme' => $request->korisnickoime,
            'Lozinka' => $request->sifra,
            'mejl' => $request->email

        ]);
        $nov->save();
        $r = ReceptModel::all();
        return view('index', ['recepti' => $r]);
    }
    /**
     * Funkcija koja daje prikaz recepta kao gost
     */
    public function receptpregledGost($recept){
        $r = ReceptModel::find($recept);
        $kom = KomentarModel::where('ReceptId', $recept)->get();
        $namirnice = NamirniceReceptModel::where('ReceptId', $recept)->get();
        $korisnik2 = KorisnikModel::where('KorId',$r->KorId)->first();
        return view('receptGost', ['recept' => $r, 'komentari' => $kom, 'namirnice' => $namirnice,'autor'=>$korisnik2]);

    }
/**
 * Funkcija za prikaz komentara nekog recepta za gosta
 */
    public function komentarirGost($rid){
        $kom = KomentarModel::where('ReceptId', $rid)->get();
        $r = ReceptModel::where('ReceptId', $rid)->first();
        $korisnik = KorisnikModel::where('KorId', session()->get('korid'))->first();
    
        return view('komentarGost', ['kom' => $kom, 'recept' => $r, "kor" => $korisnik]);
    }
}
