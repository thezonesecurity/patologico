<?php

namespace App\Models\Login;

use Illuminate\Foundation\Auth\User as Authenticatable;

class users extends Authenticatable
{
    protected $remember_token = 'false';
    protected $table = 'public.users';
    protected $fillable = ['id','email', 'password', 'persona_id', 'estado'];
    protected $guarded = ['id'];

    public function persona(){
        return $this->belongsTo(\App\Models\Login\Persona::class, 'persona_id');
    }
}
