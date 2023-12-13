<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');
});*/
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login_post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('inicio');
    //medicos
    Route::get('lista/medicos', [MedicoController::class, 'index'])->name('medicos.lista');
    //Route::get('Medicos/pdf', [MedicoController::class, 'pdf'])->name('patologia.medicos.pdf');      
    Route::resource('/Medicos', MedicoController::class)->names('patologia.medicos');
    Route::get('Medicos/habilitar/{id}', [MedicoController::class, 'habilitar'])->name('patologia.medicos.habilitar');      
    
});