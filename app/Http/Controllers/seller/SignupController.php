<?php
namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Session;
 
class SignupController extends Controller
{
    public function index()
    {
    	$postads=DB::table('product')->get();
        $myads=DB::table('product')->where('status','=','Active')->count();
        $penddingads=DB::table('product')->where('status','=','Pendding')->count();

        $state=DB::table('state')->get();
    	return view('seller.signup')->with(['postads'=>$postads,'myads'=>$myads,'penddingads'=>$penddingads,"state"=>$state]);
    }

   public function insert(Request $request)
   {
   		$user = DB::table('user')->get();
      	$postads=DB::table('product')->get();
      	$myads=DB::table('product')->where('status','=','Active')->get();
    	$pen=DB::table('product')->where('product.status','=','Pennding')->get();
    	$decline=DB::table('product')->where('product.status','=','Decline')->get();

	    if ($request->isMethod('get')) 
	    {
	      return view('seller.signup');
	    }
	    else
     	{
        	$data = $request->all();
        	
       		$same=DB::table('user')->where('email',$data['email'])->count();
       		$phone=DB::table('user')->where('phone',$data['phone'])->count();
	        if($same>0)
	        { 
	          return redirect()->back()->with('error','Email Has been Exist...Please Enter Unique Email');
	        }
	        else if($phone>0) 
	        {
	        	return redirect()->back()->with('error','Phone Number Is Exist...');
	        }
	        else
	        {
        
	        	if($data['fname']!='' && $data['lname']!='' && $data['email']!='' && $data['phone'] !='' && $data['address'] !='' )
	        	{
		            $fnm=strlen($data['fname']);
		            $lnm=strlen($data['lname']);
		            $passlen=strlen($data['password']);
		            $eml1=strlen($data['email']) ;
		            $mno=strlen($data['phone']);
		            $ct=strlen($data['city']);
		           	
		           	if(($fnm>=3) && ($lnm>=0) &&  ($eml1> 0) && ($mno == 10) && ($passlen == 5) && ($ct>0))
			        {
			        	if(@$data['image'] !='')
	       			   {
		       			   	$name =$data['image']->getClientOriginalName();
				           // $t=time().$name;
				           
						   $img = explode(".",$name);
						   // echo $img[1];
						   // die();
				            if($img[1] =='png' ||  $img[1] == "jpg" ||  $img[1] =="jpeg" || $img[1] == "JPG")
	 			            {
	 			            	$t=time().".".$img[1] ;
       							$data['image']->move(public_path('image'),$t ); 
					            $id = DB::table('user')->insertGetId(["type"=>$data['type'],"fname"=>$data['fname'],"lname"=>$data['lname'],"email"=>$data['email'], "password"=>Hash::make($data['password']),"gender"=>$data['gender'],"address"=>$data['address'],"city"=>$data['city'],"state"=>$data['state'], "phone"=>$data['phone'],"profile_image"=>$t,"status"=>"Active"]);
					            $list = DB::table('user')->where("id",$id)->get()->toArray();
					            // $dd=$list[0]->id;
					            // echo "<pre>";
					            //  print_r($list);
					            // print_r($dd);
					            // die();
					            Session::flash('message','Registarion Successfully!.');
					            return redirect('main');
							}
							else
					        {
					            return redirect()->back()->with('error','Invalid Image Type');
					        }
				        }
				        else
	      				{
						         $id=DB::table('user')->insertGetId(["type"=>$data['type'],"fname"=>$data['fname'],"lname"=>$data['lname'],"email"=>$data['email'], "password"=>Hash::make($data['password']),"gender"=>$data['gender'],"address"=>$data['address'],"city"=>$data['city'],"state"=>$data['state'], "phone"=>$data['phone'],"status"=>"Active"]);

						          $list = DB::table('user')->where("id",$id)->get()->toArray();
					            Session::flash('message','Registarion Successfully!.');
					              return redirect('main');
	      				}
			        
		           }
			       else
			       {
			           return redirect()->back()->with('error','Enter Valid Data');
			       }
			    }
		        else
		        {
		         return redirect()->back()->with('error','Please Fill All the Fileds');
		        }
	       }
      	}
    }

}
