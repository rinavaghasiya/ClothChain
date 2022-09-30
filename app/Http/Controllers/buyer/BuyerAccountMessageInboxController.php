<?php

namespace App\Http\Controllers\buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;   
use Mail;
use App\SendMail;

class BuyerAccountMessageInboxController extends Controller
{
     public function index(Request $request)
    {
     
    	$id1= Session::get("user_fname1");
    	$id= Session::get("user_fname");
      $total=DB::table('message')->get();
      $user=Session::get('user_id1');

       $inbox=DB::table('message')->where('message.buyerread_status','=','0')
       ->where('message.draft_status','=','Success')
       ->where('message.receiver_id','=',$user)->get();

        $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.sender_id','=',$user)->get();
      $sort=$request->input('fer');
      
      if($sort==1)
      {
        $data=DB::table('message')
            
            ->join('user', 'message.receiver_id', '=', 'user.id')
            ->join('user as seller', 'message.sender_id', '=', 'seller.id')
            ->where(['seller.type'=>'S'])
            ->where(['user.type'=>'B'])
            ->where('message.buyerread_status','=','1')
            ->where('message.receiver_id','=',$user)
            ->where('message.draft_status','=','Success')
            ->select('message.*','user.fname as bfname','user.lname as blname','user.profile_image as bprofile_image','seller.fname','seller.lname','seller.profile_image')
            ->orderBy('created_at','DESC')
           ->Paginate(5);
      }
      else if($sort==2)
      {
        $data=DB::table('message')
            ->join('user', 'message.receiver_id', '=', 'user.id')
            ->join('user as seller', 'message.sender_id', '=', 'seller.id')
            ->where(['seller.type'=>'S'])
            ->where(['user.type'=>'B'])
            ->where('message.buyerread_status','=','0')
            ->where('message.receiver_id','=',$user)
            ->where('message.draft_status','=','Success')
            ->select('message.*','user.fname as bfname','user.lname as blname','user.profile_image as bprofile_image','seller.fname','seller.lname','seller.profile_image')
            ->orderBy('created_at','DESC')
           ->Paginate(5);
      }
      else
      {
        $data=DB::table('message')
           ->join('user', 'message.receiver_id', '=', 'user.id')
            ->join('user as seller', 'message.sender_id', '=', 'seller.id')
            ->where(['seller.type'=>'S'])
            ->where(['user.type'=>'B'])
            ->where('message.receiver_id','=',$user)
            ->where('message.draft_status','=','Success')
            ->select('message.*','user.fname as bfname','user.lname as blname','user.profile_image as bprofile_image','seller.fname','seller.lname','seller.profile_image')
            ->orderBy('created_at','DESC')
           ->Paginate(5);
      }


    	 return view('buyer.buyeraccountmessageinbox')->with(['data'=>$data,'sort'=>$sort,'inbox'=>$inbox,'total'=>$total,"draft"=>$draft]);
      
    }
   public function buyerdelete($id)
    {
       $record=DB::table('message')->where('id',$id)->first();

       $delete=DB::table('delete_message')->insert(['msg_id'=>$record->id,'sender_id'=>$record->sender_id,'receiver_id'=>$record->receiver_id,'message'=>$record->message,'files'=>$record->files,'sellerread_status'=>$record->sellerread_status,'buyerread_status'=>$record->buyerread_status,'sellerfavourite_status'=>$record->sellerfavourite_status,'buyerfavourite_status'=>$record->buyerfavourite_status,'sellerimportant_status'=>$record->sellerimportant_status,'buyerimportant_status'=>$record->buyerimportant_status,'draft_status'=>$record->draft_status]);

       $del=DB::table('message')->where('id',$id)->delete();
       
      return redirect()->back();
    }

   public function index1($imageid)
    {
       $user=Session::get('user_id1');
       $inbox=DB::table('message')->where('message.buyerread_status','=','0')
       ->where('message.draft_status','=','Success')
       ->where('message.receiver_id','=',$user)->get();

        $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.sender_id','=',$user)->get();
      
       $data=DB::table('product')
            ->join('product_image', 'product.id', '=', 'product_image.p_id')
            ->join('user','user.id','=','product.s_id')
           ->join('state','user.state','=','state.StateID')
           ->where(['user.type'=>'S'])
            ->where("product_image.p_id",$imageid)
            
            ->select('product.*','user.fname','user.lname','user.email','state.StateName','user.phone','user.profile_image','product_image.image')
            ->get();
            return view('buyer.buyeraccount-message-compose')->with(["data"=>$data,"inbox"=>$inbox,"draft"=>$draft]);
    }
     public function insertmessage(Request $request)
    {
         $data = $request->all();
         $receiver_id = $request->input('receiver_id');  
        $product_id=$request->input('id');  

         //$list = DB::table('product')->where('id',$data['id'])->first();
         $msg = $request->input('message'); 
         $user=Session::get('user_id1');
        
         $rid=DB::table('user')->where('email',$receiver_id)->where(['user.type'=>'S'])->pluck('id')->toArray();
       
         $send=$request->input('send');
        if($send)
        {
           $data=DB::table('message')->insert(["product_id"=>$product_id,"sender_id"=>$user,"receiver_id"=>$rid[0],"message"=>$data['message'],"buyerread_status"=>'0',"sellerread_status"=>'0','draft_status'=>"Success"]);
        }
        else if($request->input('draft'))
        {
          $data=DB::table('message')->insert(["product_id"=>$product_id,"sender_id"=>$user,"receiver_id"=>$rid[0],"message"=>$data['message'],"buyerread_status"=>'0',"sellerread_status"=>'0','draft_status'=>"Draft"]);
        }
    
        $emails =$request->input('receiver_id'); 
        $allmsg="Product_id: ".$product_id."\n".$msg; 
        
        ini_set('SMTP', "server.com");
        ini_set('smtp_port', "25");
        ini_set('sendmail_from', "email@domain.com");
        
        // Mail::raw($allmsg,function ($message) use ($request, $emails)
        // {
        //     $message->from(Session::get('user_email1'));
        //     $message->to($emails);
        //     $message->subject("New Email From Your site");
        // });

        //SendMail::sendmail($emails,'Product Message',$allmsg);

      return redirect()->back()->with('message','Message Sent');           
    }


     public function buyerfavouritemail($id)
    {
      $data=DB::table('message')->where('id',$id)->first();
      $user=Session::get('user_id1');
    
        if($data->buyerfavourite_status =="")
        {
          if($user == $data->sender_id)
            {
              DB::table('message')->where('id',$data->id)->update(["buyerfavourite_status"=>"Favourite"]);
              return redirect()->back();
            }
            else if($user == $data->receiver_id)
            {
              DB::table('message')->where('id',$data->id)->update(["buyerfavourite_status"=>"Favourite"]);
              return redirect()->back();
            }
        }
        else if($data->buyerfavourite_status =='Favourite')
        {
          if($user == $data->sender_id)
            {
              DB::table('message')->where('id',$data->id)->update(["buyerfavourite_status"=>""]);
              return redirect()->back();
            }
            else if($user == $data->receiver_id)
            {
              DB::table('message')->where('id',$data->id)->update(["buyerfavourite_status"=>""]);
              return redirect()->back();
            }
        }
      
        return redirect()->back();
    }

     public function buyerfavourite(Request $request)
    {
      $id1= Session::get("user_fname1");
      $id= Session::get("user_fname");
       $user=Session::get('user_id1');
       
        $total=DB::table('message')->get();

      $inbox=DB::table('message')->where('message.buyerread_status','=','0')
      ->where('message.draft_status','=','Success')
      ->where('message.receiver_id','=',$user)->get();

       $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.sender_id','=',$user)->get();

      $sort=$request->input('fer');
      if($sort==1)
      {
         $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as s1', 'message.receiver_id', '=', 's1.id')
           ->where("message.buyerread_status",'=','1')
             //->where("message.buyerfavourite_status",'=','Favourite')
           // ->where(['user.type'=>'S'])
          ->where("message.receiver_id",$user)
          ->orWhere("message.sender_id",$user)
          
          ->select('s1.type as type','user.type as stype',"s1.fname as seller1_nm","user.fname as seller2_nm","s1.email as seller1_email","user.email as seller2_email","s1.lname as seller1_lnm","user.lname as seller2_lnm","user.profile_image as seller1_img","s1.profile_image as seller2_img","message.*")
           ->orderBy('message.created_at','DESC')
            ->get();
      }
      else if($sort==2)
      {
        $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as s1', 'message.receiver_id', '=', 's1.id')
          ->where("message.buyerread_status",'=','0')
         // ->where("message.buyerfavourite_status",'=','Favourite')
         //  ->where(['user.type'=>'S'])
          ->where("message.receiver_id",$user)
          ->orWhere("message.sender_id",$user)
          
          ->select('s1.type as type','user.type as stype',"s1.fname as seller1_nm","user.fname as seller2_nm","s1.email as seller1_email","user.email as seller2_email","s1.lname as seller1_lnm","user.lname as seller2_lnm","user.profile_image as seller1_img","s1.profile_image as seller2_img","message.*")
           ->orderBy('message.created_at','DESC')
          ->get();
      }
      else
      {
    
         $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as s1', 'message.receiver_id', '=', 's1.id')
          //->where("message.buyerfavourite_status",'=','Favourite')
          //  ->where(['user.type'=>'S'])
          ->where("message.receiver_id",$user)
          ->orWhere("message.sender_id",$user)
          
          ->select('s1.type as type','user.type as stype',"s1.fname as seller1_nm","user.fname as seller2_nm","s1.email as seller1_email","user.email as seller2_email","s1.lname as seller1_lnm","user.lname as seller2_lnm","user.profile_image as seller1_img","s1.profile_image as seller2_img","message.*")
           ->orderBy('message.created_at','DESC')
            ->get();

        }
    
    return view('buyer.buyerfavourite')->with(['data'=>$data,'sort'=>$sort,'inbox'=>$inbox,'total'=>$total,"draft"=>$draft]);
    }

     public function buyerunfavouritemail($id)
    {
     $data=DB::table('message')->where('id',$id)->first();
       if($data->buyerfavourite_status =="Favourite")
        {
         DB::table('message')->where('id',$data->id)->update(["buyerfavourite_status"=>""]);
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function buyersendmail(Request $request)
    {
      $user=Session::get('user_id1');
      $total=DB::table('message')->get();

      $inbox=DB::table('message')->where('message.buyerread_status','=','0')
      ->where('message.draft_status','=','Success')
      ->where('message.receiver_id','=',$user)->get();
 
    $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.sender_id','=',$user)->get();

      $sort=$request->input('fer');
      if($sort==1)
      {

         $data=DB::table('message')
            ->leftJoin('user', 'message.sender_id', '=', 'user.id')
            ->leftJoin('user as seller', 'message.receiver_id', '=', 'seller.id')
            ->where('message.buyerread_status','=','1')
            ->where('message.sender_id','=',$user)
            ->where('message.draft_status','=','Success')
            ->select('message.*','user.fname as bfname','user.lname as blname','user.profile_image as bprofile_image','seller.fname','seller.lname','seller.profile_image')
            ->orderBy('created_at','DESC')
           ->Paginate(5);
          
      }
      else if($sort==2)
      {
         $data=DB::table('message')
            ->leftJoin('user', 'message.sender_id', '=', 'user.id')
            ->leftJoin('user as seller', 'message.receiver_id', '=', 'seller.id')
            ->where('message.buyerread_status','=','0')
            ->where('message.sender_id','=',$user)
            ->where('message.draft_status','=','Success')
            ->select('message.*','user.fname as bfname','user.lname as blname','user.profile_image as bprofile_image','seller.fname','seller.lname','seller.profile_image')
            ->orderBy('created_at','DESC')
           ->Paginate(5);
         
      }
      else
      {
         $data=DB::table('message')
            ->leftJoin('user', 'message.sender_id', '=', 'user.id')
            ->leftJoin('user as seller', 'message.receiver_id', '=', 'seller.id')
            //->where(['user.type'=>'B'])
            ->where('message.sender_id','=',$user)
            ->where('message.draft_status','=','Success')
            ->select('message.*','user.fname as bfname','user.lname as blname','user.profile_image as bprofile_image','seller.fname','seller.lname','seller.profile_image')
            ->orderBy('created_at','DESC')
           ->Paginate(5);
           
      }

       return view('buyer.buyersendmail')->with(['data'=>$data,'sort'=>$sort,'inbox'=>$inbox,'total'=>$total,"draft"=>$draft]);
    }

      public function buyerdraftmessage(Request $request)
    {
      $user=Session::get('user_id1');
      $total=DB::table('message')->get();

      $inbox=DB::table('message')->where('message.buyerread_status','=','0')
      ->where('message.draft_status','=','Success')
      ->where('message.receiver_id','=',$user)->get();
       $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.sender_id','=',$user)->get();

      $sort=$request->input('fer');
      if($sort==1)
      {
        $data=DB::table('message')
            ->leftJoin('user', 'message.sender_id', '=', 'user.id')
            ->leftJoin('user as seller', 'message.receiver_id', '=', 'seller.id')
            ->where(['seller.type'=>'S'])
            ->where(['user.type'=>'B'])
            ->where('message.buyerread_status','=','1')
            ->where('message.sender_id','=',$user)
            ->where('message.draft_status','=','Draft')
            ->select('message.*','user.fname as bfname','user.lname as blname','user.profile_image as bprofile_image','seller.fname','seller.lname','seller.profile_image')
            ->orderBy('created_at','DESC')
           ->Paginate(5);
      }
      else if($sort==2)
      {
        $data=DB::table('message')
            ->leftJoin('user', 'message.sender_id', '=', 'user.id')
            ->leftJoin('user as seller', 'message.receiver_id', '=', 'seller.id')
            ->where(['seller.type'=>'S'])
            ->where(['user.type'=>'B'])
            ->where('message.buyerread_status','=','0')
            ->where('message.sender_id','=',$user)
            ->where('message.draft_status','=','Draft')
            ->select('message.*','user.fname as bfname','user.lname as blname','user.profile_image as bprofile_image','seller.fname','seller.lname','seller.profile_image')
            ->orderBy('created_at','DESC')
           ->Paginate(5);
      }
      else
      {
        $data=DB::table('message')
            ->leftJoin('user', 'message.sender_id', '=', 'user.id')
            ->leftJoin('user as seller', 'message.receiver_id', '=', 'seller.id')
            ->where('message.sender_id','=',$user)
            ->where('message.draft_status','=','Draft')
            ->select('message.*','user.fname as bfname','user.lname as blname','user.profile_image as bprofile_image','seller.fname','seller.lname','seller.profile_image')
            ->orderBy('created_at','DESC')
           ->Paginate(5);
            
      }

      return view('buyer.buyerdraftmessage')->with(['data'=>$data,'sort'=>$sort,'inbox'=>$inbox,'total'=>$total,"draft"=>$draft]);
    }

 public function buyerimportantemail($id)
    {
        $data=DB::table('message')->where('id',$id)->first();
        $user=Session::get('user_id1');
    
        if($data->buyerimportant_status =="")
        {
          if($user == $data->sender_id)
            {
              DB::table('message')->where('id',$data->id)->update(["buyerimportant_status"=>"Important"]);
              return redirect()->back();
            }
            else if($user == $data->receiver_id)
            {
              DB::table('message')->where('id',$data->id)->update(["buyerimportant_status"=>"Important"]);
              return redirect()->back();
            }
        }
        else if($data->buyerimportant_status =='Important')
        {
          if($user == $data->sender_id)
            {
              DB::table('message')->where('id',$data->id)->update(["buyerimportant_status"=>""]);
              return redirect()->back();
            }
            else if($user == $data->receiver_id)
            {
              DB::table('message')->where('id',$data->id)->update(["buyerimportant_status"=>""]);
              return redirect()->back();
        
            }
            return redirect()->back();
        }
  }

     public function buyerimportant(Request $request)
    {
      $id1= Session::get("user_fname1");
      $id= Session::get("user_fname");
       $user=Session::get('user_id1');
       
        $total=DB::table('message')->get();

      $inbox=DB::table('message')->where('message.buyerread_status','=','0')
      ->where('message.draft_status','=','Success')
      ->where('message.receiver_id','=',$user)->get();

       $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.sender_id','=',$user)->get();

      $sort=$request->input('fer');
      if($sort==1)
      {
         $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as s1', 'message.receiver_id', '=', 's1.id')
          ->where("message.buyerread_status",'=','1')
            // ->where("message.buyerfavourite_status",'=','Favourite')
          ->where("message.receiver_id",$user)
          ->orWhere("message.sender_id",$user)
          ->select('s1.type as type','user.type as stype',"s1.fname as seller1_nm","user.fname as seller2_nm","s1.email as seller1_email","user.email as seller2_email","s1.lname as seller1_lnm","user.lname as seller2_lnm","user.profile_image as seller1_img","s1.profile_image as seller2_img","message.*")
          ->orderBy('message.created_at','DESC')
         ->get();
      }
      else if($sort==2)
      {
        $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as s1', 'message.receiver_id', '=', 's1.id')
          ->where("message.buyerread_status",'=','0')
          //->where("message.buyerfavourite_status",'=','Favourite')
          ->where("message.receiver_id",$user)
          ->orWhere("message.sender_id",$user)
          ->select('s1.type as type','user.type as stype',"s1.fname as seller1_nm","user.fname as seller2_nm","s1.email as seller1_email","user.email as seller2_email","s1.lname as seller1_lnm","user.lname as seller2_lnm","user.profile_image as seller1_img","s1.profile_image as seller2_img","message.*")
          ->orderBy('message.created_at','DESC')
          ->get();
      }
      else
      {
    
         $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as s1', 'message.receiver_id', '=', 's1.id')
           //->where("message.buyerfavourite_status",'=','Favourite')
          ->where("message.receiver_id",$user)
          ->orWhere("message.sender_id",$user)
          ->select('s1.type as type','user.type as stype',"s1.fname as seller1_nm","user.fname as seller2_nm","s1.email as seller1_email","user.email as seller2_email","s1.lname as seller1_lnm","user.lname as seller2_lnm","user.profile_image as seller1_img","s1.profile_image as seller2_img","message.*")
          ->orderBy('message.created_at','DESC')
         ->get();

        }
     return view('buyer.buyerimportant')->with(['data'=>$data,'sort'=>$sort,'inbox'=>$inbox,'total'=>$total,"draft"=>$draft]);
    }

     public function buyernotimportantemail($id)
    {
        $data=DB::table('message')->where('id',$id)->first();
        if($data->buyerimportant_status =="Important")
        {
           DB::table('message')->where('id',$data->id)->update(["buyerimportant_status"=>""]);
            return redirect()->back();
        }
        return redirect()->back();
    }
}