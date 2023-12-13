<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/'; // '/home'

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
      return view('Login.index');
    }
}
