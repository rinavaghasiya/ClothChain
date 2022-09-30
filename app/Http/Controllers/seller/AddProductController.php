<?php

namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests;
use Session;  

class AddProductController extends Controller
{
    public function index()
    {
    	$user=Session::get('user_id');
      $data1=DB::table('product')->where('product.status','=','Active')->where('product.s_id','=',$user)->get();
    	$data2=DB::table('product')->where('status','=','Pendding')->where('product.s_id','=',$user)->get(); 
    	$data3 = DB::table('product')->where('product.s_id','=',$user)->get();
    	$decline=DB::table('product')->where('product.status','=','Decline')->where('product.s_id','=',$user)->get();
    	$inbox=DB::table('message')->where('message.sellerread_status','=','0')
     ->where('message.draft_status','=','Success')
     ->where('message.receiver_id','=',$user)->get();

    	$data = DB::table('category')->where("status","Active")->get();
      return view('seller.addproduct')->with(['data'=>$data,'data1'=>$data1,'data2'=>$data2,'data3'=>$data3,'decline'=>$decline,"inbox"=>$inbox]);
    	
    }

    public function adsdetail($imageid)
    {
      $user=Session::get('user_id');
          $data=DB::table('product')
          ->join('product_image', 'product.id', '=', 'product_image.p_id')
          ->join('user','user.id','=','product.s_id')
          ->join('state','user.state','=','state.StateID')
          ->where(['user.type'=>'S'])
          ->where("product_image.p_id",$imageid)
          ->select('product.*','user.fname','user.lname','state.StateName','user.phone','user.profile_image','product_image.image')
          ->get();

     $a1= DB::table('notification')->where('pro_id',$imageid)->update(["read_status"=>'1']);
      $noty=DB::table('notification')
                    ->join('product','product.id','=','notification.pro_id')
                    ->join('user','user.id','=','product.s_id')
                    ->where('notification.read_status',"0")
                    ->where('user.id','=',$user)
                    ->select('notification.*','user.id as user_id')
                    ->count();

                   
                    session::put('noti',$noty);
      return view('seller.ads-detail')->with(["data"=>$data]);  
    }

  public function insert(Request $request)
   {
   	 

    $sid= Session::get("user_id");

      if ($request->isMethod('get')) 
      {
        return view('seller.addproduct');
      }
     else
     {
        $data = $request->all();
        if($data['category']!='' && $data['ptitle']!='' && $data['describe']!='' && $data['condition']!=''  && $data['price']!='' )
        {
          
              $price=$request->input('price');
              // echo "<pre>";
              // print_r($price);
              // die();

          if($price!=0) 
          {
            if(@$data['image'] !='')
          {
         
           $img=array();
           if($files=$request->file('image'))
           {
             foreach($files as $file)
             {
              
                $name=$file->getClientOriginalName();
                 $t=time().$name;
                // $t=time().".".$name;
                $img = explode(".",$t);

               $file->move(public_path('image'),$t ); 
                $image[]=$t;
             }
           }
           $im=count($image);
            if($img [1] =='png' ||  $img [1] == "jpg" ||  $img [1] =="jpeg")
            {
              if($im<=5)
              {
                $id = DB::table('product')->insertGetId(["s_id"=>$sid,"c_id"=>$data['category'],"type"=> $data['type'],"ptitle"=>$data['ptitle'],"description"=>$data['describe'],"condition_type"=>$data['condition'],"price"=>$data['price'],"status"=>"Pendding"]);
            
                DB::table('product_image')->insert(["p_id"=>$id,"image"=>implode(",",$image)]);
             
                 return redirect()->back()->with('message',' Product Insert Sucessfully!');
              }
              else
              {
               return redirect()->back()->with('error','Enter Only 5 Images');
              }
            }
            else
            {
              return redirect()->back()->with('error','Invalid Image Type');
            }
          
        }
        else
          {
             return redirect()->back()->with('error','Please Select Image');
          }
      }
      else
      {
        return redirect()->back()->with('error','Price Must be Greater Then 0');
      } 

      }
      else
      {
        return redirect()->back()->with('error','Please Fill all the Filelds');
      }
    }

    // $sid= Session::get("user_id");

    //   if ($request->isMethod('get')) 
    //   {
    //     return view('seller.addproduct');
    //   }
    //  else
    //  {
    //     $data = $request->all();
    //     if($data['category']!='' && $data['ptitle']!='' && $data['describe']!='' && $data['condition']!=''  && $data['price']!='' )
    //     {
          
    //           $price=$request->input('price');
    //           if($price!=0) 
    //           {
    //             if(@$data['image'] !='')
    //             {
         
    //              $img=array();
    //              $files=$request->file('image');
           
    //              foreach($files as $file)
    //             {
              
    //               $name=$file->getClientOriginalName();
    //             //$t=time().$name;
               
    //               $img = explode(".",$name);
    //               //$ext = explode(".",$name);
    //               $t=time().".".$img[1] ;
              
                
    //               if($img [1] =='png' ||  $img [1] == "jpg" ||  $img [1] =="jpeg")
    //              {
    //                    $image[]=$t;
    //                    $im=count($image);
    //                  if($im<=5)
    //                  {
    //                       $file->move(public_path('image'),$t ); 
    //                       $id = DB::table('product')->insertGetId(["s_id"=>$sid,"c_id"=>$data['category'],"type"=> $data['type'],"ptitle"=>$data['ptitle'],"description"=>$data['describe'],"condition_type"=>$data['condition'],"price"=>$data['price'],"status"=>"Pendding"]);
                      
    //                       DB::table('product_image')->insert(["p_id"=>$id,"image"=>implode(",",$image)]);
                       
    //                        return redirect()->back()->with('message',' Product Insert Sucessfully!');
    //                 }
    //                 else
    //                 {
    //                    return redirect()->back()->with('error','Enter Only 5 Images');
    //                 }
    //             }
    //             else
    //             {
    //               return redirect()->back()->with('error','Invalid Image Type');
    //             }
          
    //        }
    //      }
    //     else
    //     {
    //         return redirect()->back()->with('error','Please Select Image');
    //     }
    //   }
    //   else
    //   {
    //     return redirect()->back()->with('error','Price Must be Greater Then 0');
    //   } 

    //   }
    //   else
    //   {
    //     return redirect()->back()->with('error','Please Fill all the Filelds');
    //   }
    // }
  
	}
}