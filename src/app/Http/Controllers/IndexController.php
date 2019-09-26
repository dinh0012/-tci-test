<?php
namespace App\Http\Controllers;


use App\User;

class IndexController extends Controller
{
    public function index()
    {
        $dsn = 'mysql:dbname=my-test;host=mysql';
        $user = 'user01';
        $password = 'user01';
        try {
            $dbh = new \PDO($dsn, $user, $password);
            echo 'Connection success';
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return view('welcome');
    }
}
