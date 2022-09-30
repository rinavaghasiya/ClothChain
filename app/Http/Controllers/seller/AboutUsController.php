<?php

namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use DB;

class AboutUsController extends Controller
{
    public function index()
    {
    	return view('seller.aboutus');
    }

     public function contact()
    {
    	return view('seller.contactus');
    }

    public function insertcontact(Request $request)
    {
	     if ($request->isMethod('get')) 
	     {
	        return view('seller.contactus');
	     }
	     else
	     {
	        $data = $request->all();
	        $msg = $request->input('message'); 
	        $name = $request->input('name'); 
			$emails =$request->input('email');
			$all="Name: ".$name."\n"."Email: ".$emails."\n"."Message: ".$msg;
        
	        Mail::raw($all,function ($message) use ($request, $emails,$name)
	        {
	            $message->from($emails);
	            $message->to('dhameliyaruhi@gmail.com');
	            $message->subject("");
	        });
	        if($data['name']!='' && $data['email']!='' && $data['message']!='')
	     	{
	          
	                $id = DB::table('contactus')->insert(["name"=> $data['name'],"email"=>$data['email'],"phone"=>$data['phone'],"message"=>$data['message']]);
	                 return redirect()->back();
	        }
	     	else
	     	{
	        return redirect()->back();
	     	}
	    }
  
    }

     public function terms_condition()
    {
    	return view('seller.terms_condition');
    }
}
