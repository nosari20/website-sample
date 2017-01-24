<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Request;

class SuperAdminController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Creating global data
        /*
        $data = new \stdClass();
        view()->share((array)$data);  
        */   
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('auth.contents.home');
    }
}
