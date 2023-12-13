<?php

namespace App\Models\Login;

use Illuminate\Foundation\Auth\User as Authenticatable;

class users extends Authenticatable
{
    protected $remember_token = 'false';
    protected $table = 'public.users';
    protected $fillable = ['email', 'password', 'persona_id'];
    protected $guarded = ['id'];
}
