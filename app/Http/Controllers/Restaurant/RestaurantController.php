<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('restaurant');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('restaurant.home');
    }

    public function show($id)
    {
        if( \Auth::user()->id == $id){
            $user = \App\User::find($id);

            return view('restaurant.show', compact('user'));  
        }

        return redirect('/');
    }
}
