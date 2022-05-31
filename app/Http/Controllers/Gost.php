<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReceptModel;
use App\Models\KorisnikModel;

class Gost extends Controller
{
    public function index(){
        $r=ReceptModel::all();
        return view('index',['recepti' => $r]);
    }

    public function prijava(){
        return view('login');
    }

    public function login_submit(Request $request){
        
        $this->validate($request, [
            'korime' => 'required|min:3',
            'lozinka' => 'required|min:4'
        ], [
            'required' => 'Polje :attribute je obavezno',
            'min' => 'Polje :attribute mora da ima minimalno :min karaktera',
        ]);
        
        if(!auth()->attempt($request->only('korime', 'lozinka'))) {
            return back()->with('status', 'Loši kredencijali');
        }
        
        $korisnik=KorisnikModel::where('KorisnickoIme', $request->korime)->first();
        $request->session()->put('korid',$korisnik->KorId);
      
       // $request->session()->push('namirnice2', []);
       // $this->Session::set('namirnice2', $nam);
       
       $r=ReceptModel::all();
       if($korisnik->rola=='admin'){
           //return view('index',['recepti' => $r]);
       }
        return view('pocetna',['recepti' => $r]);
    }

    public function registracija(){

        return view("registracija");
    }

    public function regsubmit(Request $request){

       $this->validate($request, [
        'ime' => 'required|regex:/^[a-zA-ZÑñ\s]+$/|max:20',
        'prezime' =>'required|regex:/^[a-zA-ZÑñ\s]+$/|max:20',
        'korisnickoime' =>'required|max:20',
        'email' =>'required|max:50|email',
        'sifra' =>'required|max:1000|min:3',
        'potvrdasifre' =>'required|same:sifra'
    ], [
       'required' => 'Polje :attribute je obazeno',
       'max'  => 'Polje :attribute je predugo',
       'min' => 'Polje :attribute je prekratko',   
       'same:sifra' => 'Polje :attribute nije isto kao sifra',
    ]);
    $korisnik=KorisnikModel::where('KorisnickoIme',$request->korisnickoime)->first();
    if($korisnik != null){
        return back()->with('status', 'Korisničko ime je zauzeto');
    }

    $korisnik=KorisnikModel::where('mejl',$request->email)->first();

    if($korisnik != null){
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
    $r=ReceptModel::all();
    return view('index',['recepti' => $r]);

    }

}
