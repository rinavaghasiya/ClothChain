<?php

namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SubCategoryController extends Controller
{
     public function index($subcategory,Request $request)
    {
    	
      $data1=DB::table('product')->where('condition_type','=','New')->get();
      $data2=DB::table('product')->where('condition_type','=','Used')->get();
      $state=DB::table('state')->get();
      $cat=DB::table('category')->get();
      $cmen=DB::table('product') ->where("type","men")->where('status','=','Active')->get();
      $cwoman=DB::table('product') ->where("type","woman")->where('status','=','Active')->get();

      $search=$request->input('search');
      $sort=$request->input('myddl');
      $requestData = ['ptitle','price'];

     $min = $request->input('min');  
     $max = $request->input('max');

     if($min=="")
      {
        $min=0;
      }
      if($max=="")
      {
        $max=500000;
      }
   
    if($sort==2)
    {
       $data =DB::table('category')
        ->join('product', 'category.id', '=', 'product.c_id')
        ->join('product_image', 'product_image.p_id', '=', 'product.id')
         ->join('user','product.s_id','=','user.id')
        ->join('state','user.state', '=', 'state.StateID')
         ->where(['user.type'=>'S'])
        ->where('product.status','=','Active')
        ->where('category.c_name','=',$subcategory)
        ->whereBetween('product.price', array($min, $max))
        ->where(function($q) use($requestData, $search) {
                        foreach ($requestData as $field)
                           $q->orWhere($field, 'like', "%{$search}%");
                })
        ->select('category.c_name','product.*','product_image.*','state.StateName')

        ->orderBy('product.price','DESC')
        ->paginate(5);
    }
    else
    {
       $data =DB::table('category')
        ->join('product', 'category.id', '=', 'product.c_id')
        ->join('product_image', 'product_image.p_id', '=', 'product.id')
        ->join('user','product.s_id','=','user.id')
        ->join('state','user.state', '=', 'state.StateID')
         ->where(['user.type'=>'S'])
        ->where('product.status','=','Active')
        ->where('category.c_name','=',$subcategory)
        
        ->whereBetween('product.price', array($min, $max))
        ->where(function($q) use($requestData, $search) {
                      foreach ($requestData as $field)
                         $q->orWhere($field, 'like', "%{$search}%");
              })
        ->select('category.c_name','product.*','product_image.*','state.StateName')
        ->orderBy('product.price','ASC')
        ->paginate(5);
    }

     
    return view('seller.subcategory')->with(['data'=>$data,"cat"=>$cat,"sort"=>$sort,"state"=>$state,'data1'=>$data1,'data2'=>$data2,'cmen'=>$cmen,'cwoman'=>$cwoman,"search"=>$search,'min'=>$min,"max"=>$max]);
    }

    public function mensubcatindex($mensubcategory,Request  $request  )
    {
       
      $data1=DB::table('product')->where('condition_type','=','New')->get();
      $data2=DB::table('product')->where('condition_type','=','Used')->get();
      $cat=DB::table('category')->get();
      $state=DB::table('state')->get();
      $call=DB::table('product')->get()->where('status','=','Active');
      $cwoman=DB::table('product') ->where("type","woman")->where('status','=','Active')->get();

      $search=$request->input('search');
      $sort=$request->input('myddl');

      $min = $request->input('mmin');  
      $max = $request->input('mmax');
      $requestData = ['ptitle','price'];
      if($min=="")
      {
        $min=0;
       }
       if($max=="")
       {
        $max=500000;
       }
     if($sort==2)
      {
        $men =DB::table('category')
         ->join('product', 'category.id', '=', 'product.c_id')
         ->join('product_image', 'product_image.p_id', '=', 'product.id')
         ->join('user','product.s_id','=','user.id')
          ->join('state','user.state', '=', 'state.StateID')
          ->where(['user.type'=>'S'])
         ->where("product.type","men")
         ->where('category.c_name','=',$mensubcategory)
         
         ->where('product.status','=','Active')
         ->whereBetween('product.price', array($min, $max))
         ->where(function($q) use($requestData, $search) {
            foreach ($requestData as $field)
               $q->orWhere($field, 'like', "%{$search}%");
          })
         ->select('category.c_name','product.*','product_image.p_id','product_image.*','state.StateName')
         ->orderBy('product.price','DESC')
         ->paginate(5);
      }
     else
      {
        $men =DB::table('category')
        ->join('product', 'category.id', '=', 'product.c_id')
        ->join('product_image', 'product_image.p_id', '=', 'product.id')
         ->join('user','product.s_id','=','user.id')
        ->join('state','user.state', '=', 'state.StateID')
        ->where(['user.type'=>'S'])
        ->where("product.type","men")
        ->where('category.c_name','=',$mensubcategory)
        
        ->where('product.status','=','Active')
        ->whereBetween('product.price', array($min, $max))
        ->where(function($q) use($requestData, $search) {
          foreach ($requestData as $field)
             $q->orWhere($field, 'like', "%{$search}%");
        })
        ->select('category.c_name','product.*','product_image.p_id','product_image.*','state.StateName')
        ->orderBy('product.price','ASC')
        ->paginate(5);
      }
     return view('seller.men_subcategory')->with(["men"=>$men,"cat"=>$cat,"sort"=>$sort,"state"=>$state,'data1'=>$data1,'data2'=>$data2,'call'=>$call,'cwoman'=>$cwoman,"search"=>$search,'min'=>$min,"max"=>$max]);
    }


    public function womansubcatindex($womansubcategory,Request  $request  )
    {
        
      $data1=DB::table('product')->where('condition_type','=','New')->get();
      $data2=DB::table('product')->where('condition_type','=','Used')->get();
      $cat=DB::table('category')->get();
      $state=DB::table('state')->get();
      $call=DB::table('product')->get()->where('status','=','Active');
      $cmen=DB::table('product') ->where("type","men")->where('status','=','Active')->get();

      $search=$request->input('search');
      $sort=$request->input('myddl');
      $min = $request->input('wmin');  
      $max = $request->input('wmax');
      $requestData = ['ptitle','price'];
      if($min=="")
      {
        $min=0;
      }
      if($max=="")
      {
        $max=500000;
      }
     if($sort==2)
        {
           $woman =DB::table('category')
            ->join('product', 'category.id', '=', 'product.c_id')
            ->join('product_image', 'product_image.p_id', '=', 'product.id')
             ->join('user','product.s_id','=','user.id')
            ->join('state','user.state', '=', 'state.StateID')
             ->where(['user.type'=>'S'])
            ->where('product.status','=','Active')
            ->where("product.type","woman")
            
            ->where('category.c_name','=',$womansubcategory)
            ->whereBetween('product.price', array($min, $max))
            ->where(function($q) use($requestData, $search) {
                      foreach ($requestData as $field)
                         $q->orWhere($field, 'like', "%{$search}%");
              })
            ->select('category.c_name','product.*','product_image.p_id','product_image.image','state.StateName')
            ->orderBy('product.price','DESC')
           ->paginate(5);
        }
        else
        {
         $woman =DB::table('category')
          ->join('product', 'category.id', '=', 'product.c_id')
          ->join('product_image', 'product_image.p_id', '=', 'product.id')
           ->join('user','product.s_id','=','user.id')
          ->join('state','user.state', '=', 'state.StateID')
           ->where(['user.type'=>'S'])
          ->where('product.status','=','Active')
          ->where("product.type","woman")
          
          ->where('category.c_name','=',$womansubcategory)
          ->whereBetween('product.price', array($min, $max))
          ->where(function($q) use($requestData, $search) {
                  foreach ($requestData as $field)
                     $q->orWhere($field, 'like', "%{$search}%");
          })
          ->select('category.c_name','product.*','product_image.p_id','product_image.image','state.StateName')
          ->orderBy('product.price','ASC')
         ->paginate(5);
        }
        return view('seller.woman_subcategory')->with(["woman"=>$woman,"cat"=>$cat,"sort"=>$sort,"state"=>$state,'data1'=>$data1,'data2'=>$data2,'call'=>$call,'cmen'=>$cmen,"search"=>$search,'min'=>$min,"max"=>$max]);
    }

   
   public function stateindex($statenm,Request $request)
    {
      
      $data1=DB::table('product')->where('condition_type','=','New')->get();
      $data2=DB::table('product')->where('condition_type','=','Used')->get();
      $state=DB::table('state')->get();
      $cat=DB::table('category')->get();
      $cmen=DB::table('product') ->where("type","men")->where('status','=','Active')->get();
      $cwoman=DB::table('product') ->where("type","woman")->where('status','=','Active')->get();

      $search=$request->input('search');
      $sort=$request->input('myddl');
       $requestData = ['ptitle','price'];

     $min = $request->input('min');  
     $max = $request->input('max');

     if($min=="")
      {
        $min=0;

       }
       if($max=="")
       {
        $max=500000;

       }
   
   if($sort==2)
    {
       $data =DB::table('category')
        ->join('product', 'category.id', '=', 'product.c_id')
        ->join('product_image', 'product_image.p_id', '=', 'product.id')
        ->join('user','product.s_id','=','user.id')
        ->join('state','user.state', '=', 'state.StateID')
         ->where(['user.type'=>'S'])
        ->where('product.status','=','Active')
        ->where('state.StateName','=',$statenm)
        
        ->whereBetween('product.price', array($min, $max))
         ->where(function($q) use($requestData, $search) {
                        foreach ($requestData as $field)
                           $q->orWhere($field, 'like', "%{$search}%");
                })
        ->select('category.c_name','state.StateName','product.*','product_image.*')
        ->orderBy('product.price','DESC')
        ->paginate(5);
    }
    else
    {
       $data =DB::table('category')
        ->join('product', 'category.id', '=', 'product.c_id')
        ->join('product_image', 'product_image.p_id', '=', 'product.id')
        ->join('user','product.s_id','=','user.id')
        ->join('state','user.state', '=', 'state.StateID')
         ->where(['user.type'=>'S'])
        ->where('product.status','=','Active')
        ->where('state.StateName','=',$statenm)
        
        ->whereBetween('product.price', array($min, $max))
         ->where(function($q) use($requestData, $search) {
                        foreach ($requestData as $field)
                           $q->orWhere($field, 'like', "%{$search}%");
                })
        ->select('category.c_name','state.StateName','product.*','product_image.*')
        ->orderBy('product.price','ASC')
        ->paginate(5);
    }

     
    return view('seller.subcategory')->with(['data'=>$data,"cat"=>$cat,"sort"=>$sort,"state"=>$state,'data1'=>$data1,'data2'=>$data2,'cmen'=>$cmen,'cwoman'=>$cwoman,"search"=>$search,'min'=>$min,"max"=>$max]);
    }

public function menstateindex($menstatenm,Request  $request  )
    {
       
      $data1=DB::table('product')->where('condition_type','=','New')->get();
      $data2=DB::table('product')->where('condition_type','=','Used')->get();
      $cat=DB::table('category')->get();
      $state=DB::table('state')->get();
      $call=DB::table('product')->get()->where('status','=','Active');
      $cwoman=DB::table('product') ->where("type","woman")->where('status','=','Active')->get();

      $search=$request->input('search');
      $sort=$request->input('myddl');

      $min = $request->input('mmin');  
      $max = $request->input('mmax');
      $requestData = ['ptitle','price'];
      if($min=="")
        {
        $min=0;

       }
       if($max=="")
       {
        $max=500000;
       }
        if($sort==2)
        {
         $men =DB::table('category')
          ->join('product', 'category.id', '=', 'product.c_id')
          ->join('product_image', 'product_image.p_id', '=', 'product.id')
          ->join('user','product.s_id','=','user.id')
          ->join('state','user.state', '=', 'state.StateID')
           ->where(['user.type'=>'S'])
          ->where("product.type","men")
         
            ->where('state.StateName','=',$menstatenm)
          ->where('product.status','=','Active')
          ->whereBetween('product.price', array($min, $max))
          ->where(function($q) use($requestData, $search) {
            foreach ($requestData as $field)
               $q->orWhere($field, 'like', "%{$search}%");
          })
          ->select('category.c_name','product.*','product_image.p_id','product_image.*','state.StateName')
          ->orderBy('product.price','DESC')
          ->paginate(5);
        }
        else
        {
            $men =DB::table('category')
            ->join('product', 'category.id', '=', 'product.c_id')
            ->join('product_image', 'product_image.p_id', '=', 'product.id')
            ->join('user','product.s_id','=','user.id')
            ->join('state','user.state', '=', 'state.StateID')
             ->where(['user.type'=>'S'])
            ->where("product.type","men")
           
              ->where('state.StateName','=',$menstatenm)
            ->where('product.status','=','Active')
            ->whereBetween('product.price', array($min, $max))
            ->where(function($q) use($requestData, $search) {
              foreach ($requestData as $field)
                 $q->orWhere($field, 'like', "%{$search}%");
            })
            ->select('category.c_name','product.*','product_image.p_id','product_image.*','state.StateName')
            ->orderBy('product.price','ASC')
            ->paginate(5);
        }
        return view('seller.men_subcategory')->with(["men"=>$men,"cat"=>$cat,"sort"=>$sort,"state"=>$state,'data1'=>$data1,'data2'=>$data2,'call'=>$call,'cwoman'=>$cwoman,"search"=>$search,'min'=>$min,"max"=>$max]);
    }
    public function womanstateindex($womanstatenm,Request  $request  )
    {
        
      $data1=DB::table('product')->where('condition_type','=','New')->get();
      $data2=DB::table('product')->where('condition_type','=','Used')->get();
      $cat=DB::table('category')->get();
      $state=DB::table('state')->get();
      $call=DB::table('product')->get()->where('status','=','Active');
      $cmen=DB::table('product') ->where("type","men")->where('status','=','Active')->get();

       $search=$request->input('search');
         $sort=$request->input('myddl');

         $min = $request->input('wmin');  
         $max = $request->input('wmax');
         $requestData = ['ptitle','price'];
       if($min=="")
       {
        $min=0;

       }
       if($max=="")
       {
        $max=500000;
       }
         if($sort==2)
        {
           $woman =DB::table('category')
            ->join('product', 'category.id', '=', 'product.c_id')
            ->join('product_image', 'product_image.p_id', '=', 'product.id')
            ->join('user','product.s_id','=','user.id')
            ->join('state','user.state', '=', 'state.StateID')
             ->where(['user.type'=>'S'])
            ->where('product.status','=','Active')
            ->where("product.type","woman")
            
            ->where('state.StateName','=',$womanstatenm)
            ->whereBetween('product.price', array($min, $max))
            ->where(function($q) use($requestData, $search) {
                      foreach ($requestData as $field)
                         $q->orWhere($field, 'like', "%{$search}%");
              })
            ->select('category.c_name','product.*','state.StateName','product_image.p_id','product_image.image')
            ->orderBy('product.price','DESC')
           ->paginate(5);
        }
        else
        {
              $woman =DB::table('category')
            ->join('product', 'category.id', '=', 'product.c_id')
            ->join('product_image', 'product_image.p_id', '=', 'product.id')
            ->join('user','product.s_id','=','user.id')
            ->join('state','user.state', '=', 'state.StateID')
             ->where(['user.type'=>'S'])
            ->where('product.status','=','Active')
            ->where("product.type","woman")
            
            ->where('state.StateName','=',$womanstatenm)
            ->whereBetween('product.price', array($min, $max))
            ->where(function($q) use($requestData, $search) {
                      foreach ($requestData as $field)
                         $q->orWhere($field, 'like', "%{$search}%");
              })
            ->select('category.c_name','product.*','state.StateName','product_image.p_id','product_image.image')
            ->orderBy('product.price','ASC')
           ->paginate(5);
        }
       return view('seller.woman_subcategory')->with(["woman"=>$woman,"cat"=>$cat,"sort"=>$sort,"state"=>$state,'data1'=>$data1,'data2'=>$data2,'call'=>$call,'cmen'=>$cmen,"search"=>$search,'min'=>$min,"max"=>$max]);
    }


}
