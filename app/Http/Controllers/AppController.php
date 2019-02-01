<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','staff']);
    }

    public function index(){
        return view('index');
    }
    public function transactions(){
        return view('transactions');
    }
    public function staff(){
        return view('auth.login');
    }
}
