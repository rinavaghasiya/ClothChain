<?php

namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class AccountCloseController extends Controller
{
     public function index()
    {
        $id= Session::get("user_id");
        $id1= Session::get("user_id1");
        $binbox=DB::table('message')->where('message.buyerread_status','=','0')
       ->where('message.draft_status','=','Success')
       ->where('message.receiver_id','=',$id1)->get();

        $sinbox=DB::table('message')->where('message.sellerread_status','=','0')
       ->where('message.draft_status','=','Success')
       ->where('message.receiver_id','=',$id)->get();

      


        $myads=DB::table('product')->where('status','=','Active')->where('product.s_id','=',$id)->get();
        $penddingads=DB::table('product')->where('status','=','Pendding')->where('product.s_id','=',$id)->get();
    	return view('seller.account-close')->with(['myads'=>$myads,'penddingads'=>$penddingads,"binbox"=>$binbox,"sinbox"=>$sinbox]);
    }

    public function close(Request $request)
    {
        $id= Session::get("user_id");
        
        $id1= Session::get("user_id1");
        $binbox=DB::table('message')->where('message.buyerread_status','=','0')
       ->where('message.draft_status','=','Success')
       ->where('message.receiver_id','=',$id1)->get();

        $sinbox=DB::table('message')->where('message.buyerread_status','=','0')
       ->where('message.draft_status','=','Success')
       ->where('message.receiver_id','=',$id)->get();
    	
    	 $yes = $request->input('close');
    	 if($yes=='Yes')
    	 {
            if(Session::has('user_fname'))
            {
                DB::table('user')->where('id',$id)->update(["status"=>"Closed"]);
                Session()->forget('user_fname');
                Session()->forget('user_lname');
                Session()->forget('user_image');

                return redirect('/');
            }
            else if(Session::has('user_fname1'))
            {
                DB::table('user')->where('id',$id1)->update(["status"=>"Closed"]);
                Session()->forget('user_fname1');
                Session()->forget('user_lname1');
                 Session()->forget('user_image1');
                
                return redirect('/');
            }	
    	 }
    	 else
    	 {
    	 	return view('seller.account-close')->with(["binbox"=>$binbox,"sinbox"=>$sinbox]);
    	 }
    }
}