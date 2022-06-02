<?php

/*Autori: Anastasija Vasić 0430/2019,
          Nikola Jovanović 0440/2019
          Natalija Dragojević 0325/2019 */

use App\Http\Controllers\GostController;
use App\Http\Controllers\BaseController;

use App\Http\Controllers\KorisnikNamRecController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Gost;
use App\Http\Controllers\Korisnik;
use App\Models\OmiljeniModel;
use Illuminate\Http\Request;

use App\Models\KomentarModel;
use App\Models\KorisnikModel;
use App\Models\ReceptModel;

use App\Models\NamirniceReceptModel;

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

Route::post('/recepti', [KorisnikNamRecController::class, "filtrirajRecepte"])->name("filtrirajRecepte");

Route::post('/receptiGost', [KorisnikNamRecController::class, "filtrirajRecepteGost"])->name("filtrirajRecepteGost");

Route::get('/recepti', [KorisnikNamRecController::class, "recepti"])->name('recepti');

Route::post('/recepti/{id}', [KorisnikNamRecController::class, "generisiReceptePoNamirnicamaKorinsika"])->name("generisiReceptePoNamirnicamaKorinsika");

Route::patch('/recepti/id={ReceptId}/ocena={ocena}', [KorisnikNamRecController::class, "oceniRecept"])->name("oceniRecept");

Route::get('/namirnice/{id}', [KorisnikNamRecController::class, "prikaziKorisnikoveNamirnice"])->name("prikaziKorisnikoveNamirnice");

Route::post('/namirnice/id={id}/naziv={naziv}/Kolicina={kolicina}', [KorisnikNamRecController::class, "dodajNamirnicu"])->name("dodajNamirnicu");

Route::delete('/namirnice/ukloni/{id}', [KorisnikNamRecController::class, "ukloniNamirnicu"])->name("ukloniNamirnicu");


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
Route::get('/dodajomiljeni/{recept}', [Korisnik::class, "dodajomiljeni"])->name('dodajomiljeni');
Route::get('obrisimirnicu/{nim}',[Korisnik::class, "obrisimirnicu"] )->name('obrisimirnicu');

Route::get('receptpregled/{recept}', [Korisnik::class, "receptpregled"])->name('receptpregled');

Route::get('receptpregledGost/{recept}', [Gost::class, "receptpregledGost"])->name('receptpregledGost');

Route::get('/omrecepti', [Korisnik::class, "omrecepti"])->name('omrecepti');

Route::get('/mojirecepti', [Korisnik::class, "mojirecepti"])->name('mojirecepti');

Route::get('komentarir/{rid}',[Korisnik::class, "komentarir"])->name('komentarir');

Route::get('brisanjeK/{kid}/comm/{rid}',[Korisnik::class, "brisanjeK"])->name('brisanjeK');

Route::get('komentarirGost/{rid}',[Gost::class, "komentarirGost"] )->name('komentarirGost');

Route::get('/pregledrecepataK', [Korisnik::class, "pregledrecepataK"])->name('pregledrecepataK');

Route::post('/novikomentar/{recept}', [Korisnik::class, "novikomentarr"])->name('novikomentar');

Route::post('odjava', [Korisnik::class, "odjava"])->name('odjava');

Route::post('brisanjeR/{recept}',[Korisnik::class, "brisanjeR"])->name('brisanjeR');
