<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudCitologia extends Model
{
    protected $table = 'sispatologico.solicitudcitologia';

    protected $fillable = ['id','nro_solicitud','fecha_solicitud','municipio_id','establecimiento_id',
    'estado', 'descripcion','creatoruser_id','updateduser_id'];

    protected $dates = ['created_at','updated_at'];
    
    protected $primaryKey = 'id';

    public function solicitudCito_examenes(){
        return $this->hasMany(\App\Models\ExamenCitologia::class, 'solicitud_id');
    }

    public function solicitudCito_municipios(){
        return $this->belongsTo(\App\Models\Municipio::class, 'municipio_id');
    }
    public function solicitudCito_establecimientos(){
        return $this->belongsTo(\App\Models\Establecimiento::class, 'establecimiento_id');
    }
}
