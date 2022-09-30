<?php

namespace App\Http\Controllers\buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use DB;
use Mail;
use Session;

class BuyerAccountMessageDetailController extends Controller
{
     public function index($id)
    {
    	 
          $user1=Session::get('user_id1');
         $data=DB::table('message')
            ->join('user', 'message.receiver_id', '=', 'user.id')
            ->join('user as seller', 'message.sender_id', '=', 'seller.id')
            ->where("message.id",$id)
            ->orWhere('message.id','=','message.reply_id')
            ->select('message.*','user.type as btype','user.fname','user.lname','user.email','user.profile_image','seller.fname as sfname','seller.lname as slname','seller.profile_image as sprofile_image','seller.email as semail','seller.type as stype')
             ->get();

             // echo "<pre>";
             // print_r($data);
             // die();

  $inbox=DB::table('message')->where('message.buyerread_status','=','0')
  ->where('message.draft_status','=','Success')
  ->where('message.receiver_id','=',$user1)->get();

   $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.sender_id','=',$user1)->get();

   $a1= DB::table('message')->where('id',$id)->update(["buyerread_status"=>'1']); 
          return view('buyer.buyeraccountmessagedetail')->with(['data'=>$data,"inbox"=>$inbox,'draft'=>$draft]);
    }

     public function replymessagebuyer(Request $request)
    {
        $data = $request->all();
        $sender_id = $request->input('receiver_id'); 
        $msg = $request->input('message'); 
        $user=Session::get('user_id1');

       $allmsg=$msg;
           $emails =$request->input('receiver_id');  

           ini_set('SMTP', "server.com");
           ini_set('smtp_port', "25");
           ini_set('sendmail_from',  $emails);
      /* Mail::raw($allmsg,function ($message) use ($request, $emails)
        {
           $files = $request->file('files');
        	$data = $request->all();
        	if(@$data['files'] !='' && $data['message']  !='')
        	{
	        	$message->from(Session::get('user_email1'));
	            $message->to($emails);
	            $message->subject("Hello");
	           foreach($files as $file)
              { 
      			     $message->attach($file->getRealPath(), array(
      		          'as'=>'files.' . $file->getClientOriginalName(),
      		         'mime' => $file->getMimeType())
      	             );
              }
        	}
          else if(@$data['files'] =='' && $data['message']  =='')
          {
            $message->from(Session::get('user_email1'));
              $message->to($emails);
              $message->subject("Hello");
              
          }
        	else if($data['message'] =='')
        	{
        		$message->from(Session::get('user_email1'));
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
        		  $message->from(Session::get('user_email1'));
	            $message->to($emails);
	            $message->subject("Hello");
        	}
 
        });
*/
      $rid=DB::table('user')->where('email',$sender_id)->where(['user.type'=>'S'])->pluck('id')->toArray();
      // echo "<pre>";
      // print_r($rid);
      // die();


         $fname=DB::table('user')->where('email',$sender_id)->where(['user.type'=>'S'])->pluck('fname')->toArray();
           $lname=DB::table('user')->where('email',$sender_id)->where(['user.type'=>'S'])->pluck('lname')->toArray();
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
            $data=DB::table('message')->insert(["receiver_id"=>$rid[0],"sender_id"=>$user,"message"=>$data['message'],"files"=>implode(",",$image),"sellerread_status"=>'0',"buyerread_status"=>'0','draft_status'=>'Success']);
              
          }
          else
          {
             $data=DB::table('message')->insert(["receiver_id"=>$rid[0],"sender_id"=>$user,"message"=>$data['message'],"sellerread_status"=>'0',"buyerread_status"=>'0','draft_status'=>'Success']);
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
            $data=DB::table('message')->insert(["receiver_id"=>$rid[0],"sender_id"=>$user,"message"=>$data['message'],"files"=>implode(",",$image),"sellerread_status"=>'0',"buyerread_status"=>'0','draft_status'=>'Draft']);   
          }
          else
          {
             $data=DB::table('message')->insert(["receiver_id"=>$rid[0],"sender_id"=>$user,"message"=>$data['message'],"sellerread_status"=>'0',"buyerread_status"=>'0','draft_status'=>'Draft']);
          }
  }
   return redirect()->back()->with('','');           
    }

  public function onlydetail($id)
    {
         $data=DB::table('message')->where("id",$id)->get();   
          $user1=Session::get('user_id1');
         
      $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as s1', 'message.receiver_id', '=', 's1.id')
          //->where(['user.type'=>'S'])
          ->where("message.id",$id)
          ->select('s1.type as type','user.type as stype',"s1.fname as seller1_nm","user.fname as seller2_nm","s1.email as seller1_email","user.email as seller2_email","s1.lname as seller1_lnm","user.lname as seller2_lnm","user.profile_image as seller1_img","s1.profile_image as seller2_img","message.*")
          ->get();
          
      $inbox=DB::table('message')->where('message.buyerread_status','=','0')
      ->where('message.draft_status','=','Success')
      ->where('message.receiver_id','=',$user1)->get();

      $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.sender_id','=',$user1)->get();

        $a1= DB::table('message')->where('id',$id)->update(["buyerread_status"=>'1']); 
            return view('buyer.buyermessagedetail')->with(['data'=>$data,"inbox"=>$inbox,'draft'=>$draft]);
    }

    public function draftbuyer($id)
    {
         $data=DB::table('message')->where("id",$id)->get();   
          $user1=Session::get('user_id1');
        
      $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as s1', 'message.receiver_id', '=', 's1.id')
          // ->where(['user.type'=>'S'])
          ->where("message.id",$id)
          ->select("s1.fname as seller1_nm","user.fname as seller2_nm","s1.email as seller1_email","user.email as seller2_email","s1.lname as seller1_lnm","user.lname as seller2_lnm","user.profile_image as seller1_img","s1.profile_image as seller2_img","message.*")
          ->get();
         //  echo "<pre>";
         // print_r($data);
         // die();
  $inbox=DB::table('message')->where('message.buyerread_status','=','0')
  ->where('message.draft_status','=','Success')
  ->where('message.receiver_id','=',$user1)->get();

   $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.sender_id','=',$user1)->get();
    $a1= DB::table('message')->where('id',$id)->update(["buyerread_status"=>'1']); 
          
      return view('buyer.draftbuyer')->with(['data'=>$data,"inbox"=>$inbox,'draft'=>$draft]);
    }


    public function draftmessagebuyer(Request $request)
    {
         $data = $request->all();
          $sender_id = $request->input('receiver_id'); 
           $mid = $request->input('mid'); 
          
           $msg = $request->input('message');
         $user=Session::get('user_id1');
       $allmsg=$msg;
           $emails =$request->input('receiver_id');  
       Mail::raw($allmsg,function ($message) use ($request, $emails)
        {
           $files = $request->file('files');
          $data = $request->all();
          if(@$data['files'] !='' && $data['message']  !='')
          {
            $message->from(Session::get('user_email1'));
              $message->to($emails);
              $message->subject("Hello");
             foreach($files as $file)
              { 
                 $message->attach($file->getRealPath(), array(
                    'as'=>'files.' . $file->getClientOriginalName(),
                   'mime' => $file->getMimeType())
                     );
              }
          }
          else if($data['message'] =='')
          {
            $message->from(Session::get('user_email1'));
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
             $message->from(Session::get('user_email1'));
              $message->to($emails);
              $message->subject("Hello");
          }
 
        });


        $rid=DB::table('user')->where('email',$sender_id)->where(['user.type'=>'S'])->pluck('id')->toArray();
         $fname=DB::table('user')->where('email',$sender_id)->where(['user.type'=>'S'])->pluck('fname')->toArray();
           $lname=DB::table('user')->where('email',$sender_id)->where(['user.type'=>'S'])->pluck('lname')->toArray();
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

            $data=DB::table('message')->where('id',$data['mid'])->update(["receiver_id"=>$rid[0],"sender_id"=>$user,"message"=>$data['message'],"files"=>implode(",",$image),"sellerread_status"=>'0',"buyerread_status"=>'0','draft_status'=>'Success']);

             $photo = $request->input('oldimg');
             if($photo!='')
              { 
                if(file_exists('public/image/'.$photo))
                {
                  unlink('public/image/'.$photo);
                }
                return redirect()->back();
              }  
          }
          else
          {
             $data=DB::table('message')->where('id',$data['mid'])->update(["receiver_id"=>$rid[0],"sender_id"=>$user,"message"=>$data['message'],"sellerread_status"=>'0',"buyerread_status"=>'0','draft_status'=>'Success']);
          }
    }
      return redirect()->back();           
    }

}
