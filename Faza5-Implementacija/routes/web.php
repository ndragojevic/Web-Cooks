<?php

use App\Http\Controllers\GostController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\KorisnikController;
use Illuminate\Support\Facades\Route;

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

Route::post('/recepti/naziv={naziv}/kategorije={kategorije}', [KorisnikController::class, "filtrirajRecepte"])->name("filtrirajRecepte");

Route::get('/recepti', [KorisnikController::class, "recepti"])->name('recepti');

Route::post('/recepti/{id}', [KorisnikController::class, "generisiReceptePoNamirnicamaKorinsika"])->name("generisiReceptePoNamirnicamaKorinsika");


Route::patch('/recepti/id={ReceptId}/ocena={ocena}', [KorisnikController::class, "oceniRecept"])->name("oceniRecept");

Route::get('/namirnice/{id}', [KorisnikController::class, "prikaziKorisnikoveNamirnice"])->name("prikaziKorisnikoveNamirnice");

Route::post('/namirnice/id={id}/naziv={naziv}/Kolicina={kolicina}', [KorisnikController::class, "dodajNamirnicu"])->name("dodajNamirnicu");

Route::delete('/namirnice/ukloni/{id}', [KorisnikController::class, "ukloniNamirnicu"])->name("ukloniNamirnicu");
