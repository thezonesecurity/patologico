<?php

namespace App\Models\Login;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $remember_token = 'false';
    protected $table = 'public.personas';
    protected $fillable = ['id', 'nombres', 'apellidos','ci'];
    protected $guarded = ['id'];

    public function user(){
        return $this->hasOne(\App\Models\Login\users::class, 'persona_id');
    }
}
