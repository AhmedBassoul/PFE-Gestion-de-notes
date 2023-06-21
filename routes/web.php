<?php

use App\Http\Controllers\ExportingDataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaisirController;
use App\Http\Controllers\SecretCodeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaisieDBController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
*/
Route::get('/', function () {
    return view('auth.login');
})->name('login');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('Saisir_code_secret/{ids}', [SecretCodeController::class, 'saisir_code_secret'])->name('codeS');
    Route::post('export-data-note{module_name}',[ExportingDataController::class,'exporter_note'])->name('noteEx');
    Route::post('/save_note',[SaisieDBController::class,'save',])->name('save');

});

Route::middleware(['auth.module'])->group(function () {

    Route::match(['get', 'post'], '/saisir-note/{ids}', [SaisirController::class,'saisir_note'])->name('saisir');

});


require __DIR__.'/auth.php';
    

// https://www.youtube.com/watch?v=fFLMbMvsTwo
// https://www.youtube.com/watch?v=OMqt55n8Zlc






