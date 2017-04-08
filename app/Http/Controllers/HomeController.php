<?php

namespace App\Http\Controllers;
use App\Modules;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   //->only*('methods')
        //$this->middleware(['auth', 'admin']);
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processing = new Modules\ProcessingModule();
        return view('home');
    }
}
