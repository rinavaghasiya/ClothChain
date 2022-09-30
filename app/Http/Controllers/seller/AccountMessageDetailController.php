<?php

namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Mail;

class AccountMessageDetailController extends Controller
{
    public function index($id)
    {
    	 $user=Session::get('user_id');
        $decline=DB::table('product')->where('product.status','=','Decline')->where('product.s_id','=',$user)->get();
        $data1=DB::table('product')->where('product.status','=','Active')->where('product.s_id','=',$user)->get();
    	 $data2=DB::table('product')->where('status','=','Pendding')->where('product.s_id','=',$user)->get(); 
        $inbox=DB::table('message')->where('message.sellerread_status','=','0')
        ->where('message.draft_status','=','Success')
        ->where('message.receiver_id','=',$user)->get();

        $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.receiver_id','=',$user)->get();
      
            $data=DB::table('message')
            ->join('user', 'message.sender_id', '=', 'user.id')
            ->join('user as seller', 'message.receiver_id', '=', 'seller.id')
            ->where("message.id",$id)
            ->select('message.*','user.fname as bfname','user.lname as blname','user.email as bemail','user.profile_image as bprofile_image','seller.fname','seller.lname','seller.profile_image')
            ->get();

		$a1= DB::table('message')->where('id',$id)->update(["sellerread_status"=>'1']);  

    return view('seller.accountmessagedetail')->with(['data1'=>$data1,'data2'=>$data2,'decline'=>$decline,"data"=>$data,"inbox"=>$inbox,'draft'=>$draft]);
    }

    public function replymessage(Request $request)
    {
        $data = $request->all();
        $receiver_id = $request->input('receiver_id');  
        $msg = $request->input('message'); 
        $user=Session::get('user_id');
        
        $allmsg=$msg;
        $emails =$request->input('receiver_id'); 
        $fname=DB::table('user')->where('email',$emails)->where(['user.type'=>'B'])->pluck('fname')->toArray();
        $lname=DB::table('user')->where('email',$emails)->where(['user.type'=>'B'])->pluck('lname')->toArray();
        $name=$fname[0].$lname[0]; 

        ini_set('SMTP', "server.com");
        ini_set('smtp_port', "25");
        ini_set('sendmail_from', $emails);

        mail("dhameliyaruhi@gmail.com","Hello",$msg);

/*
        Mail::raw($allmsg,function ($message) use ($request, $emails)
        {
        	$data = $request->all();
           $files = $request->file('files');
        	if(@$data['files'] !='' && $data['message']  !='')
        	{
	        	$message->from(Session::get('user_email'));
	            $message->to($emails);
	            $message->subject("Hello");
              foreach($files as $file) {
      		        $message->attach($file->getRealPath(), array(
      	          'as'=>'files.' . $file->getClientOriginalName(),
      	         'mime' => $file->getMimeType())
      	             );
              }
        	}
          else if(@$data['files'] =='' && $data['message']  =='')
          {
            $message->from(Session::get('user_email'));
              $message->to($emails);
              $message->subject("Hello");
              
          }
        	else if($data['message'] =='')
        	{
        		$message->from(Session::get('user_email'));
    			$message->to($emails);
           foreach($files as $file)
            {
          		 $message->attach($file->getRealPath(), array(
  	          'as'=>'files.' . $file->getClientOriginalName(),
  	         'mime' => $file->getMimeType())
  	             );
            }
        	}

        	else
        	{
        		 $message->from(Session::get('user_email'));
	           $message->to($emails);
	           $message->subject("Hello");
        	}  
         });*/

       
        $rid=DB::table('user')->where('email',$receiver_id)->where(['user.type'=>'B'])->pluck('id')->toArray();
        $fname=DB::table('user')->where('email',$receiver_id)->where(['user.type'=>'B'])->pluck('fname')->toArray();
        $lname=DB::table('user')->where('email',$receiver_id)->where(['user.type'=>'B'])->pluck('lname')->toArray();
        
        $name=$fname[0].$lname[0];
       if($request->input('send'))
       {
           if(@$data['files']!='')
            {
              $img=array();
                if($files=$request->file('files'))
                {
                  foreach($files as $file)
                  {
                    //$name = @$data['image']->getClientOriginalName();
                        $name=$file->getClientOriginalName();
                        // $t=time().$name;
                         $t=time().".".$name ;
                        $img = explode(".",$t);

                       $file->move(public_path('image'),$t ); 
                        $image[]=$t;
                  }
               }
                  $data=DB::table('message')->insert(["sender_id"=>$user,"receiver_id"=>$rid[0],"message"=>$data['message'],"files"=>implode(",",$image),"sellerread_status"=>'0',"buyerread_status"=>'0','draft_status'=>'Success']);
              }
              else
              {
                $data=DB::table('message')->insert(["sender_id"=>$user,"receiver_id"=>$rid[0],"message"=>$data['message'],"sellerread_status"=>'0',"buyerread_status"=>'0','draft_status'=>'Success']);
              }       
        }
        else if($request->input('draft'))
        {
          if(@$data['files']!='')
          {
            $img=array();
            if($files=$request->file('files'))
            {
              foreach($files as $file)
              {
                    $name=$file->getClientOriginalName();
                    // $t=time().$name;
                     $t=time().".".$name ;
                    $img = explode(".",$t);

                   $file->move(public_path('image'),$t ); 
                    $image[]=$t;
              }
            }
              $data=DB::table('message')->insert(["sender_id"=>$user,"receiver_id"=>$rid[0],"message"=>$data['message'],"files"=>implode(",",$image),"sellerread_status"=>'0',"buyerread_status"=>'0','draft_status'=>'Draft']);
          }
          else
          {
            $data=DB::table('message')->insert(["sender_id"=>$user,"receiver_id"=>$rid[0],"message"=>$data['message'],"sellerread_status"=>'0',"buyerread_status"=>'0','draft_status'=>'Draft']);
          }
        }

      return redirect()->back();           
    }

  public function sellermessagedetail($id)
  {
       $user=Session::get('user_id');
        $decline=DB::table('product')->where('product.status','=','Decline')->where('product.s_id','=',$user)->get();
        $data1=DB::table('product')->where('product.status','=','Active')->where('product.s_id','=',$user)->get();
       $data2=DB::table('product')->where('status','=','Pendding')->where('product.s_id','=',$user)->get(); 
        $inbox=DB::table('message')->where('message.sellerread_status','=','0')
        ->where('message.draft_status','=','Success')
        ->where('message.receiver_id','=',$user)->get();

        $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.receiver_id','=',$user)->get();

          $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as b1', 'message.receiver_id', '=', 'b1.id')
           ->where("message.id",$id)
          ->select('b1.type as type','user.type as btype',"b1.fname as buyer1_nm","user.fname as buyer2_nm","b1.email as buyer1_email","user.email as buyer2_email","b1.lname as buyer1_lnm","user.lname as buyer2_lnm","user.profile_image as buyer1_img","b1.profile_image as buyer2_img","message.*")
          ->get();
        
         $a1= DB::table('message')->where('id',$id)->update(["sellerread_status"=>'1']);  

      return view('seller.sellermessagedetail')->with(['data1'=>$data1,'data2'=>$data2,'decline'=>$decline,"data"=>$data,"inbox"=>$inbox,'draft'=>$draft]);
    }

   public function draftseller($id)
    {
      $data=DB::table('message')->where("id",$id)->get();   
      $user=Session::get('user_id');
      $decline=DB::table('product')->where('product.status','=','Decline')->where('product.s_id','=',$user)->get();
      $data1=DB::table('product')->where('product.status','=','Active')->where('product.s_id','=',$user)->get();
      $data2=DB::table('product')->where('status','=','Pendding')->where('product.s_id','=',$user)->get(); 
      $data = DB::table("message")
      ->leftJoin('user', 'message.sender_id', '=', 'user.id')
      ->leftJoin('user as b1', 'message.receiver_id', '=', 'b1.id')
      ->where("message.id",$id)
      ->select("b1.fname as buyer1_nm","user.fname as buyer2_nm","b1.email as buyer1_email","user.email as buyer2_email","b1.lname as buyer1_lnm","user.lname as buyer2_lnm","user.profile_image as buyer1_img","b1.profile_image as buyer2_img","message.*")
      ->get();

      $inbox=DB::table('message')->where('message.sellerread_status','=','0')
      ->where('message.draft_status','=','Success')
      ->where('message.receiver_id','=',$user)->get();

      $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.receiver_id','=',$user)->get();
      
      $a1= DB::table('message')->where('id',$id)->update(["sellerread_status"=>'1']);  

      return view('seller.draftseller')->with(["data"=>$data,"inbox"=>$inbox,'draft'=>$draft,'data1'=>$data1,'data2'=>$data2,'decline'=>$decline]);
    }

public function draftmessageseller(Request $request)
{
       $data = $request->all();
       $receiver_id = $request->input('receiver_id');  
       $mid = $request->input('mid'); 
       $msg = $request->input('message'); 
       $user=Session::get('user_id');
         
       $allmsg=$msg;
       $emails =$request->input('receiver_id');  
       Mail::raw($allmsg,function ($message) use ($request, $emails)
       {
          $data = $request->all();
           $files = $request->file('files');
          if(@$data['files'] !='' && $data['message']  !='')
          {
            $message->from(Session::get('user_email'));
              $message->to($emails);
              $message->subject("Hello");
              foreach($files as $file) {
                  $message->attach($file->getRealPath(), array(
                  'as'=>'files.' . $file->getClientOriginalName(),
                 'mime' => $file->getMimeType())
                     );
              }
          }
          else if($data['message'] =='')
          {
            $message->from(Session::get('user_email'));
            $message->to($emails);
            foreach($files as $file)
            {
               $message->attach($file->getRealPath(), array(
               'as'=>'files.' . $file->getClientOriginalName(),
               'mime' => $file->getMimeType())
                 );
            }
          }
          else
          {
              $message->from(Session::get('user_email'));
              $message->to($emails);
              $message->subject("Hello");
          }  
        });
        $rid=DB::table('user')->where('email',$receiver_id)->where(['user.type'=>'B'])->pluck('id')->toArray();
        $fname=DB::table('user')->where('email',$receiver_id)->where(['user.type'=>'B'])->pluck('fname')->toArray();
        $lname=DB::table('user')->where('email',$receiver_id)->where(['user.type'=>'B'])->pluck('lname')->toArray();
        $name=$fname[0].$lname[0];

       if($request->input('send'))
       {
         if(@$data['files']!='')
          {
  
             $img=array();
              if($files=$request->file('files'))
              {
                foreach($files as $file)
                {
                  $name=$file->getClientOriginalName();
                  // $t=time().$name;
                  $t=time().".".$name ;
                  $img = explode(".",$t);
                  $file->move(public_path('image'),$t ); 
                  $image[]=$t;
                }
             }
                $data=DB::table('message')->where('id',$data['mid'])->update(["sender_id"=>$user,"receiver_id"=>$rid[0],"message"=>$data['message'],"files"=>implode(",",$image),"sellerread_status"=>'0',"buyerread_status"=>'0','draft_status'=>'Success']);
            }
            else
            {
              $data=DB::table('message')->where('id',$data['mid'])->update(["sender_id"=>$user,"receiver_id"=>$rid[0],"message"=>$data['message'],"sellerread_status"=>'0',"buyerread_status"=>'0','draft_status'=>'Success']);
            }
       }
 
      return redirect()->back();           
    }
   
}
