<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicos extends Model
{
    protected $table = 'sispatologico.medicos';

    protected $fillable = ['id','ci','nombre','apellido','fecha_nacimiento','edad','direccion','especialidad','matricula_profeciona',
    'sexo','email','num_celular','descripcion','estado','creatoruser_id','updateduser_id'];
    
    protected $dates = ['created_at','updated_at'];
    
    protected $primaryKey = 'id';

    public function medico_resultado(){
        return $this->hasOne(\App\Models\ResultadoCitologia::class, 'id_medico');
    }
}
