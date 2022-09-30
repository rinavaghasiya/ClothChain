<?php

namespace App\Http\Controllers\buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Hash;

class AccountHomeController extends Controller
{
     public function index()
    {

          $id= Session::get("user_id1");
         $user = DB::table('user')->where(['user.type'=>'B'])->count();
           $mail = DB::table('message')
           ->where('message.buyerread_status','=','0')
        ->where('message.draft_status','=','Success') 
        ->where('message.receiver_id','=',$id)->count();
        $list = DB::table('user')->where('id',$id)->where(['user.type'=>'B'])->get();
          return view('buyer.account-home')->with(["list"=>$list,"user"=>$user,"mail"=>$mail]);
 
    }

    public function editpass(Request $request)
    {
        $id= Session::get("user_id1");
         
        $data = $request->all();

        $opass = $request->input('opass');
        $npass = $request->input('npass');
        $cpass = $request->input('cpass');
      $a1=DB::table('user')->where(["id"=>$id])->where(['user.type'=>'B'])->first();
  if(Hash::check($opass,$a1->password))
      {
         if($npass == $cpass)
            {
              
              $b= DB::table('user')->where("id",$id)->update(["password"=>Hash::make($npass)]);
               
                $list = DB::table('user')->where('id',$id)->where(['user.type'=>'B'])->get();

                Session()->forget('user_fname1');
                Session()->forget('user_lname1');
                Session()->forget('user_id1');
                return redirect('/accounthome');
             } 
             else
             {
              return redirect('accounthome')->with('error','New Password And Confirm Password are Wrong.....');
             }
      }
        else
        {
           return redirect('accounthome')->with('error',' Old Password are Wrong.....');
        }
 }

  public function edit(Request $request)
  {
     $data = $request->all();
      /*echo "<pre>";
      print_r($data);
      die();*/
        $user = DB::table('user')->where(['user.type'=>'B'])->count();
   $list = DB::table('user')->where('id',$data['id'])->where(['user.type'=>'B'])->get();
      if($data['fname']!='' && $data['lname']!=''&& $data['email']!=''  && $data['phone'] !='' && $data['address']!=''  && $data['city'] !='')
      {

           if(@$data['image']!='')
           {
              $name = $data['image']->getClientOriginalName();
               // $t=time().$name;

                $img = explode(".",$name);  
                if($img [1] =='png' ||  $img [1] == "jpg" ||  $img [1] =="jpeg")
                {
                  $t=time().".".$img[1] ;
                      $data['image']->move(public_path('image'),$t ); 

                     DB::table('user')->where('id',$data['id'])->update(["fname"=>$data['fname'],"lname"=>$data['lname'],"email"=>$data['email'],"phone"=>$data['phone'],"address"=>$data['address'],"city"=>$data['city'],"profile_image"=>$t]);

                   $photo = $request->input('oldimg');
                  Session::put('user_image1',$t);
                    if($photo!='')
                      { 
                        if(file_exists('public/image/'.$photo))
                        {
                          unlink('public/image/'.$photo);
                        }
                       return redirect('/accounthome')->with('message','Update Successfully...');
                      }
                }

                else
                {
                  return redirect()->back()->with('error','Invalid Image Type');
                }
       
            }
            else
            {
              
            DB::table('user')->where('id',$data['id'])->update(["fname"=>$data['fname'],"lname"=>$data['lname'],"email"=>$data['email'],"phone"=>$data['phone'],"address"=>$data['address'],"city"=>$data['city']]);
         }
            return redirect('/accounthome')->with('message','Update Successfully...');
      }
     else
      {
          return redirect('/accounthome')->with('error','Please Requied All the Fields');
      }
  }
}
