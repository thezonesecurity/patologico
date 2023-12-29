<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamenCitologia extends Model
{
    protected $table = 'sispatologico.examencitologia';

    protected $fillable = ['id','solicitud_id','num_examen','paciente_id','result_estado','descripcion','estado',
    'fecha_resultado','creatoruser_id','updateduser_id'];
    
    protected $dates = ['created_at','updated_at'];
    
    protected $primaryKey = 'id';
   
    public function examen_solCitologia(){
        return $this->belongsTo(\App\Models\SolicitudCitologia::class, 'solicitud_id');
    }

    public function examen_citoPacientes(){
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
    public function examenesResultadoCito(){
        return $this->hasMany(\App\Models\ResultadoCitologia::class, 'id_examen');
    }

}
