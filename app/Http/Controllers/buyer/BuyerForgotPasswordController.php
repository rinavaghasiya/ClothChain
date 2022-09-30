<?php

namespace App\Http\Controllers\buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use Notification;
use App\Notifications\BuyerResetPassword;   
use Password;
use Hash;

class BuyerForgotPasswordController extends Controller
{
      public function index(Request $request)
    {
          return view('buyer.buyerforgot-password');
    }
  
     public function buyerresendmail(Request $request)
    {
      $data=$request->all();
      $remember_token = rand(100000, 999999);
       
      $email=$request->input('email');

      $same=DB::table('user')->where(['email'=>$email])->where(['user.type'=>'B'])->count();

      ini_set('SMTP', "server.com");
ini_set('smtp_port', "25");
ini_set('sendmail_from', "email@domain.com");
      /*$time=date('Y-m-d H:i:s',time());
      if($same>0)
       {
          $pw_reset = DB::table('user')->where(['email'=>$email])->update(['remember_token'=>$remember_token,'updated_at'=>$time]);
            
          $list = DB::table('user')->where(['email'=>$email])->where(['user.type'=>'B'])->first();

          $users = User::where("email",$data['email'])->first();
         Notification::send($users, new BuyerResetPassword($remember_token));
       
         return redirect('buyerforgotpassword')->with(["message"=>"Link Send Successfully...","list"=>$list]);   
        }
        else
        {
          return redirect('buyerforgotpassword')->with('error','Email Must Be Registered First');
        }*/
    }

    public function buyerresetpass(Request $request,$token)
    {
      $email=$request->input('email');
      $time=date('Y-m-d H:i:s',time());
      $query=DB::table('user')->where('remember_token',$token)->where(['user.type'=>'B'])->get();
      if(count($query)>0)
        {
         DB::table('user')->where('remember_token',$token)->whereRaw('ABS(TIMESTAMPDIFF(MINUTE, "'.$query[0]->updated_at.'", ?)) >= 1', [$time])->update(array("remember_token"=>"","updated_at"=>$time));
        }
      $list = DB::table('user')->where(['remember_token'=>$token])->where(['user.type'=>'B'])->first();
     if($list)
     {  
        return view('buyer.buyerresetpassword')->with(["list"=>$list]);
     }
     else
     {
      return redirect('buyerforgotpassword')->with('error','Link Expire Please Resend Link');
     }  
    }

    public function buyerresetpass1(Request $request)
    {
      $data=$request->all();
      $npass = $request->input('npass');
      $cpass = $request->input('cpass');
      $id = $request->input('id');
      $time=date('Y-m-d H:i:s',time());

       $list = DB::table('user')->where('id',$data['id'])->where(['user.type'=>'B'])->get();
       if($npass!='' && $cpass!='') 
       {
          if($npass == $cpass)
          {
              $b=DB::table('user')->where('id',$id)->update(["password"=>Hash::make($npass),'updated_at'=>$time]);
              return redirect('/buyerlogin');
          }
            
          else
          {
             return redirect()->back()->with("error","New Password and Confirm Password Are Not Same");
            
          }
       }
       else
       {
          return redirect()->back()->with("error","Please Fill All Fields");
       }
      
    }
}
