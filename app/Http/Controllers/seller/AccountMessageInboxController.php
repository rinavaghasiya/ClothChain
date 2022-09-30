<?php

namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Mail;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class AccountMessageInboxController extends Controller
{
    public function index(Request $request)
    {
        $user=Session::get('user_id');
        $useremail=Session::get('user_email');
        $decline=DB::table('product')->where('product.status','=','Decline')->where('product.s_id','=',$user)->get();
        $data1=DB::table('product')->where('product.status','=','Active')->where('product.s_id','=',$user)->get();
    	  $data2=DB::table('product')->where('status','=','Pendding')->where('product.s_id','=',$user)->get(); 

        $inbox=DB::table('message')->where('message.sellerread_status','=','0')
        ->where('message.draft_status','=','Success')
        ->where('message.receiver_id','=',$user)->get();

       $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.sender_id','=',$user)->get();
        $total=DB::table('message')->get();

        $sort=$request->input('fer');
        if($sort==1)
        {
    	
          $data=DB::table('message')
            ->join('user', 'message.sender_id', '=', 'user.id')
            ->join('user as seller', 'message.receiver_id', '=', 'seller.id')
            ->where('message.sellerread_status','=','1')
            ->where('message.receiver_id','=',$user)
            ->where('message.draft_status','=','Success')
            ->select('message.*','user.fname as bfname','user.lname as blname','user.email as bemail','user.profile_image as bprofile_image','seller.fname','seller.email','seller.lname','seller.profile_image')
            ->orderBy('created_at','DESC')
            ->Paginate(5);
        }
        else if($sort==2)
        {
             $data=DB::table('message')
            ->join('user', 'message.sender_id', '=', 'user.id')
            ->join('user as seller', 'message.receiver_id', '=', 'seller.id')
            ->where('message.sellerread_status','=','0')
            ->where('message.receiver_id','=',$user)
            ->where('message.draft_status','=','Success')
            ->select('message.*','user.fname as bfname','user.lname as blname','user.email as bemail','user.profile_image as bprofile_image','seller.fname','seller.email','seller.lname','seller.profile_image')
            ->orderBy('created_at','DESC')
            ->Paginate(5);
        }
        else
        {
            $data=DB::table('message')
            ->join('user', 'message.sender_id', '=', 'user.id')
            ->join('user as seller', 'message.receiver_id', '=', 'seller.id')
            ->where('message.receiver_id','=',$user)
           
            ->where('message.draft_status','=','Success')
            ->select('message.*','user.fname as bfname','user.lname as blname','user.email as bemail','user.profile_image as bprofile_image','seller.fname','seller.email','seller.lname','seller.profile_image')
            ->orderBy('created_at','DESC')
            ->Paginate(5);
            // ->get(); 
            // echo "<pre>";
            // print_r($data);
            // die();
        }
    	return view('seller.accountmessageinbox')->with(['data1'=>$data1,'data2'=>$data2,'decline'=>$decline,'data'=>$data,'sort'=>$sort,'inbox'=>$inbox,'total'=>$total,'draft'=>$draft]);
    }

 public function draftmessage(Request $request)
    {
        $user=Session::get('user_id');
        $useremail=Session::get('user_email');
        $decline=DB::table('product')->where('product.status','=','Decline')->where('product.s_id','=',$user)->get();
        $data1=DB::table('product')->where('product.status','=','Active')->where('product.s_id','=',$user)->get();
        $data2=DB::table('product')->where('status','=','Pendding')->where('product.s_id','=',$user)->get(); 

        $inbox=DB::table('message')->where('message.sellerread_status','=','0')
          ->where('message.draft_status','=','Success')
          ->where('message.receiver_id','=',$user)->get();

        $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.sender_id','=',$user)->get();

            $total=DB::table('message')->get();

        $sort=$request->input('fer');
        if($sort==1)
        { 
          $data=DB::table('message')
          ->join('user', 'message.receiver_id', '=', 'user.id')
          ->join('user as seller', 'message.sender_id', '=', 'seller.id')
          ->where('message.sellerread_status','=','1')
          ->where('message.draft_status','=','Draft')
          ->where('message.sender_id','=',$user)
          ->select('seller.type as type','user.type as btype','message.*','user.fname as bfname','user.lname as blname','user.profile_image as bprofile_image','user.email as bemail','seller.fname','seller.email','seller.lname','seller.profile_image')
          ->orderBy('created_at','DESC')
          ->Paginate(5);
        }
        else if($sort==2)
        {
             $data=DB::table('message')
          ->join('user', 'message.receiver_id', '=', 'user.id')
          ->join('user as seller', 'message.sender_id', '=', 'seller.id')
          ->where('message.sellerread_status','=','0')
          ->where('message.draft_status','=','Draft')
          ->where('message.sender_id','=',$user)
          ->select('seller.type as type','user.type as btype','message.*','user.fname as bfname','user.lname as blname','user.profile_image as bprofile_image','user.email as bemail','seller.fname','seller.email','seller.lname','seller.profile_image')
          ->orderBy('created_at','DESC')
          ->Paginate(5);
        }
        else
        {
           $data=DB::table('message')
          ->join('user', 'message.receiver_id', '=', 'user.id')
          ->join('user as seller', 'message.sender_id', '=', 'seller.id')
          ->where('message.draft_status','=','Draft')
          ->where('message.sender_id','=',$user)
          ->select('seller.type as type','user.type as btype','message.*','user.fname as bfname','user.lname as blname','user.profile_image as bprofile_image','user.email as bemail','seller.fname','seller.email','seller.lname','seller.profile_image')
          ->orderBy('created_at','DESC')
          ->Paginate(5);

        }
            return view('seller.draftmessage')->with(['data1'=>$data1,'data2'=>$data2,'decline'=>$decline,'data'=>$data,'sort'=>$sort,'inbox'=>$inbox,'total'=>$total,'draft'=>$draft]);
    }
    
   
    public function sellerdelete($id,Request $request)
    {
       $record=DB::table('message')->where('id',$id)->first();

       $delete=DB::table('delete_message')->insert(['msg_id'=>$record->id,'sender_id'=>$record->sender_id,'receiver_id'=>$record->receiver_id,'message'=>$record->message,'files'=>$record->files,'sellerread_status'=>$record->sellerread_status,'buyerread_status'=>$record->buyerread_status,'sellerfavourite_status'=>$record->sellerfavourite_status,'buyerfavourite_status'=>$record->buyerfavourite_status,'sellerimportant_status'=>$record->sellerimportant_status,'buyerimportant_status'=>$record->buyerimportant_status,'draft_status'=>$record->draft_status]);

        $del=DB::table('message')->where('id',$id)->delete();

      return redirect()->back();
    }

    public function favouritemail($id)
    {
      $data=DB::table('message')->where('id',$id)->first();
      $user=Session::get('user_id');
      if($data->sellerfavourite_status =="")
      {
        if($user == $data->sender_id)
        {
            DB::table('message')->where('id',$data->id)->update(["sellerfavourite_status"=>"Favourite"]);
            return redirect()->back();
        }
        else if($user == $data->receiver_id)
        {
            DB::table('message')->where('id',$data->id)->update(["sellerfavourite_status"=>"Favourite"]);
            return redirect()->back();
        }
           
      }
      else if($data->sellerfavourite_status =='Favourite')
      {
          if($user == $data->sender_id)
          {
              DB::table('message')->where('id',$data->id)->update(["sellerfavourite_status"=>""]);
              return redirect()->back();
          }
          else if($user == $data->receiver_id)
          {
               DB::table('message')->where('id',$data->id)->update(["sellerfavourite_status"=>""]);
              return redirect()->back();
          }
         
      }
    
        return redirect()->back();
    }

     public function favourite(Request $request)
    {
        $user=Session::get('user_id');
         $useremail=Session::get('user_email');
        $decline=DB::table('product')->where('product.status','=','Decline')->where('product.s_id','=',$user)->get();
        $data1=DB::table('product')->where('product.status','=','Active')->where('product.s_id','=',$user)->get();
         $data2=DB::table('product')->where('status','=','Pendding')->where('product.s_id','=',$user)->get(); 

          $inbox=DB::table('message')->where('message.sellerread_status','=','0')
          ->where('message.draft_status','=','Success')
          ->where('message.receiver_id','=',$user)->get();

          $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.sender_id','=',$user)->get();
          $total=DB::table('message')->get();

        $sort=$request->input('fer');
        if($sort==1)
        {
            $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as b1', 'message.receiver_id', '=', 'b1.id')
          ->where('message.sellerread_status','=','1')
          ->where("message.receiver_id",$user)
          ->orWhere("message.sender_id",$user)
          ->select('b1.type as type','user.type as btype',"b1.fname as buyer1_nm","user.fname as buyer2_nm","b1.email as buyer1_email","user.email as buyer2_email","b1.lname as buyer1_lnm","user.lname as buyer2_lnm","user.profile_image as buyer1_img","b1.profile_image as buyer2_img","message.*")
           ->orderBy('message.created_at','DESC')
           ->get();
        }
        else if($sort==2)
        {
           $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as b1', 'message.receiver_id', '=', 'b1.id')
          ->where('message.sellerread_status','=','0')
          ->where("message.receiver_id",$user)
          ->orWhere("message.sender_id",$user)
          ->select('b1.type as type','user.type as btype',"b1.fname as buyer1_nm","user.fname as buyer2_nm","b1.email as buyer1_email","user.email as buyer2_email","b1.lname as buyer1_lnm","user.lname as buyer2_lnm","user.profile_image as buyer1_img","b1.profile_image as buyer2_img","message.*")
           ->orderBy('message.created_at','DESC')
           ->get();
        }
        else
        {
          $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as b1', 'message.receiver_id', '=', 'b1.id')
          ->where("message.receiver_id",$user)
          ->orWhere("message.sender_id",$user)
          ->select('b1.type as type','user.type as btype',"b1.fname as buyer1_nm","user.fname as buyer2_nm","b1.email as buyer1_email","user.email as buyer2_email","b1.lname as buyer1_lnm","user.lname as buyer2_lnm","user.profile_image as buyer1_img","b1.profile_image as buyer2_img","message.*")
           ->orderBy('message.created_at','DESC')
           ->get();
        }

        return view('seller.favourite')->with(['data1'=>$data1,'data2'=>$data2,'decline'=>$decline,'data'=>$data,'sort'=>$sort,'inbox'=>$inbox,'total'=>$total,'draft'=>$draft]); 
    }
    

     public function sendmailseller(Request $request)
    {
        $user=Session::get('user_id');
        $useremail=Session::get('user_email');
        $decline=DB::table('product')->where('product.status','=','Decline')->where('product.s_id','=',$user)->get();
        $data1=DB::table('product')->where('product.status','=','Active')->where('product.s_id','=',$user)->get();
         $data2=DB::table('product')->where('status','=','Pendding')->where('product.s_id','=',$user)->get(); 

          $inbox=DB::table('message')->where('message.sellerread_status','=','0')
          ->where('message.draft_status','=','Success')
          ->where('message.receiver_id','=',$user)->get();

          $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.sender_id','=',$user)->get();

            $total=DB::table('message')->get();

        $sort=$request->input('fer');
        if($sort==1)
        {
          $data=DB::table('message')
          ->join('user', 'message.receiver_id', '=', 'user.id')
          ->join('user as seller', 'message.sender_id', '=', 'seller.id')
          ->where('message.sellerread_status','=','1')
          ->where('message.draft_status','=','Success')
          ->where('message.sender_id','=',$user)
          ->select('seller.type as type','user.type as btype','message.*','user.fname as bfname','user.lname as blname','user.profile_image as bprofile_image','user.email as bemail','seller.fname','seller.email','seller.lname','seller.profile_image')
          ->orderBy('created_at','DESC')
          ->Paginate(5);
        }
        else if($sort==2)
        {
            $data=DB::table('message')
          ->join('user', 'message.receiver_id', '=', 'user.id')
          ->join('user as seller', 'message.sender_id', '=', 'seller.id')
          ->where('message.sellerread_status','=','0')
          ->where('message.draft_status','=','Success')
          ->where('message.sender_id','=',$user)
          ->select('seller.type as type','user.type as btype','message.*','user.fname as bfname','user.lname as blname','user.profile_image as bprofile_image','user.email as bemail','seller.fname','seller.email','seller.lname','seller.profile_image')
          ->orderBy('created_at','DESC')
          ->Paginate(5);
        }
        else
        {
            $data=DB::table('message')
          ->join('user', 'message.receiver_id', '=', 'user.id')
          ->join('user as seller', 'message.sender_id', '=', 'seller.id')
          ->where('message.draft_status','=','Success')
          ->where('message.sender_id','=',$user)
          ->select('seller.type as type','user.type as btype','message.*','user.fname as bfname','user.lname as blname','user.profile_image as bprofile_image','user.email as bemail','seller.fname','seller.email','seller.lname','seller.profile_image')
          ->orderBy('created_at','DESC')
          ->Paginate(5);
        }

        return view('seller.sendmailseller')->with(['data1'=>$data1,'data2'=>$data2,'decline'=>$decline,'data'=>$data,'sort'=>$sort,'inbox'=>$inbox,'total'=>$total,'draft'=>$draft]);
    }

    public function unfavouritemail($id)
    {
      $data=DB::table('message')->where('id',$id)->first();
      if($data->sellerfavourite_status =="Favourite")
        {
          DB::table('message')->where('id',$data->id)->update(["sellerfavourite_status"=>""]);
          return redirect()->back();
        }
    
        return redirect()->back();
    }

     public function importantemail($id)
    {
       $data=DB::table('message')->where('id',$id)->first();
      $user=Session::get('user_id');
      if($data->sellerimportant_status =="")
      {
        if($user == $data->sender_id)
        {
            DB::table('message')->where('id',$data->id)->update(["sellerimportant_status"=>"Important"]);
            return redirect()->back();
        }
        else if($user == $data->receiver_id)
        {
            DB::table('message')->where('id',$data->id)->update(["sellerimportant_status"=>"Important"]);
            return redirect()->back();
        }
           
      }
      else if($data->sellerimportant_status =='Important')
      {
          if($user == $data->sender_id)
          {
              DB::table('message')->where('id',$data->id)->update(["sellerimportant_status"=>""]);
              return redirect()->back();
          }
          else if($user == $data->receiver_id)
          {
               DB::table('message')->where('id',$data->id)->update(["sellerimportant_status"=>""]);
              return redirect()->back();
          }
         
      }
        return redirect()->back();
    }

    public function important(Request $request)
    {
        $user=Session::get('user_id');
        $useremail=Session::get('user_email');
        $decline=DB::table('product')->where('product.status','=','Decline')->where('product.s_id','=',$user)->get();
        $data1=DB::table('product')->where('product.status','=','Active')->where('product.s_id','=',$user)->get();
        $data2=DB::table('product')->where('status','=','Pendding')->where('product.s_id','=',$user)->get(); 

        $inbox=DB::table('message')->where('message.sellerread_status','=','0')
          ->where('message.draft_status','=','Success')
          ->where('message.receiver_id','=',$user)->get();

        $draft=DB::table('message')->where('message.draft_status','=','draft')->where('message.sender_id','=',$user)->get();
        $total=DB::table('message')->get();
        $sort=$request->input('fer');
        if($sort==1)
        {
          $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as b1', 'message.receiver_id', '=', 'b1.id')
          ->where('message.sellerread_status','=','1')
          ->where("message.receiver_id",$user)
          ->orWhere("message.sender_id",$user)
          ->select('b1.type as type','user.type as btype',"b1.fname as buyer1_nm","user.fname as buyer2_nm","b1.email as buyer1_email","user.email as buyer2_email","b1.lname as buyer1_lnm","user.lname as buyer2_lnm","user.profile_image as buyer1_img","b1.profile_image as buyer2_img","message.*")
           ->orderBy('message.created_at','DESC')
          ->get();
        }
        else if($sort==2)
        {
         $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as b1', 'message.receiver_id', '=', 'b1.id')
          ->where('message.sellerread_status','=','0')
          ->where("message.receiver_id",$user)
          ->orWhere("message.sender_id",$user)
          ->select('b1.type as type','user.type as btype',"b1.fname as buyer1_nm","user.fname as buyer2_nm","b1.email as buyer1_email","user.email as buyer2_email","b1.lname as buyer1_lnm","user.lname as buyer2_lnm","user.profile_image as buyer1_img","b1.profile_image as buyer2_img","message.*")
           ->orderBy('message.created_at','DESC')
          ->get();
        }
        else
        {
          $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as b1', 'message.receiver_id', '=', 'b1.id')
          ->where("message.receiver_id",$user)
          ->orWhere("message.sender_id",$user)
          ->select('b1.type as type','user.type as btype',"b1.fname as buyer1_nm","user.fname as buyer2_nm","b1.email as buyer1_email","user.email as buyer2_email","b1.lname as buyer1_lnm","user.lname as buyer2_lnm","user.profile_image as buyer1_img","b1.profile_image as buyer2_img","message.*")
           ->orderBy('message.created_at','DESC')
          ->get();
        }

        return view('seller.sellerimportant')->with(['data1'=>$data1,'data2'=>$data2,'decline'=>$decline,'data'=>$data,'sort'=>$sort,'inbox'=>$inbox,'total'=>$total,'draft'=>$draft]);
       
    }
   
     public function notimportantemail($id)
    {
        $data=DB::table('message')->where('id',$id)->first();
        if($data->sellerimportant_status =="Important")
        { 
          DB::table('message')->where('id',$data->id)->update(["sellerimportant_status"=>""]);
          return redirect()->back();
        }
       return redirect()->back();
    }
}
