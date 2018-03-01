<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
    	return view('test.home');
    }

    public function vue(){
    	return view('test.vue');
    }

    public function vueComponent(){
    	return view('test.vue-component');
    }
    public function adminLte(){
    	return view('test.adminlte');
    }
}
