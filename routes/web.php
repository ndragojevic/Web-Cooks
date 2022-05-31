<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gost;
use App\Http\Controllers\Korisnik;
use App\Models\OmiljeniModel;
use Illuminate\Http\Request;


use App\Models\KomentarModel;
use App\Models\KorisnikModel;
use App\Models\ReceptModel;

use App\Models\Namirnice_receptModel;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [Gost::class, "index"])->name('index');
Route::get('/registracija', [Gost::class, "registracija"])->name('registracija');
Route::post('/regsubmit', [Gost::class, "regsubmit"])->name('regsubmit');
Route::get('/login', [Gost::class, "prijava"])->name('login');
Route::post('/loginsubmit', [Gost::class, "login_submit"])->name('login_submit');
Route::get('/pocetna', [Korisnik::class, "pocetna"])->name('pocetna');
Route::get('/dodajrecept', [Korisnik::class, "dodajrecept"])->name('dodajrecept');
Route::post('/novirecept', [Korisnik::class, "novirecept"])->name('novirecept');
Route::post('/novirecept2', [Korisnik::class, "novirecept2"])->name('novirecept2');
Route::post('/novanamirnica', [Korisnik::class, "novanamirnica"])->name('novanamirnica');
Route::get('/pregled', [Korisnik::class, "pregled"])->name('pregled');
//Route::get('/dodajomiljeni', [Korisnik::class, "dodajomiljeni"])->name('dodajomiljeni');

Route::get('dodajomiljeni/{recept}',function($recept)
{
    $kor=KorisnikModel::where('KorId',session()->get('korid'))->first();
   /* if($kor->rola=='admin') {
        $r=ReceptModel::find($recept);
        $kom=KomentarModel::where('ReceptId',$recept)->get();
        $namirnice=Namirnice_receptModel::where('ReceptId',$recept)->get();
         return view('recept',['recept'=>$r,'komentari'=>$kom,'namirnice'=>$namirnice]);
    } 
*/
   
    $omiljeni =OmiljeniModel::create([
        'ReceptId' => $recept,
       
        'KorId' => session()->get('korid')
    ]);
    $omiljeni->save();

    $r=ReceptModel::find($recept);
    $kom=KomentarModel::where('ReceptId',$recept)->get();
    $namirnice=Namirnice_receptModel::where('ReceptId',$recept)->get();
     return view('recept',['recept'=>$r,'komentari'=>$kom,'namirnice'=>$namirnice]);


})->name('dodajomiljeni');

Route::get('obrisimirnicu/{nim}',function($nim){
    Namirnice_receptModel::where('NamId',$nim)->delete();
    $namirnice= Namirnice_receptModel::where('ReceptId',session()->get('rid'))->get( );
   
    return view('dodajnamirnice',['namirnice' => $namirnice]);

})->name('obrisimirnicu');

Route::get('receptpregled/{recept}',function($recept){

    $r=ReceptModel::find($recept);
    $kom=KomentarModel::where('ReceptId',$recept)->get();
    $namirnice=Namirnice_receptModel::where('ReceptId',$recept)->get();
   $korisnik=KorisnikModel::where('KorId',session()->get('korid'))->first();
  
   if($korisnik->rola=='user'){
     return view('recept',['recept'=>$r,'komentari'=>$kom,'namirnice'=>$namirnice]);
   }
   else  return view('receptA',['recept'=>$r,'komentari'=>$kom,'namirnice'=>$namirnice]); 

})->name('receptpregled');

Route::get('receptpregledGost/{recept}',function($recept){

    $r=ReceptModel::find($recept);
    $kom=KomentarModel::where('ReceptId',$recept)->get();
    $namirnice=Namirnice_receptModel::where('ReceptId',$recept)->get();
    return view('receptGost',['recept'=>$r,'komentari'=>$kom,'namirnice'=>$namirnice]);

})->name('receptpregledGost');

Route::get('/omrecepti', [Korisnik::class, "omrecepti"])->name('omrecepti');

Route::get('/mojirecepti', [Korisnik::class, "mojirecepti"])->name('mojirecepti');

Route::get('komentarir/{rid}',function($rid){

    $kom=KomentarModel::where('ReceptId',$rid)->get();
    $r=ReceptModel::where('ReceptId',$rid)->first();
    
    $korisnik=KorisnikModel::where('KorId',session()->get('korid'))->first();
  
    if($korisnik->rola=='user'){
         return view('komentar',['kom'=>$kom,'recept'=>$r]);}
    else{
        return view('komentarA',['kom'=>$kom,'recept'=>$r]);
    }

})->name('komentarir');

Route::get('brisanjeK/{kid}/comm/{rid}',function($kid,$rid){
    
    KomentarModel::where('KomId', $kid)->delete();
    $kom=KomentarModel::where('ReceptId',$rid)->get();
    $r=ReceptModel::where('ReceptId',$rid)->first();
    return view('komentarA',['kom'=>$kom,'recept'=>$r]);

}
)->name('brisanjeK');

Route::get('komentarirGost/{rid}',function($rid){

    $kom=KomentarModel::where('ReceptId',$rid)->get();
    $r=ReceptModel::where('ReceptId',$rid)->first();
    $korisnik=KorisnikModel::where('KorId',session()->get('korid'))->first();
  
    return view('komentarGost',['kom'=>$kom,'recept'=>$r]);
    
})->name('komentarirGost');

Route::get('/pregledrecepataK', [Korisnik::class, "pregledrecepataK"])->name('pregledrecepataK');

Route::post('/novikomentar/{recept}',function(Request $request,$recept) {

    $kom = KomentarModel::create([
        'ReceptId'=> $recept,
         'KorId' => $request->session()->get('korid'),
         'Tekst' =>$request->kom
     ]);
    $kom->save();
    $r=ReceptModel::find($recept);
    $kom=KomentarModel::where('ReceptId',$recept)->get();
    $namirnice=Namirnice_receptModel::where('ReceptId',$recept)->get();
    return view('recept',['recept'=>$r,'komentari'=>$kom,'namirnice'=>$namirnice]);
   
})->name('novikomentar');

Route::post('odjava',function(Request $request){

    $request->session()->flush();
    $r=ReceptModel::all();
    return view('index',['recepti' => $r]);

})->name('odjava');

Route::post('brisanjeR/{recept}',function(Request $request,$recept) {

    Namirnice_receptModel::where('ReceptId', $recept)->delete();
    KomentarModel::where('ReceptId', $recept)->delete();
    OmiljeniModel::where('ReceptId', $recept)->delete();
    ReceptModel::where('ReceptId', $recept)->delete();
    $r=ReceptModel::all();
    return view("pocetna",['recepti' => $r]);
   
})->name('brisanjeR');