@extends('layout.seller.content')
@section('title')
Edit PostAds
@endsection
@section('content')

<div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-3 page-sidebar">
                    <aside>
                        <div class="inner-box">
                            <div class="user-panel-sidebar">
                                <div class="collapse-box">
                                    <h5 class="collapse-title no-border"> My Classified <a class="pull-right"      
                                     href="#MyClassified"><i  class="fa fa-angle-down"></i></a></h5>
                                   
                                    <div id="MyClassified" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                            <li><a href="{{ url('selleraccounthome') }}"><i class="icon-home"></i> Personal Home </a>
                                            </li>
                                             <li><a href="{{ url('sellerprofile') }}"><i class="fas fa-user"></i> Profile </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="collapse-box">
                                    <h5 class="collapse-title"> My Ads <a class="pull-right" aria-expanded="true"  data-toggle="collapse" href="#MyAds"><i class="fa fa-angle-down"></i></a>
                                    </h5>

                                    <div id="MyAds" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                            <li class="active"><a href="{{ url('accountmyads') }}"><i class="icon-docs"></i> My ads <span
                                                    class="badge">{{count($data2)}}</span> </a></li>

                                            <li><a href="{{ url('addproduct') }}"><i
                                                    class="icon-hourglass"></i> Post Ads <span
                                                    class="badge">{{count($data1)}}</span></a></li>
                                            
                                            <li><a href="{{ url('pendingapproval') }}"><i
                                                    class="icon-hourglass"></i> Pending approval <span
                                                    class="badge">{{count($pen)}}</span></a></li>
                                                    
                                            <li><a href="{{ url('decline') }}"><i class="fa fa-ban" aria-hidden="true"></i> Decline Product <span
                                                    class="badge">{{count($decline)}}</span></a></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="collapse-box">
                                    <h5 class="collapse-title"> Terminate Account <a class="pull-right" aria-expanded="true"  data-toggle="collapse" href="#TerminateAccount"><i class="fa fa-angle-down"></i></a></h5>

                                    <div id="TerminateAccount" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                            <li><a href="{{ url('accountclose') }}"><i class="icon-cancel-circled "></i> Close
                                                account </a></li>
                                        </ul>
                                    </div>
                                </div>
                               </div>
                        </div>
                       </aside>
                </div>
                <div class="col-md-9 page-content">
                    <div class="inner-box">
                        <h2 class="title-2"> Edit Post Ads </h2>


<div class="card-body login-card-body">
      @if(Session::has('message'))
        <div class="alert alert-success">
            <i class="fa-lg fa fa-warning"></i>
            {!! session('message') !!}
        </div>
        @elseif(Session::has('error'))
        <div class="alert alert-danger">
            <i class="fa-lg fa fa-warning"></i>
            {!! session('error') !!}
        </div>
        @endif

       <form class="form-horizontal" action = "{{ url('editmyads') }}"  method="post" enctype='multipart/form-data' >
          {{ csrf_field() }}
      <div class="form-group row">
         <input type="hidden" class="form-control" name="id" id="id" value="{{ $data->id }}">
        <input type="hidden" class="form-control" name="pid" id="pid" value="{{ $data->p_id }}">
      <label class="col-sm-3 col-form-label">Ads Title</label>

      <div class="col-sm-8">
      <input type='text' class="form-control" id="ptitle" name='ptitle' value="{{$data->ptitle}}" /></div>
      </div>
     <div class="form-group row">
      <label class="col-sm-3 col-form-label">Description </label>
      <div class="col-sm-8">
      <input type='text' class="form-control" id="description" rows="3" name='description' value="{{$data->description}}"/></div>
      </div>
      <div class="form-group row">
      <label class="col-sm-3 col-form-label">Price </label>
      <div class="col-sm-8">
      <input type='text' class="form-control" id="price" name='price' onkeypress="return isNumber(event)"  value="{{$data->price}}" /><p id="Price_validate"></p></div>
      </div>
       @php $a = explode(",",$data->image); @endphp
      <div class="form-group row">
      <label class="col-sm-3 col-form-label">Photos</label>
     <div class="col-sm-8">
      @foreach($a as $b)<img id="blah" src="{{ url('public/image') }}/{{ $b }}" alt="" height="100" width="100" /> @endforeach
                 <br><br>
      <input class="file" data-preview-file-type="text" type = 'file' id="imgInp" name="image[]" value ="{{$data->image}}" multiple="multiple"/>
                  
    <input type="hidden" name="oldimg" id="oldimg" value="{{ $data->image }}">            
    </div><br><br>
    <div id="image_preview"></div>
    </div>
     <button type="submit" class="btn btn-primary">Save</button> <button type="reset" class="btn btn-danger">cancel</button>
   </div></center>
   </div>
    </div>
      </div>
        </div>
           </div>
     </div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type ="text/javascript">

   function readURL(input) 
   {
  if (input.files && input.files[0]) 
  {
    var reader = new FileReader();
    
    reader.onload = function(e)
     {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});

$("#image").change(function(){

     $('#image_preview').html("");

     var total_file=document.getElementById("image").files.length;

     for(var i=0;i<total_file;i++)

     {

      $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"' height='60' width='60' >");

     }

  });

  $('form').ajaxForm(function() 

   {

    alert("Uploaded SuccessFully");

   }); 


function check_price()
{

   var price = $("#price").val();

   if(price !== '')
   {

      if(price.length<=0)
      {
      document.getElementById('Price_validate').innerHTML = "<font color=red>Price Must be Grater than 0 </font>";
      $("#price").css("border","1px solid red");
      error_mobile = true;
      }
       else
       {
       document.getElementById('Price_validate').innerHTML = "<font color=green></font>";
       $("#price").css("border","1px solid lightblue");
       error_mobile = false;
       }
    }
    else
    {
       document.getElementById('Price_validate').innerHTML = "<font color=red>Please Enter Price!</font>";
       $("#price").css("border","1px solid red");
       error_mobile = true;
    }
}

  function isNumber(evt)
{
   evt = (evt) ? evt : window.event;
   var charCode = (evt.which) ? evt.which : evt.keyCode;
   if (charCode > 31 && (charCode < 48 || charCode > 57)) 
   {
      return false;
   }
   return true;
}
$("#price").focusout(function()
   {
    check_price();
   });


</script>
@endsection