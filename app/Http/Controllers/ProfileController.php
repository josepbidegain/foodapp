<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

	function __construct(){
		$this->middleware('auth');
	}

    function index($id){    	

    	if( \Auth::user()->id == $id){
    		$user = \App\User::find($id);

    		return view('profile.index', compact('user'));	
    	}

    	return redirect("/home");
    	
    }
}
