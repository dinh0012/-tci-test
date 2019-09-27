<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends \App\Http\Controllers\Auth\RegisterController {

    protected $redirectTo = '/';

    public function index()
    {
        return view('register.index');
    }
}
