<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SolicitudRuralController;
use App\Http\Controllers\ResultadoRuralController;
use App\Http\Controllers\PacienteRuralController;

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
      // R oute::r esource('/solicitud_rural', SolicitudRuralController::class)->names('SolicitudRural');
});*/
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login_post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('inicio');
    Route::post('/registro/paciente/', [PacienteRuralController::class, 'createPaciente'])->name('modal.registrar.paciente');
    //solicitud rural
 
    Route::resource('/solicitud_rural', SolicitudRuralController::class)->names('SolicitudRural');
    //Route::get('registro/lista/solicitud-rural/', [SolicitudRuralController::class, 'index'])->name('solicitud_rural.index');
    //Route::post('registro/formulario-rural/', [SolicitudRuralController::class, 'store'])->name('registrar_solicitud_rural');

   Route::get('/registro/solicitud', [SolicitudRuralController::class, 'getsolicitud'])->name('test');//temp

    Route::get('/municipios/establecimientos/', [SolicitudRuralController::class, 'getEstablecimientos'])->name('lista.establecimientos.municipios');
    Route::get('/pacientes/lista/solicitudes/', [SolicitudRuralController::class, 'getPacientes'])->name('lista.registrados.pacientes');

    //Resultados rural
    Route::resource('/resultado_rural', ResultadoRuralController::class)->names('ResultadoRural');
    Route::get('/registro/lista/resultado-rural/', [ResultadoRuralController::class, 'index'])->name('resultado_rural.resultadoR');
   // Route::get('/pacientes/lista/resultados/', [ResultadoRuralController::class, 'getPacientesR'])->name('lista.registrados.pacientes.result'); no usado
    Route::get('/lista/resultados/examenes/', [ResultadoRuralController::class, 'getExamenesR'])->name('examens.lista.resultados');
    Route::get('/lista/resultados/diagnosticos/', [ResultadoRuralController::class, 'getDiagnosticosR'])->name('diagnostico.lista.resultados');

});