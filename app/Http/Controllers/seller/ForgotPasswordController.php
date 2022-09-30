<?php

namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\User;
use DB;
use Notification;
use App\Notifications\ResetPassword;   
use Password;
use Hash;

class ForgotPasswordController extends Controller 
{
  public function index(Request $request)
    {
       return view('seller.forgot-password');
    }
  
    public function resendmail(Request $request)
    {
      $data=$request->all();
      $remember_token = rand(100000, 999999);
       
      $email=$request->input('email');
      $same=DB::table('user')->where(['email'=>$email])->where(['user.type'=>'S'])->count();
      
      $time=date('Y-m-d H:i:s',time());
  
        if($same>0)
       {
        
          $pw_reset = DB::table('user')->where(['email'=>$email])->update(['remember_token'=>$remember_token,'updated_at'=>$time]);
        
          $list = DB::table('user')->where(['email'=>$email])->where(['user.type'=>'S'])->first();


          $users = User::where("email",$data['email'])->first();
             
          Notification::send($users, new ResetPassword($remember_token));
         
           return redirect('forgotpassword')->with(["message"=>"Link Send Successfully...","list"=>$list]);    
        }
        else
        {
           return redirect('forgotpassword')->with('error','Email Must Be Registered First');
        }
      }

    public function resetpass(Request $request,$token)
    {
      $email=$request->input('email');
      $time=date('Y-m-d H:i:s',time());
      $query=DB::table('user')->where('remember_token',$token)->where(['user.type'=>'S'])->get();
      if(count($query)>0)
      {
       DB::table('user')->where('remember_token',$token)->whereRaw('ABS(TIMESTAMPDIFF(MINUTE, "'.$query[0]->updated_at.'", ?)) >= 1', [$time])->update(array("remember_token"=>"","updated_at"=>$time));
      }

    $list = DB::table('user')->where(['remember_token'=>$token])->where(['user.type'=>'S'])->first();
     if($list)
     {  
      return view('seller.resetpassword')->with(["list"=>$list]);
     }
     else
     {
      return redirect('forgotpassword')->with('error','Link Expire Please Resend Link');
     }   
    }
    public function resetpass1(Request $request)
    {
      $data=$request->all();
      $npass = $request->input('npass');
      $cpass = $request->input('cpass');
      $id = $request->input('id');
      $time=date('Y-m-d H:i:s',time());

       $list = DB::table('user')->where('id',$data['id'])->where(['user.type'=>'S'])->get();
       if($npass!='' && $cpass!='') 
       {
          if($npass == $cpass)
          {
              $b=DB::table('user')->where('id',$id)->update(["password"=>Hash::make($npass),'updated_at'=>$time]);
              return redirect('/login');
          }
          else
          {
             return redirect()->back()->with("error","New Password and Confirm Password not same");
          }
       }
       else
       {
          return redirect()->back()->with("error","Please Fill All Fields");
       }
    }
}
