<?php

namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;  

class SellerAccountHomeController extends Controller
{
    public function index()
    {
    	 $id= Session::get("user_id");

        $list = DB::table('user')->where('id',$id)->where(['user.type'=>'S'])->get();
        $user = DB::table('user')->where(['user.type'=>'S'])->get();
        $postads=DB::table('product')->where('product.s_id','=',$id)->get();
         
        $myads=DB::table('product')->where('status','=','Active')->where('product.s_id','=',$id)->get();
        $pen=DB::table('product')->where('product.status','=','Pendding')->where('product.s_id','=',$id)->get();
        $decline=DB::table('product')->where('product.status','=','Decline')->where('product.s_id','=',$id)->get();

        $inbox=DB::table('message')->where('message.sellerread_status','=','0')
       ->where('message.draft_status','=','Success')
       ->where('message.receiver_id','=',$id)->get();

        return view('seller.selleraccount-home')->with(["list"=>$list,"user"=>$user,'postads'=>$postads,'myads'=>$myads,'pen'=>$pen,'decline'=>$decline,"inbox"=>$inbox]);	
    }

     public function sellereditpass(Request $request)
    {
        $id= Session::get("user_id");
        $data = $request->all();
        $opass = $request->input('opass');
        $npass = $request->input('npass');
        $cpass = $request->input('cpass');

        $a1=DB::table('user')->where(["id"=>$id])->where(['user.type'=>'S'])->first();

      if(Hash::check($opass,$a1->password))
      {
         if($npass == $cpass )
          {
            $b=DB::table('user')->where('id',$data['id'])->where(['user.type'=>'S'])->update(["password"=>Hash::make($npass)]);
            $list = DB::table('user')->where('id',$data['id'])->get();
            Session()->forget('user_fname');
            Session()->forget('user_lname');
            Session()->forget('user_id');
            Session()->forget('user_image');
            return redirect('/selleraccounthome');
          }
          else
          {
              return redirect('selleraccounthome')->with('error','New Password And Confirm Password are Wrong.....');
          }
      }
      else  
      {
        return redirect('selleraccounthome')->with('error','Old Password are Wrong.....'); 
      }
  }

  public function selleredit(Request $request)
  {
    $data = $request->all();
    // $user = DB::table('user')->where(['user.type'=>'S'])->get();
    // $list = DB::table('user')->where('id',$data['id'])->where(['user.type'=>'S'])->get();
    // $myads=DB::table('product')->where('status','=','Active')->get();
    // $postads=DB::table('product')->get();
    // $pen=DB::table('product')->where('product.status','=','Pendding')->get();
    // $decline=DB::table('product')->where('product.status','=','Decline')->get();
    if($data['fname']!='' && $data['lname']!=''&& $data['email']!=''  && $data['phone'] !='' && $data['address']!='')
      {
         if(@$data['image']!='')
        {   
          $name = $data['image']->getClientOriginalName();
          //$t=time().$name;
           
          $img = explode(".",$name);
          if($img [1] =='png' ||  $img [1] == "jpg" ||  $img [1] =="jpeg")
          {
            $t=time().".".$img[1] ;
               $data['image']->move(public_path('image'),$t ); 
               $ff=DB::table('user')->where('id',$data['id'])->update(["fname"=>$data['fname'],"lname"=>$data['lname'],"email"=>$data['email'],"address"=>$data['address'],"phone"=>$data['phone'],"profile_image"=>$t]);
                 Session::put('user_image',$t);
                  $photo = $request->input('oldimg');
                  if($photo!='')
                  {
                    if(file_exists('public/image/'.$photo))
                    {
                      unlink('public/image/'.$photo);
                    }
                 return redirect('/selleraccounthome')->with('message','Update Successfully...');
                }
          }
          else
          {
            return redirect()->back()->with('error','Invalid image type');
          }  
      }
      else
      {
         DB::table('user')->where('id',$data['id'])->update(["fname"=>$data['fname'],"lname"=>$data['lname'],"email"=>$data['email'],"address"=>$data['address'],"phone"=>$data['phone']]);
          return redirect('/selleraccounthome');

      }
          return redirect('/selleraccounthome')->with('message','Update Successfully...');
    }
     else
      {
          return redirect()->back()->with('error','Please Requied All the Fields');
      }
    }
}
