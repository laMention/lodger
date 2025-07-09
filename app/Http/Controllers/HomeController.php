<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->type_user == 2) {
            // return view('backend.dashboard');
            return redirect()->route('agence.index',[config('app.locale')]);
        }
        if (auth()->user()->type_user == 1) {
           // return view('frontend.index');
            return redirect()->route('locataire.index',[config('app.locale')]);
           
        }
    }
}
