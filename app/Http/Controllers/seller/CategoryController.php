<?php

namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Session;

class CategoryController extends Controller
{ 
    public function index(Request $request)
    {
        $call=DB::table('product')->where('status','=','Active')->get();
        $data1=DB::table('product')->where('condition_type','=','New')->get();
        $data2=DB::table('product')->where('condition_type','=','Used')->get();
        $cmen=DB::table('product') ->where("type","men")->where('status','=','Active')->get();
        $cwoman=DB::table('product') ->where("type","woman")->where('status','=','Active')->get();
        $state=DB::table('state')->get();
        $cat=DB::table('category')->get();

        $search=$request->input('search');
        $sort=$request->input('myddl');

        $min = $request->input('min');  
        $max = $request->input('max');

       if($min=="")
       {
        $min=1;
       }
       if($max=="")
       {
        $max=500000;
       }
        $requestData = ['ptitle','price'];
       
        if($sort==2)
        {
            $data=DB::table('product')
            ->join('product_image', 'product.id', '=', 'product_image.p_id')
            ->join('category','category.id','=','product.c_id')
            ->join('user','user.id','=','product.s_id')
            ->join('state','user.state','=','state.StateID')
            ->select('product.*','product_image.p_id','product_image.image','state.StateName','category.c_name')
            ->where(['user.type'=>'S'])
            ->where('product.status','=','Active')
            ->whereBetween('product.price', array($min, $max))
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
            ->select('product.*','product_image.p_id','product_image.image','state.StateName','category.c_name')
            ->where(['user.type'=>'S'])
            ->where('product.status','=','Active')
            ->whereBetween('product.price', array($min, $max))
            ->where(function($q) use($requestData, $search) {
                    foreach ($requestData as $field)
                    $q->orWhere($field, 'like', "%{$search}%");
                })
            ->orderBy('product.price','ASC')
            ->Paginate(5);
        }
        return view('seller.category')->with(['data'=>$data,"cat"=>$cat,"sort"=>$sort,"state"=>$state,'data1'=>$data1,'data2'=>$data2,"cmen"=>$cmen,"cwoman"=>$cwoman,'call'=>$call,"search"=>$search,'min'=>$min,"max"=>$max]);
      }
        public function menindex(Request $request)
        {
            $data1=DB::table('product')->where('condition_type','=','New')->get();
            $data2=DB::table('product')->where('condition_type','=','Used')->get();
            $call=DB::table('product')->where('status','=','Active')->get();
            $cwoman=DB::table('product') ->where("type","woman")->where('status','=','Active')->get();
            $cat=DB::table('category')->get();
            $state=DB::table('state')->get();
            $search=$request->input('search');
            $sort=$request->input('myddl');
            $min = $request->input('mmin');  
            $max = $request->input('mmax');
            
            if($min=="")
            {
                $min=1;
            }
           if($max=="")
           {
                $max=500000;
           }
           $requestData = ['ptitle','price'];
          
            if($sort==2)
            {
                $men=DB::table('product')
                ->join('product_image', 'product.id', '=', 'product_image.p_id')
                ->join('category','category.id','=','product.c_id')
                ->join('user','user.id','=','product.s_id')
                ->join('state','user.state','=','state.StateID')
                ->select('product.*','product_image.p_id','product_image.image','state.StateName','category.c_name')
                ->where(['user.type'=>'S'])
                ->where('product.status','=','Active')
                ->where("product.type","men")
                // ->where('product.ptitle','LIKE','%'.$search.'%')
                ->whereBetween('product.price', array($min, $max))
                ->where(function($q) use($requestData, $search) {
                        foreach ($requestData as $field)
                           $q->orWhere($field, 'like', "%{$search}%");
                })
                ->orderBy('product.price','DESC')
                ->Paginate(5);
            }
            else
            {
                $men=DB::table('product')
                ->join('product_image', 'product.id', '=', 'product_image.p_id')
                ->join('category','category.id','=','product.c_id')
                ->join('user','user.id','=','product.s_id')
                ->join('state','user.state','=','state.StateID')
                ->select('product.*','product_image.p_id','product_image.image','state.StateName','category.c_name')
                ->where(['user.type'=>'S'])
                ->where('product.status','=','Active')
                ->where("product.type","men")
               // ->where('product.ptitle','LIKE','%'.$search.'%')
                ->whereBetween('product.price', array($min, $max))
                ->where(function($q) use($requestData, $search) {
                        foreach ($requestData as $field)
                           $q->orWhere($field, 'like', "%{$search}%");
                })
                ->orderBy('product.price','ASC')
                ->Paginate(5);
            }


            return view('seller.men')->with(["men"=>$men,"cat"=>$cat,"sort"=>$sort,"state"=>$state,"call"=>$call,"cwoman"=>$cwoman,"data1"=>$data1,"data2"=>$data2,"search"=>$search,'min'=>$min,"max"=>$max]);
        }

         public function womanindex(Request $request)
        {
             
            $data1=DB::table('product')->where('condition_type','=','New')->get();
            $data2=DB::table('product')->where('condition_type','=','Used')->get();
            $call=DB::table('product')->where('status','=','Active')->get();
            $cmen=DB::table('product') ->where("type","men")->where('status','=','Active')->get();

            $cat=DB::table('category')->get();
            $state=DB::table('state')->get();
            $search=$request->input('search');
            $sort=$request->input('myddl');

            $min = $request->input('wmin');  
            $max = $request->input('wmax');
            if($min=="")
            {
              $min=1;
            }
            if($max=="")
            {
                $max=500000;
            }
            $requestData = ['ptitle','price'];
           
            if($sort==2)
            {
                $woman=DB::table('product')
                ->join('product_image', 'product.id', '=', 'product_image.p_id')
                ->join('category','category.id','=','product.c_id')
                ->join('user','user.id','=','product.s_id')
                ->join('state','user.state','=','state.StateID')
                ->select('product.*','product_image.p_id','product_image.image','state.StateName','category.c_name')
                ->where(['user.type'=>'S'])
                ->where('product.status','=','Active')
                ->where("product.type","woman")
                // ->where('product.ptitle','LIKE','%'.$search.'%')
                ->whereBetween('product.price', array($min, $max))
                ->where(function($q) use($requestData, $search) {
                        foreach ($requestData as $field)
                           $q->orWhere($field, 'like', "%{$search}%");
                })
                ->orderBy('product.price','DESC')
                ->Paginate(5);
            }
            else
            {
                $woman=DB::table('product')
                ->join('product_image', 'product.id', '=', 'product_image.p_id')
                ->join('category','category.id','=','product.c_id')
                ->join('user','user.id','=','product.s_id')
                ->join('state','user.state','=','state.StateID')
                ->select('product.*','product_image.p_id','product_image.image','state.StateName','category.c_name')
                ->where(['user.type'=>'S'])
                ->where('product.status','=','Active')
                ->where("product.type","woman")
                // ->where('product.ptitle','LIKE','%'.$search.'%')
                ->whereBetween('product.price', array($min, $max))
                ->where(function($q) use($requestData, $search) {
                        foreach ($requestData as $field)
                           $q->orWhere($field, 'like', "%{$search}%");
                })
                ->orderBy('product.price','ASC')
                ->Paginate(5);
            }

            return view('seller.woman')->with(["woman"=>$woman,"cat"=>$cat,"sort"=>$sort,"state"=>$state,"call"=>$call,"cmen"=>$cmen,"data1"=>$data1,"data2"=>$data2,"search"=>$search,'min'=>$min,"max"=>$max]);
        }

}