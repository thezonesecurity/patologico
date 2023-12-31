<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SolicitudRuralController;
use App\Http\Controllers\ResultadoRuralController;
use App\Http\Controllers\PacienteRuralController;
use App\Http\Controllers\SolicitudCitologiaController;
use App\Http\Controllers\ResultadoCitologiaController;
use App\Http\Controllers\ReportesController;
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
      // R oute::r esource('/solicitud_rural', SolicitudRuralController::class)->names('SolicitudRural');
});*/
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login_post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('inicio');
    Route::post('/registro/paciente/', [PacienteRuralController::class, 'createPaciente'])->name('modal.registrar.paciente');
    //solicitud rural
    Route::resource('/solicitud/formulario', SolicitudRuralController::class)->names('SolicitudRural');

    Route::get('/municipios/establecimientos/', [SolicitudRuralController::class, 'getEstablecimientos'])->name('lista.establecimientos.municipios');
    Route::get('/pacientes/lista/solicitudes/', [SolicitudRuralController::class, 'getPacientes'])->name('lista.registrados.pacientes');

    //Resultados rural
    Route::resource('/resultado/formulario', ResultadoRuralController::class)->names('ResultadoRural');
    Route::get('/registro/lista/resultado/', [ResultadoRuralController::class, 'index'])->name('resultado_rural.resultadoR');

    Route::get('/lista/resultados/examenes/', [ResultadoRuralController::class, 'getExamenesR'])->name('examens.lista.resultados');
    Route::get('/lista/resultados/diagnosticos/', [ResultadoRuralController::class, 'getDiagnosticosR'])->name('diagnostico.lista.resultados');

});
Route::group(['middleware' => 'auth'], function(){
    //solicitud citologia
    Route::resource('/solicitud_citologia', SolicitudCitologiaController::class)->names('SolicitudCitolgia');

     //resultado citologia
     Route::resource('/resultado_citologia', ResultadoCitologiaController::class)->names('ResultadoCitolgia');
     Route::get('/resultados/lista/examenes/', [ResultadoCitologiaController::class, 'getExamenesC'])->name('lista.resultados.examen');
     
     //reportes
     Route::get('/listar/reportes', [ReportesController::class, 'index'])->name('vista.reportes.index');
     Route::post('/generar/reportes', [ReportesController::class, 'print'])->name('generar.reportes.index');
    //medicos
     Route::get('/listar/medicos/registrados', [MedicoController::class, 'index'])->name('listar.medicos.registrar');
     Route::get('/crear/medico', [MedicoController::class, 'create'])->name('crear.medico');
     Route::post('/registrar/medico/', [MedicoController::class, 'store'])->name('registrar.medico');
     Route::post('/actualizar/medico', [MedicoController::class, 'update'])->name('editarsave.medico');
     Route::post('/medico/Inahabilitado/Habilitado', [MedicoController::class, 'deshabilitar'])->name('inhabilitar.medico');

});