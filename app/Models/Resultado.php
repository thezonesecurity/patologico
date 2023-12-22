<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    protected $table = 'sispatologico.resultados';

    protected $fillable = ['id','examen_id','diagnostico_id','fecha_resultado', 'estado','descripcion','creatoruser_id','updateduser_id'];

    protected $dates = ['created_at','updated_at'];
    
    protected $primaryKey = 'id';

    public function resultadoExamenes(){
        return $this->belongsTo(Examen::class, 'examen_id');
    }
}
