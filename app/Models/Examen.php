<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    protected $table = 'sispatologico.examenes';

    protected $fillable = ['id','solicitud_id','num_examen','paciente_id','descripcion','estado','ci','fecha_resultado','creatoruser_id','updateduser_id'];
    
    protected $dates = ['created_at','updated_at'];
    
   // protected $primaryKey = 'id';
   
    public function examen_solicitudes(){
        return $this->belongsTo(\App\Models\Solicitud::class, 'solicitud_id');
    }

    public function examenPacientes(){
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
    public function examenesResultados(){
        return $this->hasMany(\App\Models\Resultado::class, 'examen_id');
    }
}
