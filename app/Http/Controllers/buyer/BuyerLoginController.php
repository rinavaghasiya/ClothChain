<?php

namespace App\Http\Controllers\buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;

class BuyerLoginController extends Controller
{
     public function index()
    {
        if(Session::has('user_fname1'))
        {
            return redirect('category');
        }
        else
        {
            return view('buyer.buyerlogin');
        }   
    	      
    }
    public function login(Request $request)
    {
         $email=$request->input('email');
         $password=$request->input('password');

         $a=DB::table('user')->where(['email'=>$email])->where(['user.type'=>'B'])->where('status',"Active")->first();
         $same=DB::table('user')->where(['email'=>$email])->where(['user.type'=>'B'])->count();
            $st=DB::table('user')->where(['email'=>$email])->where(['user.type'=>'B'])->where('status',"Closed")->count();
              $db=DB::table('user')->where(['email'=>$email])->where(['user.type'=>'B'])->where('status',"Blocked")->count();
            if($email !="" && $password !="")
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
                    if($same>0 &&Hash::check($password,$a->password))
                    {
                    session::put('user_fname1',$a->fname);
                    session::put('user_lname1',$a->lname);
                    session::put('user_id1',$a->id);
                    session::put('user_email1',$a->email);
                    session::put('user_image1',$a->profile_image);
                    
                    return redirect('category'); 
                    }
                    else
                    {
                     return redirect('buyerlogin')->with('error','Email and Password Has been Wrong....');
                    } 
                }	 
            }
            else
            {
            return redirect('buyerlogin')->with('error','Email and Password Empty...');
            }  
    }

    public function logout()
	{
        Session()->forget('user_fname1');
        Session()->forget('user_lname1');
        Session()->forget('user_id1');
         Session()->forget('user_email1');
        Session()->forget('user_image1');
        return redirect("/");
	}

   
}
