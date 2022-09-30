<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Mail;
use Message;
use Notification;
use Illuminate\Pagination\Paginator;
use App\SendMail;
use Session;

class AdminCategoryController extends Controller
{
    public function index()
    {
      return view('Admin.admininsertcategory');
    }
     public function index1(Request $request)
    {
      $search=$request->input('search');
    	$data = DB::table('category')
      ->where('c_name','LIKE','%'.$search.'%')
      ->Paginate(5);
    	
      return view('Admin.adminshowcategory')->with(['data'=>$data,"search"=>$search]);
    }

    public function admininsert(Request $request)
    {
	     if ($request->isMethod('get')) 
	     {
	        return view('Admin.admininsertcategory');
	     }
     else
     {
        $data = $request->all();
        $same=DB::table('category')->where('c_name',$data['c_name'])->count();
        if($same>0)
        { 
          return redirect()->back()->with('error','exist');
        }
         else
         {
            if($data['c_name']!='')
          	{
              DB::table('category')->insert(["c_name"=>$data['c_name'],"status"=>'Active']);

              return redirect()->back()->with('message','Insert Category Successfully');
            }
            else
          	{
            return redirect()->back()->with('error','Category Are Not Inserted');
         	}
        }
     }
    }

    public function update($id) 
   {
   	  $data = DB::table('category')->where('id',$id)->first();
      return view('Admin.adminupdatecategory')->with('data',$data);
   }

  public function adminedit(Request $request)
  {
  		$data = $request->all();
  		
	     if($data['c_name']!='' )
	     {

	  		  DB::table('category')->where('id',$data['id'])->update(["c_name"=>$data['c_name']]);
	        return redirect()->back()->with('message','Update Category Successfully!');
	  	  }     
		else
		{
		 return redirect()->back()->with('error','Category Are Not Updated!');
		}
  }

  public function admindelete($id)
  { 
     $data=DB::table('category')->where('id',$id)->delete();   
     return redirect()->back();   
  }

    public function changestatus($id)
    {
    	 $data=DB::table('category')->where('id',$id)->first();
     
       if($data->status =='Active')
      	{
          DB::table('category')->where('id',$data->id)->update(["status"=>"Blocked"]);
      		return redirect()->back();
      	}
      	else
      	{
      		DB::table('category')->where('id',$data->id)->update(["status"=>"Active"]);
      		return redirect()->back();
      	}

     }

     public function changestatusads(Request $request,$id)
    {
        $data1=DB::table('product')->where('id',$id)->first();
     

      if($data1->status == 'Pendding')
      {
         $bb=$data1->s_id;
         $s=DB::table('product')->where('id',$data1->id)->update(["status"=>"Active"]);
        
              // echo "<pre>";
              // print_r($d1);
              // die();
             

          Session::put("sid".$bb,"Your Product Has been Approve");
         // $pro_data=DB::table('notification')->insert(["pro_id"=>$id,"notification"=>'Your Product Has been Approve',"read_status"=>'0']);
          //$dd=DB::table('notification')->get();

         $ab=DB::table('notification')->where('pro_id',$id)->count();
          if($ab > 0)
          {
              DB::table('notification')->where('pro_id',$id)->update(["notification"=>'Your Product Has been Approve',"read_status"=>'0']);
          }
          else
          {
            $pro_data=DB::table('notification')->insert(["pro_id"=>$id,"notification"=>'Your Product Has been Approve',"read_status"=>'0']);
          }
        return redirect()->back();
      }
      
      else if($data1->status == 'Active')
      {
         DB::table('product')->where('id',$data1->id)->update(["status"=>"Blocked"]);
        return redirect()->back();
      }
       else if($data1->status == 'Blocked')
      {
         DB::table('product')->where('id',$data1->id)->update(["status"=>"Active"]);
        return redirect()->back();
      }
    }
      
    public function changestatusadsdec(Request $request,$id)
    {
        $data1=DB::table('product')->where('id',$id)->first();

         $d1=DB::table('product')
          ->join('user','user.id','=','product.s_id')
          ->where('user.type','=','S')
         ->where('product.id',$id)
         ->select('product.*','user.email')
         ->first();
      if($data1->status == 'Pendding')
      {
          DB::table('product')->where('id',$data1->id)->update(["status"=>"Decline"]);
          $bb=$data1->s_id;
          $ab=DB::table('notification')->where('pro_id',$id)->count();
          $emails=$d1->email;
          // echo "<pre>";
          // print_r($emails);
          // die();

          $p_id=$d1->id;
          $allmsg="Product_Id:".$p_id."\n"."Your Product has been Decline...";
          if($ab > 0)
          {
              DB::table('notification')->where('pro_id',$id)->update(["notification"=>'Your Product Has been Decline',"read_status"=>'0']);

              //  Mail::raw($allmsg,function ($message) use ($request, $emails)
              // {
              //     $message->from(Session::get('admin_email'));
              //     $message->to($emails);
              //     $message->subject("Product Message");
              // });
              SendMail::sendmail($emails,'Product Message',$allmsg);
                return redirect()->back();
            }
            else
            {
              $pro_data=DB::table('notification')->insert(["pro_id"=>$id,"notification"=>'Your Product Has been Decline',"read_status"=>'0']);

                // Mail::raw($allmsg,function ($message) use ($request, $emails)
                // {
                //     $message->from(Session::get('admin_email'));
                //     $message->to($emails);
                //     $message->subject("Product Message");
                // });

              SendMail::sendmail($emails,'Product Message',$allmsg);
                  return redirect()->back();
            
            }
            return redirect()->back();
      }
  
     }
     
  public function showads(Request $request)
  {
     $requestData = ['ptitle','price','c_name','type','product.status','condition_type'];
      $search=$request->input('search');
      $data =DB::table('category')
      ->join('product', 'category.id', '=', 'product.c_id')
      ->join('product_image', 'product_image.p_id', '=', 'product.id')
      ->select('category.c_name','product.*','product_image.image')
      ->where(function($q) use($requestData, $search) {
              foreach ($requestData as $field)
                 $q->orWhere($field, 'like', "%{$search}%");
      })
      ->orderBy('product.created_at','DESC')
      ->Paginate(7);
     
       $d1=DB::table('product')
                  ->where('product.status','=','Pendding')->count();
                session::put('penstatus',$d1);
     
     return view('Admin.adminshowpost')->with(['data'=>$data,'search'=>$search]);

  }
    
    public function showdata($imageid)
    {
       $data =DB::table('category')
        ->join('product', 'category.id', '=', 'product.c_id')
        ->join('product_image', 'product_image.p_id', '=', 'product.id')
        ->where("product_image.p_id",$imageid)
        ->select('category.*','product.*','product_image.image')
        ->get();
       return view('Admin.adminshowadsdetail')->with(["data"=>$data]);
   } 

    public function showseller(Request $request)
    {
      $id = Session::get("admin_id");
      $requestData = ['fname','lname','city','state.StateName','address','status'];
      $data1 = \App\Message::all(array('sender_id','receiver_id','message','files','buyerread_status','sellerfavourite_status','buyerfavourite_status','sellerimportant_status','buyerimportant_status','draft_status'));
       
      $search=$request->input('search');
      $data =DB::table('user')
      ->join('state','user.state','=','state.StateID')  
      ->select('user.*','state.StateName')
      ->where(['user.type'=>'S'])
      ->where(function($q) use($requestData, $search) { 
              foreach ($requestData as $field)
                 $q->orWhere($field, 'like', "%{$search}%");

      }) 
      ->Paginate(7);

      return view('Admin.adminshowseller')->with(['data'=>$data,'data1'=>$data1,"search"=>$search]);

    }
    
    public function adminshowsellermessage(Request $request,$id)
    {
     $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as b1', 'message.receiver_id', '=', 'b1.id')
          ->where("message.receiver_id",$id)
          ->select("b1.fname as buyer1_nm","user.fname as buyer2_nm","b1.email as buyer1_email","user.email as buyer2_email","b1.lname as buyer1_lnm","user.lname as buyer2_lnm","user.profile_image as buyer1_img","b1.profile_image as buyer2_img","message.*")
          ->orderBy('message.created_at','DESC')
          ->groupBy("user.fname","b1.fname")
          ->Paginate(5);
        // ->get();

      return view('Admin.adminshowsellermessage')->with('data',$data);
    }


   public function adminsellermessagedetail(Request $request,$id,$rid)
    {
     
       $data=DB::table('message')
          ->leftjoin('user', 'message.sender_id', '=', 'user.id')
          ->leftjoin('user as b1', 'message.receiver_id', '=', 'b1.id')
      
          ->where("message.receiver_id",$id)
          ->where("message.sender_id",$rid)
          ->orWhere("message.receiver_id",$rid)
          ->where("message.sender_id",$id)
          ->where('message.draft_status','=','Success')
          ->select('message.*','user.id as buyer_id','user.type as type','user.fname as fname','user.lname as lname','user.email as email','user.profile_image as profileimage','b1.id as buyer1_id',"b1.fname as buyer1_nm","b1.lname as buyer1_lnm","b1.profile_image as buyer2_img",'b1.type as btype')
          ->orderBy('message.created_at','DESC')
          ->Paginate(5);
          //->get();
          // echo "<pre>";
          // print_r($data);
          // die();

         return view('Admin.adminsellermessagedetail')->with('data',$data);
    }

    public function adminshowbuyermessage(Request $request,$id)
    {
      $data = DB::table("message")
          ->leftJoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as s1', 'message.receiver_id', '=', 's1.id')
          ->where("message.sender_id",$id)
          ->select("s1.fname as seller1_nm",'user.type as type',"user.fname as seller2_nm","s1.email as seller1_email","user.email as seller2_email","s1.lname as seller1_lnm","user.lname as seller2_lnm","user.profile_image as seller1_img","s1.profile_image as seller2_img","message.*",'s1.type as stype')
          ->orderBy('message.created_at','DESC')
          ->groupBy("user.fname","s1.fname")
          ->Paginate(5);
        //     ->get();

        // echo "<pre>";
        // print_r($data);
        // die();

       return view('Admin.adminshowbuyermessage')->with('data',$data);

    }

    public function adminbuyermessagedetail(Request $request,$id,$sid)
    {
     $data=DB::table('message')
          ->leftjoin('user', 'message.sender_id', '=', 'user.id')
          ->leftJoin('user as s1', 'message.receiver_id', '=', 's1.id')

          ->where("message.receiver_id",$sid)
          ->where("message.sender_id",$id)
          ->orWhere("message.receiver_id",$id)
          ->where("message.sender_id",$sid)
          ->where('message.draft_status','=','Success')
          ->select('message.*','user.fname','user.type as type','user.lname','user.profile_image',"s1.fname as seller1_nm","s1.lname as seller1_lnm","s1.profile_image as seller1_img",'s1.type as stype')
          ->orderBy('message.created_at','DESC')
          ->Paginate(5);  
          //->get();
         //echo "<pre>";
        // print_r($data);
       // die();
       return view('Admin.adminbuyermessagedetail')->with('data',$data);
    }


 public function sellerchangestatus($id)
    {

      $data=DB::table('user')->where('id',$id)->where(['user.type'=>'S'])->first();
      if($data->status =='Active')
      {
        DB::table('user')->where('id',$data->id)->update(["status"=>"Blocked"]);
        return redirect()->back();
      }
      else if($data->status =='Blocked')
      {
        DB::table('user')->where('id',$data->id)->update(["status"=>"Active"]);
        return redirect()->back();
      }

    }


  public function showbuyer(Request $request)
    {
      $requestData = ['fname','lname','city','address','status'];
      $search=$request->input('search');

      $data1 = \App\Message::all(array('sender_id','receiver_id','message','files','buyerread_status','sellerfavourite_status','buyerfavourite_status','sellerimportant_status','buyerimportant_status','draft_status'));

      $data =DB::table('user')
     ->select('user.*')
     ->where(['user.type'=>'B'])
     ->where(function($q) use($requestData, $search) {
              foreach ($requestData as $field)
                 $q->orWhere($field, 'like', "%{$search}%");
      })
    ->Paginate(7);
      return view('Admin.adminshowbuyer')->with(['data'=>$data,'data1'=>$data1,"search"=>$search]);
    }

    public function buyerchangestatus($id)
    {
      $data=DB::table('user')->where('id',$id)->where(['user.type'=>'B'])->first();
      if($data->status =='Active')
      {
        DB::table('user')->where('id',$data->id)->update(["status"=>"Blocked"]);
        return redirect()->back();
      }
      else if($data->status =='Blocked')
      {
        DB::table('user')->where('id',$data->id)->update(["status"=>"Active"]);
        return redirect()->back();
      }

    }

}
