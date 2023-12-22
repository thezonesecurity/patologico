<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;    
    
    protected $table = 'sispatologico.pacientes';

    protected $fillable = ['id','ci','nombre','apellido','fecha_nacimiento','edad','direccion',
    'hc','num_asegurado','email','creatoruser_id','updateduser_id','created_at','updated_at',
    'sexo','num_celular','descripcion','estado'];
    
   // protected $primaryKey = 'id';    

    public function pacienteExamenes(){
        return $this->hasOne(Examen::class, 'paciente_id');
    }
}
 