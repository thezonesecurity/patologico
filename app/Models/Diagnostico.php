<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;

    protected $table = 'sispatologico.diagnosticos';

    protected $fillable = ['id','codigo_diagnostico','descripcion_diagnostico','estado',
    'descripcion','creatoruser_id','updateduser_id','created_at','updated_at'];
    
    protected $primaryKey = 'id';    
    
}
