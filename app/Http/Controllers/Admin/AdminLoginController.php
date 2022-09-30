<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Session;

class AdminLoginController extends Controller
{
     public function index()
    {
        if(Session::has('admin_name'))
        {
    	   return redirect('adminprofile');
        }
        else
        {
            return view('Admin.adminlogin');
        }
    }

     public function dashboard()
    {
        return view('Admin.admindashboard');
    }


    public function adminlogin(Request $request)
    {
        $email=$request->Input('email');
        $password=$request->Input('password');
        $same=DB::table('admin')->where(['email'=>$email])->count();
        $a=DB::table('admin')->where(['email'=>$email])->first();
        
        if(($email!="") && ($password!=""))
        {
            if($same>0 && Hash::check($password,$a->password))
            {
                session::put('admin_id',$a->id);
                session::put('admin_name',$a->name);
                session::put('admin_email',$a->email);
                session::put('admin_profile_image',$a->profile_image);
                 $d1=DB::table('product')
                  ->where('product.status','=','Pendding')->count();
              //     echo "<pre>";
              // print_r($d1);
              // die();
                session::put('penstatus',$d1);
                return view('Admin.profile')->with('a',$a);
            }
            else
            {
             return redirect('adminlogin')->with('error','Email and Password has been wrong....');
            }         
        }
        else
        {
            return redirect('adminlogin')->with('error','Email and Password Empty...');
        }    
    }
    public function adminlogout()
    {
        Session()->forget('admin_id');
        Session()->forget('admin_name');
        Session()->forget('admin_email');
        Session()->forget('admin_profile_image');
        Session()->forget('penstatus');
        return redirect('adminlogin');
    }
}