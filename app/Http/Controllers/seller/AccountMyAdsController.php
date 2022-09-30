<?php

namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Session;
use DB;

class AccountMyAdsController extends Controller
{
    public function index(Request $request)
    {
      $user=Session::get('user_id');
      $data1=DB::table('product')->where('product.s_id','=',$user)->get();
      $decline=DB::table('product')->where('product.status','=','Decline')->where('product.s_id','=',$user)->get();
      $data2=DB::table('product')->where('status','=','Pendding')->where('product.s_id','=',$user)->get(); 
      $requestData = ['ptitle','price'];
    	$search = $request->input('search');  

      $inbox=DB::table('message')->where('message.sellerread_status','=','0')
       ->where('message.draft_status','=','Success')
       ->where('message.receiver_id','=',$user)->get();
      $buser=Session::get('user_id1');
      $binbox=DB::table('message')->where('message.buyerread_status','=','0')
       ->where('message.draft_status','=','Success')
       ->where('message.receiver_id','=',$buser)->get();
       
      $allads=DB::table('product')->where('product.status','=','Active')->where('product.s_id','=',$user)->get();
      $data=DB::table('product')
      ->join('product_image', 'product.id', '=', 'product_image.p_id')

      ->join('user','user.id','=','product.s_id')
      ->join('state','user.state','=','state.StateID')
      ->where('product.status','=','Active')  
       ->where(['user.type'=>'S'])
      ->where('product.s_id','=',$user)
      ->where(function($q) use($requestData, $search) {
                  foreach ($requestData as $field)
                     $q->orWhere($field, 'like', "%{$search}%");
          })
      ->select('product.*','product_image.*','state.StateName')
      ->orderBy('product.created_at','DESC')
      ->Paginate(5);
      
      return view('seller.account-myads')->with(['data'=>$data,'data1'=>$data1,'data2'=>$data2,"allads"=>$allads,'decline'=>$decline,"inbox"=>$inbox,"binbox"=>$binbox,"search"=>$search]);
    }
    
  public function deletemyads($id) 
   {
      $image= DB::table('product_image')->where("p_id",$id)->pluck("image")->toArray();
        if($image[0]!='')
        {
          if(file_exists('public/image/'.$image[0]))
          {
            DB::table('product')->where('id',$id)->delete();
            DB::table('product_image')->where('p_id',$id)->delete();

            unlink('public/image/'.$image[0]);
           return redirect()->back()->with('message','Delete Product Successfully!');
          }
          else
          {
             echo "file not exist";
          } 
       }
    }
    
  public function updatemyads($id) 
  {
    $user=Session::get('user_id');
    $data1=DB::table('product')->where('product.s_id','=',$user)->get();
    $data2=DB::table('product')->where('product.status','=','Active')->where('product.s_id','=',$user)->get();
    $pen=DB::table('product')->where('status','=','Pendding')->where('product.s_id','=',$user)->get(); 
    $decline=DB::table('product')->where('product.status','=','Decline')->where('product.s_id','=',$user)->get();

     $inbox=DB::table('message')->where('message.sellerread_status','=','0')
       ->where('message.draft_status','=','Success')
       ->where('message.receiver_id','=',$user)->get();

     $data=DB::table('product')
      ->join('product_image', 'product.id', '=', 'product_image.p_id')
      ->where("product.id",$id)
      ->first();
    return view('seller.editmyads')->with(['data'=>$data,'data1'=>$data1,'data2'=>$data2,'pen'=>$pen,'decline'=>$decline,"inbox"=>$inbox]);
  }
    
 public function editmyads(Request $request) 
  {

    $time=date('Y-m-d H:i:s',time());
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
                        $file->move(public_path('public/image'),$t ); 
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

}