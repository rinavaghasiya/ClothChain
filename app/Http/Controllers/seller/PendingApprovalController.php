<?php
namespace App\Http\Controllers\seller;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class PendingApprovalController extends Controller
{
    public function index(Request $request)
    {
      $user=Session::get('user_id');
      $requestData = ['ptitle','price'];
      $search = $request->input('search');  
      $data1=DB::table('product')->where('product.s_id','=',$user)->get();
      $decline=DB::table('product')->where('product.status','=','Decline')->where('product.s_id','=',$user)->get();
      $pen=DB::table('product')->where('product.status','=','Pendding')->where('product.s_id','=',$user)->get();
     $inbox=DB::table('message')->where('message.sellerread_status','=','0')
     ->where('message.draft_status','=','Success')
     ->where('message.receiver_id','=',$user)->get();

      $data2=DB::table('product')->where('product.status','=','Active')->where('product.s_id','=',$user)->get();
      $data=DB::table('product')
            ->join('product_image', 'product.id', '=', 'product_image.p_id')
            ->join('user','user.id','=','product.s_id')
            ->join('state','user.state','=','state.StateID')
            ->where(['user.type'=>'S'])
            ->where(function($q) use($requestData, $search) {
                        foreach ($requestData as $field)
                           $q->orWhere($field, 'like', "%{$search}%");
                })
           ->where('product.s_id','=',$user)
           ->where('product.status','Pendding')
           ->select('product.*','product_image.*','state.StateName')
           ->orderBy('product.created_at','DESC')
           ->get();
      return view('seller.account-pending-approval-ads')->with(['data'=>$data,'data1'=>$data1,'data2'=>$data2,'decline'=>$decline,"pen"=>$pen,"inbox"=>$inbox,"search"=>$search]);
    
    	
    }

    public function deleteproduct($id) 
   {
   		$image= DB::table('product_image')->where("p_id",$id)->pluck("image")->toArray();
      if($image[0]!='')
      {
        if(file_exists('public/image/'.$image[0]))
        {
          DB::table('product')->where('id',$id)->delete();
          DB::table('product_image')->where('p_id',$id)->delete();

          unlink('public/image/'.$image[0]);
           return redirect()->back()->with('message','Delete  Successfully!');
        }
        else
        {
           echo "file not exist";
        } 

     }
    }

public function declineindex(Request $request)
{
    $user=Session::get('user_id');
    $requestData = ['ptitle','price'];
    $search = $request->input('search');  
    $data1=DB::table('product')->where('product.s_id','=',$user)->get();
    $inbox=DB::table('message')->where('message.sellerread_status','=','0')
     ->where('message.draft_status','=','Success')
     ->where('message.receiver_id','=',$user)->get();

    $data2=DB::table('product')->where('product.status','=','Active')->where('product.s_id','=',$user)->get();
    $decline=DB::table('product')->where('product.status','=','Decline')->where('product.s_id','=',$user)->get();
    $pen=DB::table('product')->where('product.status','=','Pendding')->where('product.s_id','=',$user)->get();

    $data=DB::table('product')
    ->join('product_image', 'product.id', '=', 'product_image.p_id')
    ->join('user','user.id','=','product.s_id')
    ->join('state','user.state','=','state.StateID')
    ->where(['user.type'=>'S'])
    ->where(function($q) use($requestData, $search) {
                foreach ($requestData as $field)
                   $q->orWhere($field, 'like', "%{$search}%");
        })
    ->where('product.s_id','=',$user)
    ->where('product.status','Decline')
    ->select('product.*','product_image.*','state.StateName')
    ->orderBy('product.created_at','DESC')
    ->get();
    
      return view('seller.declineproduct')->with(['data'=>$data,'data1'=>$data1,'data2'=>$data2,'decline'=>$decline,"pen"=>$pen,"inbox"=>$inbox,"search"=>$search]);
      
    }
  public function updateproduct($id) 
  {
     $user=Session::get('user_id');
     $pen=DB::table('product')->where('product.status','=','Pendding')->where('product.s_id','=',$user)->get();
     $data1=DB::table('product')->where('product.s_id','=',$user)->get();
    
     $data2=DB::table('product')->where('product.status','=','Active')->where('product.s_id','=',$user)->get();
     $decline=DB::table('product')->where('product.status','=','Decline')->where('product.s_id','=',$user)->get();

     $inbox=DB::table('message')->where('message.buyerread_status','=','0')
       ->where('message.draft_status','=','Success')
       ->where('message.receiver_id','=',$user)->get();

     $data=DB::table('product')
            ->join('product_image', 'product.id', '=', 'product_image.p_id')
            ->where("product.id",$id)
            ->first();
    return view('seller.editproduct')->with(['data'=>$data,'data1'=>$data1,'data2'=>$data2,'decline'=>$decline,'pen'=>$pen,"inbox"=>$inbox]);
  }
    
  public function editproduct(Request $request) 
  {
      $data = $request->all();
     if($data['ptitle']!='' && $data['description']!='' && $data['price']!='')
     {
      $price=$request->input('price');
      if($price!=0) 
      {

         $updata= DB::table('product')->where('id',$data['pid'])->update(["ptitle"=>$data['ptitle'],"description"=>$data['description'],"price"=>$data['price'],"status"=>'Pendding']);
        if(@$data['image']!='')
        {
          
           $img=array();
            if($files=$request->file('image'))
            {
              foreach($files as $file)
              {
                //$name = @$data['image']->getClientOriginalName();
                    $name=$file->getClientOriginalName();
                    // $t=time().$name;
                    
                    $img = explode(".",$name);
                     $t=time().".".$img[1] ;
                     if($img [1] =='png' ||  $img [1] == "jpg" ||  $img [1] =="jpeg")
                    {
                        $file->move(public_path('image'),$t ); 
                        $image[]=$t;
                    }
                    else
                   {
                      return redirect()->back()->with('error','Invalid Image Type');
                   }
              }
           }
           $im=count($image);
          
          

             if($im<=5)
              {
                  DB::table('product_image')->where('p_id',$data['pid'])->update(["image"=>implode(",",$image)]);
                  $photo = $request->input('oldimg');

                  if($photo!='')
                  {
                      if(file_exists('public/image/'.$photo))
                      {
                        unlink('public/image/'.$photo);
                      }
                      else
                      {
                        echo "file not exist";
                      } 

                      return redirect()->back()->with('message','Update Product Successfully!');
                  } 
              }
              else
              {
              return redirect()->back()->with('error','Enter Only 5 Images');
              }
          }  
           
          
         return redirect()->back()->with('message','Update Product Successfully!');
        }
      else
      {
        return redirect()->back()->with('error','Price Must be Greater than 0');
         
      }
    }
    else
    {
      return redirect()->back()->with('error','Please Fill All The Fileds');
    }
  }

  public function notification()
 {
   $user=Session::get('user_id');
      $data=DB::table('notification')
            ->join('product', 'notification.pro_id', '=', 'product.id')
            ->where('product.s_id',"=",$user)
             ->orderBy('notification.created_at','DESC')
            ->get();

    return view('seller.notifications')->with("data",$data);
 }
 
 public function notificationviewdata()
 {
    return view('seller.notifications');
 }

}