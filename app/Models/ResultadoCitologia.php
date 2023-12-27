<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadoCitologia extends Model
{
    protected $table = 'sispatologico.resultadoscitologia';

    protected $fillable = ['id','id_examen','id_servicio','id_medico','fecha_resultado','diagnostico',
    'datos_relevantes','descripcion','ci_pac','conclucion','nota','estado','creatoruser_id','updateduser_id'];
    
    protected $dates = ['created_at','updated_at'];
    
    protected $primaryKey = 'id';
   
    public function resultado_medico(){
        return $this->belongsTo(\App\Models\Medicos::class, 'id_medico');
    }
    public function resultado_servicio(){
        return $this->belongsTo(\App\Models\Servicios::class, 'id_servicio');
    }
    public function resultado_examenCito(){
        return $this->belongsTo(\App\Models\ExamenCitologia::class, 'id_examen');
    }
}
