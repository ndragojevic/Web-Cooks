<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReceptModel;
use App\Models\Namirnice_receptModel;
use App\Models\KomentarModel;
use App\Models\OmiljeniModel;


class Korisnik extends Controller
{
   
    public function pocetna(){
        return view('pocetna');
    }
    public function dodajrecept(){
        return view('dodajrecept');
    }
    
    public function novirecept(Request $request){
        
        $recept = ReceptModel::create([
            'Naziv' => $request->name,
            'Kategorija' => $request->category,
            'SlikaJela' => $request->slika,
            'Postupak' => $request->username,
            'VremeIzrade' => $request->Workduration,
            'Datum'=> now(),
            'KorId' => $request->session()->get('korid')
        ]);
        $recept->save();
        $request->session()->put('rid',$recept-> ReceptId);
        $namirnice=array();
       //  Namirnice_receptModel::find($recept-> ReceptId);

        return view('dodajnamirnice',['namirnice' => $namirnice]);
       
    }
   
    public function novanamirnica(Request $request){
        $namirnica = Namirnice_receptModel::create([
            'Naziv' =>$request->imenam,
            'Kolicina' => $request->kolicina,
            'MerJed' => $request->mernajed,
            'ReceptId'=>  $request->session()->get('rid')
        ]);
        $namirnice= Namirnice_receptModel::where('ReceptId',$request->session()->get('rid'))->get( );
       /* $namirnice=$request->session()->get('namirnice2');
        $i=0;
        /*
        foreach ( $namirnice as $namirnica )
            $i++;
  
        $namirnice[$i]=$request->imenam;
        $namirnice[$i+1]=$request->kolicina;
*/
        //$request->session()->push('namirnice2', $namirnice);
       // $request->session()->push('namirnice2', $namirnice);
      
       return view('dodajnamirnice',['namirnice' => $namirnice]);
      // return redirect()->route('dodajrecept',['namirnice' => $namirnice]);  
     

    }

    public function pregled(){
        $r=ReceptModel::all();
        return view("recepti",['pocetna' => $r]);
    }
    
    public function novikomentar(Request $request){
        echo  $request->session()->get('komid');
        /*

        $kom = KomentarModel::create([
           'ReceptId'=> $request->session()->get('komid'),
            'KorId' => $request->session()->get('korid'),
            'Tekst' =>$request->kom
        ]);
        $kom->save();*/

    }
    public function omrecepti(){
        $om=OmiljeniModel::where('KorId', session()->get('korid'))->get();
        return view('omiljeni',['omiljeni'=>$om]);
    }
    public function mojirecepti(){
        $r=ReceptModel::where('KorId',session()->get('korid'))->get();
        return view('mojirec',['recepti'=>$r]);
    }
    public function pregledrecepataK(){
        $r=ReceptModel::all();
        return view('pocetna',['recepti' => $r]);
    }

  

}
