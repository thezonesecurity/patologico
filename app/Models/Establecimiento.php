<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    use HasFactory;

    protected $table = 'sispatologico.establecimientos';

    protected $fillable = ['id','nombre_establecimiento','estado','municipio_id',
    'descripcion','creatoruser_id','updateduser_id','created_at','updated_at'];
    
    protected $primaryKey = 'id';

    /*public function municipio_esta(){
        return $this->belongsTo(Municipio::class, 'municipio_id','id');
    }*/

    public function establecimiento_solicitudes(){
        return $this->hasMany(\App\Models\Solicitud::class, 'establecimiento_id');
    }

}
