@extends('layout.seller.content')
@section('title')
PostAds
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
                                    <h5 class="collapse-title no-border"> My Classified <a class="pull-right" aria-expanded="true"  data-toggle="collapse" href="#MyClassified"><i class="fa fa-angle-down"></i></a></h5>
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
                                            <li><a href="{{ url('accountmyads') }}"><i class="icon-docs"></i> My ads <span class="badge">{{count($data1)}}</span> </a></li>

                                             <li class="active"><a href="{{ url('addproduct') }}"><i
                                                    class="fa fa-product-hunt"></i> Post Ads <span
                                                    class="badge">{{count($data3)}}</span></a></li>

                                           <li><a href="{{ url('pendingapproval') }}"><i
                                                    class="icon-hourglass"></i> Pending approval <span
                                                    class="badge">{{count($data2)}}</span></a></li>

                                            <li><a href="{{ url('decline') }}"><i class="fa fa-ban" aria-hidden="true"></i> Decline Product <span
                                                    class="badge">{{count($decline)}}</span></a></li>

                                            <li><a href="{{ url('accountmessageinbox') }}"><i
                                                    class="icon-mail"></i> Message Inbox <span
                                                    class="badge">{{count($inbox)}}</span></a></li>
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
                    <div class="inner-box category-content">
                        <h2 class="title-2 uppercase"><strong> <i class="icon-docs"></i> Post a Free Classified
                            Ad</strong></h2>

                        <div class="row">
                            <div class="col-sm-12">
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
                                <form class="form-horizontal" action="{{url('addproduct')}}" method='post' enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Category</label>
                                        <div class="col-sm-8">
                                            <select name="category" id="category" class="form-control">
                                                <option value="0" selected="selected"> Select a category...</option>
                                                @foreach($data as $items_each)
                                                <option value="{!! $items_each->id !!}">{!! $items_each->c_name !!}</option>@endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Add Type</label>
                                        <div class="col-sm-8">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="type" id="men" value="men"> Men
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="type" id="woman" value="woman"> Woman
                                                </label>
                                            </div>
                                             </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Ad title</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="ptitle" id="ptitle" placeholder="Ad title">
                                           
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Describe ad</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="describe" id="describ" rows="3" placeholder="Describe what makes your ad unique"></textarea>

                                        </div>
                                    </div>
                                         <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Condition</label>
                                        <div class="col-sm-8">
                                            <select name="condition" id="condition" class="form-control">
                                                <option value="0" selected="selected"> Select a condition...</option>
                                                <option value="New"> New </option>
                                                <option value="Used"> Used </option>


                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Price</label>

                                        <div class="input-group col-sm-6">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs.</span>
                                            </div>
                                            <input type="text" name="price" id="price" class="form-control" onkeypress="return isNumber(event)" 
                                            aria-label="Amount "><p id="Price_validate"></p>
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="textarea">Picture</label>
                                        <div class="col-lg-8">
                                            <div class="mb10">
                                                <input  type="file" name="image[]" id="image" class="file" data-preview-file-type="text" multiple="multiple">
                                            </div>
                                            <div id="image_preview"></div>
                                            <p class="form-text text-muted">
                                                
                                                Add up to 5 photos. Use a real image of your product, not catalogs
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-8">
                                          <center>
                                          <button type="Submit" id="button1id" class="btn btn-success btn-lg">Submit</button>
                                        &nbsp;<button type="reset" class="btn btn-danger">cancel</button>
                                      </center>
                                      </div>
                                  </div>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
         </div>
      </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>


<script type="text/javascript">



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