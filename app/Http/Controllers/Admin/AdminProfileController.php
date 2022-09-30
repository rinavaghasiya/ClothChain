<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;

class AdminProfileController extends Controller
{
     public function index()
    {
    	$id = Session::get("admin_id");
      $a = DB::table("admin")->where("id",$id)->first();
      return view('Admin.profile')->with(["a"=>$a]);
    }

    public function profileupdate(Request $request)
  {
      $id = Session::get("admin_id");
      $a = DB::table('admin')->where('id',$id)->first();
     	$data = $request->all();
      if($data['name']!='' && $data['email']!='' )
      {

      if(@$data['image']!='')
      {
          $name = $data['image']->getClientOriginalName();
          $t=time().$name;
          $img = explode(".",$name);
          if($img [1] =='png' ||  $img [1] == "jpg" ||  $img [1] =="jpeg")
          {
              $data['image']->move(base_path('public\image'),$t );

              $list= DB::table('admin')->where('id',$id)->update(["name"=>$data['name'],"email"=>$data['email'],"profile_image"=>$t]);

               $nm = DB::table('admin')->where("id",$list)->get()->toArray();
               $dd=$nm[0]->name;
                      // echo "<pre>";
                      //  print_r($list);
                      // print_r($nm);
                      // die();
          		  $photo = $request->input('oldimg');

                Session::put('admin_profile_image',$t);
              if($photo!='')
              {
                if(file_exists('public/image/'.$photo))
                {
                  unlink('public/image/'.$photo);
                }
                session::put('admin_name',$dd);
               return redirect()->back()->with('message','Update Successfully');
      	      }
          }  
          else
          {
               return redirect()->back()->with('error','Invalid Image Type');
          } 
       }
       else
       {
          $list= DB::table('admin')->where('id',$id)->update(["name"=>$data['name'],"email"=>$data['email']]);

           $nm = DB::table('admin')->where("id",$list)->get()->toArray();
               $dd=$nm[0]->name;
                      //  echo "<pre>";
                      // //  print_r($list);
                      // print_r($nm);
                      //  print_r($dd);
                      // die();
       }
       session::put('admin_name',$dd);
      return redirect()->back()->with('message','Update Successfully');
    }
    else
    {
      return redirect()->back()->with('error','Please Fill All The Fileds');
    }
  }
}
