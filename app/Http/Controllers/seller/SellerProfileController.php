<?php

namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class SellerProfileController extends Controller
{
    public function index(Request $request)
    {
    	$id = Session::get("user_id");
      $a = DB::table("user")->where("id",$id)->where(['user.type'=>'S'])->first();

      $requestData = ['ptitle','price'];
    	$search = $request->input('search');  
    	$sort=$request->input('myddl');
    	$user=Session::get('user_id');
    	$allads=DB::table('product')->where('product.status','=','Active') ->where('product.s_id','=',$user)->get();
    	if($sort==1)
   	 	{
            $data=DB::table('product')
            ->join('product_image', 'product.id', '=', 'product_image.p_id')
            ->join('category','category.id','=','product.c_id')
            ->join('user','user.id','=','product.s_id')
            ->join('state','user.state','=','state.StateID')
            ->select('product.*','product_image.*','state.StateName','category.c_name')
          ->where('product.status','=','Active')
          ->where('product.s_id','=',$user)
          ->where(function($q) use($requestData, $search) {
                      foreach ($requestData as $field)
                         $q->orWhere($field, 'like', "%{$search}%");
              })
          ->orderBy('product.price','ASC')
          ->Paginate(5);
        }

        


        else if($sort==2)
    	{
        $data=DB::table('product')
            ->join('product_image', 'product.id', '=', 'product_image.p_id')
            ->join('category','category.id','=','product.c_id')
            ->join('user','user.id','=','product.s_id')
            ->join('state','user.state','=','state.StateID')
            ->select('product.*','product_image.*','state.StateName','category.c_name')
            ->where('product.status','=','Active')
            ->where('product.s_id','=',$user)
            ->where(function($q) use($requestData, $search) {
                        foreach ($requestData as $field)
                           $q->orWhere($field, 'like', "%{$search}%");
                })
           ->orderBy('product.price','DESC')
 			    ->Paginate(5);
        }
        else
   	 	{
      	 $data=DB::table('product')
            ->join('product_image', 'product.id', '=', 'product_image.p_id')
            ->join('category','category.id','=','product.c_id')
            ->join('user','user.id','=','product.s_id')
            ->join('state','user.state','=','state.StateID')
            ->select('product.*','product_image.*','state.StateName','category.c_name')
            ->where('product.status','=','Active')
            ->where('product.s_id','=',$user)
            ->where(function($q) use($requestData, $search) {
                        foreach ($requestData as $field)
                           $q->orWhere($field, 'like', "%{$search}%");
                })
            ->orderBy('product.price','ASC')
            ->Paginate(5);
        }

    	return view('seller.seller-profile')->with(["a"=>$a,"data"=>$data,"sort"=>$sort,"allads"=>$allads]);
    }
}
