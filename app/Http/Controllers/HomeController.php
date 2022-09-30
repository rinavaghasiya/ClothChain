<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
     public function index()
    {
    	$sel=DB::table('user')->where('type','=','S')->get();
    	$cat=DB::table('category')->get();
    	$data=DB::table('state')->get();
    	return view('index')->with(["data"=>$data,"cat"=>$cat,"sel"=>$sel]);
    }
}
