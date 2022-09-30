<?php

namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Input;
use Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function index()
    {
        if(Session::has('user_fname'))
        {
            return redirect('category');
        }
        else
        {
            return view('seller.login');  
        }   
  
    }

    public function mainpage()
    {
        return view('seller.main');
    }

    public function login(Request $request)
    {

        $email=$request->Input('email');
        $password=$request->Input('password');
      
                         
        $a=DB::table('user')->where(['email'=>$email])->where(['type'=>'S'])->where('status',"Active")->first();
        $same=DB::table('user')->where(['email'=>$email])->where(['type'=>'S'])->count();
        $st=DB::table('user')->where(['email'=>$email])->where(['type'=>'S'])->where('status','=',"Closed")->count();
       

        $db=DB::table('user')->where(['email'=>$email])->where(['type'=>'S'])->where('status','=',"Blocked")->count();

        if(($email !="") && ($password !=""))
        {
            if($st>0 )
            {
                return redirect('buyerlogin')->with('error','User Deleted ');
            }
            if($db>0)
            {
                return redirect('buyerlogin')->with('error','User Blocked');
            }
            else
            {
                if($same>0 && Hash::check($password,$a->password))
                {

                    session::put('user_fname',$a->fname);
                    session::put('user_lname',$a->lname);
                    session::put('user_id',$a->id);
                    session::put('user_image',$a->profile_image);
                    session::put('user_email',$a->email);
                    session::put('type','seller');
                    $noty=DB::table('notification')
                    ->join('product','product.id','=','notification.pro_id')
                    ->join('user','user.id','=','product.s_id')
                    ->where('notification.read_status',"0")
                    ->where('user.id','=',$a->id)
                    ->select('notification.*','user.id as user_id')
                    ->count();

                    // echo "<pre>";
                    // print_r($noty);
                    // die();
                     
                    session::put('noti',$noty);
                    return redirect('category');  
                }
                else
                {
                    return redirect('login')->with('error','Email and Password Has been Wrong....');
                }
            }
        }
        else
        {
            return redirect('login')->with('error','Email and Password Empty...');
        }   
    }
    public function sellerlogout()
    {
        Session()->forget('user_fname');
        Session()->forget('user_lname');
        Session()->forget('user_id');
        Session()->forget('user_image');
        Session()->forget('user_email');
        Session()->forget('noti');
        return redirect("/");
    }

}