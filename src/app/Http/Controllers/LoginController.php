<?php
namespace App\Http\Controllers;

class LoginController extends \App\Http\Controllers\Auth\LoginController {

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function index()
    {
        dd(1);

        return view('login.index');
    }
}
