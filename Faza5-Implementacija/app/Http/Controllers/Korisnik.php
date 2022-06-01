<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReceptModel;
use App\Models\NamirniceReceptModel;
use App\Models\KomentarModel;
use App\Models\OmiljeniModel;
use App\Models\KorisnikModel;


class Korisnik extends Controller
{


    public function pocetna()
    {
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('pocetna', ['kor' => $kor]);
    }
    public function dodajrecept()
    {
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('dodajrecept', ['kor' => $kor]);
    }

    public function novirecept(Request $request)
    {

        $recept = ReceptModel::create([
            'Naziv' => $request->name,
            'Kategorija' => $request->category,
            'SlikaJela' => $request->slika,
            'Postupak' => $request->username,
            'VremeIzrade' => $request->Workduration,
            'Datum' => now(),
            'KorId' => $request->session()->get('korid')
        ]);
        $recept->save();
        $request->session()->put('rid', $recept->ReceptId);
        $namirnice = array();
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('dodajnamirnice', ['namirnice' => $namirnice, 'kor' => $kor]);
    }

    public function novanamirnica(Request $request)
    {
        $namirnica = NamirniceReceptModel::create([
            'Naziv' => $request->imenam,
            'Kolicina' => $request->kolicina,
            'MerJed' => $request->mernajed,
            'ReceptId' =>  $request->session()->get('rid')
        ]);
        $namirnice = NamirniceReceptModel::where('ReceptId', $request->session()->get('rid'))->get();

        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();

        return view('dodajnamirnice', ['namirnice' => $namirnice, 'kor' => $kor]);
    }

    public function pregled()
    {
        $r = ReceptModel::all();
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view("recepti", ['pocetna' => $r, 'kor' => $kor]);
    }

    public function novikomentar(Request $request)
    {
        echo  $request->session()->get('komid');
    }
    public function omrecepti()
    {
        $om = OmiljeniModel::where('KorId', session()->get('korid'))->get();
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('omiljeni', ['omiljeni' => $om, 'kor' => $kor]);
    }
    public function mojirecepti()
    {
        $r = ReceptModel::where('KorId', session()->get('korid'))->get();
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('mojirec', ['recepti' => $r, 'kor' => $kor]);
    }
    public function pregledrecepataK()
    {
        $r = ReceptModel::all();
        $kor = KorisnikModel::where('KorId', session()->get('korid'))->first();
        return view('pocetna', ['recepti' => $r, 'kor' => $kor]);
    }
}
