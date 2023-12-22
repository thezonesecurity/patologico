<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'sispatologico.municipios';

    protected $fillable = ['id','nombre_municipio','estado','descripcion',
    'creatoruser_id','updateduser_id','created_at','updated_at'];
    
    protected $primaryKey = 'id';

    public function municipio_solicitudes(){
        return $this->hasMany(\App\Models\Solicitud::class, 'municipio_id');
    }
    
}
