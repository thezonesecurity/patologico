<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'sispatologico.solicitudes';

    protected $fillable = ['id','num_solicitud','fecha_solicitud','municipio_id','establecimiento_id',
    'estado', 'descripcion','tipo_solicitud','creatoruser_id','updateduser_id'];

    protected $dates = ['created_at','updated_at'];
    
    protected $primaryKey = 'id';

    public function solicitud_examenes(){
        return $this->hasMany(\App\Models\Examen::class, 'solicitud_id');
    }
    public function solicitud_municipios(){
        return $this->belongsTo(\App\Models\Municipio::class, 'municipio_id');
    }
    public function solicitud_establecimientos(){
        return $this->belongsTo(\App\Models\Establecimiento::class, 'establecimiento_id');
    }
}
