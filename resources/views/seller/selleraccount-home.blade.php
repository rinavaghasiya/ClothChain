@extends('layout.seller.content')
@section('title')
Personal Home
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
                                    <h5 class="collapse-title no-border"> My Classified <a href="#MyClassified"  aria-expanded="true"  data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a></h5>

                                    <div class="panel-collapse collapse show" id="MyClassified">
                                        <ul class="acc-list">
                                            <li><a class="active" href="{{ url('selleraccounthome') }}"><i class="icon-home"></i>
                                                Personal Home </a></li>
                                            <li><a href="{{ url('sellerprofile') }}"><i class="icon-profile"></i> Profile </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="collapse-box">
                                    <h5 class="collapse-title"> My Ads <a href="#MyAds" aria-expanded="true"  data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a></h5>
                                    <div class="panel-collapse collapse show" id="MyAds">
                                        <ul class="acc-list">
                                            <li><a href="{{ url('accountmyads') }}"><i class="icon-docs"></i> My Ads <span
                                                    class="badge">{{count($myads)}}</span> </a></li>

                                             <li><a href="{{ url('addproduct') }}"><i
                                                    class="fa fa-product-hunt"></i> Post Ads <span
                                                    class="badge">{{count($postads)}}</span></a></li>

                                            <li><a href="{{ url('pendingapproval') }}"><i
                                                    class="icon-hourglass"></i> Pending approval <span
                                                    class="badge">{{count($pen)}}</span></a></li>

                                             <li><a href="{{ url('decline') }}"><i class="fa fa-ban" aria-hidden="true"></i> Decline Product <span
                                                    class="badge">{{count($decline)}}</span></a></li>
                                                    
                                            <li class=""><a href="{{ url('accountmessageinbox') }}"><i
                                                    class="icon-mail"></i> Message Inbox <span
                                                    class="badge">{{count($inbox)}}</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                 <div class="collapse-box">
                                    <h5 class="collapse-title"> Terminate Account <a href="#TerminateAccount" aria-expanded="true"  data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a></h5>
                                    <div class="panel-collapse collapse show" id="TerminateAccount">
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
                        <div class="row">
                            <div class="col-md-5 col-xs-4 col-xxs-12">
                                <h3 class="no-padding text-center-480 useradmin"><a href="#"><img class="userImg" src="public/images/user.jpg"  alt="user"> 
                                        {!! $list[0]->fname !!}  {!! $list[0]->lname !!}
                                </a></h3>
                            </div>
                            <div class="col-md-7 col-xs-8 col-xxs-12">
                                <div class="header-data text-center-xs">
                                    <div class="hdata">
                                        <div class="mcol-left">
                                            <i class="fas fa-envelope ln-shadow"></i></div>
                                        <div class="mcol-right">
                                            <p><a href="#">{{count($inbox)}}</a> <em>Mail</em></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                         <div class="hdata">
                                        <div class="mcol-left">
                                           <i class="icon-hourglass"></i></div>
                                        <div class="mcol-right">
                                            <p><a href="#">{{count($pen)}}</a> <em>Pendding</em></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                     <div class="hdata">
                                        <div class="mcol-left">
                                            <i class="icon-th-thumb ln-shadow"></i></div>
                                        <div class="mcol-right">
                                            <p><a href="#">{{count($myads)}}</a><em>Ads</em></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                    <div class="inner-box">
                        <div class="welcome-msg">
                            <h3 class="page-sub-header2 clearfix no-padding">Hello  {!! $list[0]->fname !!} {!! $list[0]->lname !!}</h3>
                       </div>
                        <div id="accordion" class="panel-group">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h4 class="card-title"><a href="#collapseB1" aria-expanded="true"  data-toggle="collapse" > My
                                        details </a></h4>
                                </div>
                                <div class="panel-collapse collapse show" id="collapseB1">
                                    <div class="card-body">

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
                                         
                                        <form class="form-horizontal" role="form" action = "{{ url('selleredit') }}" method ="post" enctype='multipart/form-data'>
                                        {{ csrf_field() }}
                                        <input type="hidden" id="id" class="form-control" name="id" value="{!! @$list[0]->id !!}" >

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">First Name</label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" placeholder="First Name" name="fname" id="fnm" value="{!! $list[0]->fname !!}" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Last name</label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" placeholder="Last Name" name="lname" id="lnm" value="{!! $list[0]->lname !!}" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Email</label>

                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control"
                                                           placeholder="Email" name="email" id="email"
                                                           value="{!! $list[0]->email !!}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Address</label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" placeholder="Address" name="address" id="address" value="{!! $list[0]->address !!}">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="Phone" class="col-sm-3 control-label">Phone</label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="phone" 
                                                           placeholder="Phone No" name="phone"
                                                           value="{!! $list[0]->phone !!}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Phone" class="col-sm-3 control-label">Profile Picture</label>

                                               <div>
                                                <img id="blah" src="{{ url('public/image') }}/{!! $list[0]->profile_image !!}" alt="" height="100" width="100" />
                                                <br><br><input type = 'file' id="imgInp" name="image" value="{!! $list[0]->profile_image !!}" />
      
                                                <input type="hidden"  name="oldimg" id="oldimg" value="{!! $list[0]->profile_image !!}">
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" id="btnupdate" name="submit" class="btn btn-default">Update</button>&nbsp;&nbsp;
                                                    <button type="reset" class="btn btn-danger">cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-default">
                                <div class="card-header">
                                    <h4 class="card-title"><a href="#collapseB2" aria-expanded="true"  data-toggle="collapse" > Settings </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseB2">
                                    <div class="card-body">
                                        <form class="form-horizontal" action = "{{ url('sellereditpass') }}"  method="post">
                                             {{ csrf_field() }}
                                             
                                            <input type="hidden" id="id" class="form-control" name="id" value="{!! @$list[0]->id !!}" >

                                             <div class="form-group">
                                                <label class="col-sm-3 control-label">Old Password</label>

                                                <div class="col-sm-9">
                                                    <input type="password" id="opass" name="opass" class="form-control" placeholder="Old Password">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">New Password</label>

                                                <div class="col-sm-9">
                                                    <input type="password" name="npass" id="npass" class="form-control" placeholder="New Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Confirm Password</label>

                                                <div class="col-sm-9">
                                                    <input type="password" name="cpass" id="cpass" class="form-control" placeholder="Confirm Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" name="submit" id="btnpassedit" class="btn btn-default">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-collapse collapse" id="collapseB3">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">
                                                        I want to receive newsletter. </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">
                                                        I want to receive advice on buying and selling. </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
</script>
@endsection