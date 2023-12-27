<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    protected $table = 'sispatologico.servicios';

    protected $fillable = ['id','nombre_servicio','descripcion','estado','creatoruser_id','updateduser_id'];
    
    protected $dates = ['created_at','updated_at'];
    
    protected $primaryKey = 'id';

    public function servicio_resultado(){
        return $this->hasOne(\App\Models\ResultadoCitologia::class, 'id_servicio');
    }
}
