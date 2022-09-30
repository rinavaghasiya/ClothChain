 @extends('layout.seller.content')
 @section('title')
Seller FavouriteMessage
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
                                    <h5 class="collapse-title no-border"> My Classified <a class="pull-right" aria-expanded="true" data-toggle="collapse" href="#MyClassified"><i class="fa fa-angle-down"></i></a></h5>
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
                                    <h5 class="collapse-title"> My Ads <a class="pull-right" aria-expanded="true" data-toggle="collapse" href="#MyAds"><i class="fa fa-angle-down"></i></a>
                                    </h5>
                                    <div id="MyAds" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                            <li><a href="{{ url('accountmyads') }}"><i class="icon-docs"></i> My ads <span
                                                    class="badge">{{count($data1)}}</span> </a></li>
                                            
                                            <li><a href="{{ url('pendingapproval') }}"><i
                                                    class="icon-hourglass"></i> Pending approval <span
                                                    class="badge">{{count($data2)}}</span></a></li>

                                            <li><a href="{{ url('decline') }}"><i class="fa fa-ban" aria-hidden="true"></i> Decline Product <span
                                                    class="badge">{{count($decline)}}</span></a></li>
                                                    
                                            <li class="active"><a href="{{ url('accountmessageinbox') }}"><i
                                                    class="icon-mail"></i> Message Inbox <span
                                                    class="badge">15</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                 <div class="collapse-box">
                                    <h5 class="collapse-title"> Terminate Account
                                        <a class="pull-right"
                                           aria-expanded="true"
                                           data-toggle="collapse"
                                           href="#TerminateAccount"><i
                                                class="fa fa-angle-down"></i></a></h5>
                                    <div id="TerminateAccount" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                            <li><a href="{{ url('accountclose') }}"><i class="icon-cancel-circled "></i> Close
                                                account </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                             </div>
                        </div>
                       </aside>
                </div>
                 <div class="col-md-9 page-content">
                    <div class="inner-box">
                        <h2 class="title-2"><i class="icon-mail"></i> INBOX </h2>
                        <div class="inbox-wrapper">
                            <div class="row">
                              <div class="col-md-9 col-lg-10">
                                  <div class="btn-group hidden-sm">
                                       <form action="" method="get">
                                           
                                                <select id="fer" onchange='this.form.submit()' name="fer" title="All" class="form-control" class="dropdown-menu-sort-selected" data-style="btn-select" 
                                                        data-width="auto">
                                                  
                                                     <option value="0" @if($sort == 0) selected @endif> All
                                                    </option>
                                                    <option value="1" @if($sort == 1) selected @endif> Read
                                                    </option>
                                                    <option value="2" @if($sort == 2) selected @endif> UnRead
                                                    </option>
                                                    <p>detail</p>
                                                </select>
                                                 </form>
                                             </div>

                                    <button type="button" class="btn btn-secondary hidden-sm" data-toggle="tooltip"
                                            title="Refresh" onClick="refreshPage()"><span class="fas fa-sync-alt"></span>
                                    </button>

                                    <div class="btn-group hidden-sm">
                                       <ul class="dropdown-menu" role="menu">
                                            <li class="dropdown-item"><a class="markAllAsUnRead">Mark all as read</a>
                                            </li>
                                            <li class="dropdown-item"><a class="markAllAsRead">Mark all as unread</a>
                                            </li>
                                            <li class="divider dropdown-item"></li>
                                            <li class="text-center dropdown-item">
                                                <small class="text-muted">More actions</small>
                                            </li>
                                        </ul>
                                    </div>

                                   
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 col-lg-2">
                                    <ul class="nav nav-pills  inbox-nav">
                                        <li class="nav-item"><a  class="nav-link" href="{{ url('accountmessageinbox') }}"> Inbox
                                            <span class="badge badge-gray count">{{count($inbox)}}</span></a>
                                        </li>
                                        <li class="nav-item"><a  class="nav-link" href="{{ url('draftmessage') }}">Drafts <span
                                                class="badge badge-gray count">{{count($draft)}}</span></a>
                                        </li>
                                        <strong><li class="active nav-item"><a  class="nav-link" href="{{ url('favourite') }}">Starred</a>
                                        </li></strong>
                                    
                                        <li class="nav-item"><a  class="nav-link" href="{{ url('important') }}">Important</a>
                                        </li>
                                        <li class="nav-item"><a  class="nav-link" href="{{ url('sendmailseller') }}">Sent
                                            Mail</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="col-md-9 col-lg-10">
                                    <div class="message-list">
                                        <div id="home">
                                              <form role="form" action="" method="get" enctype="multipart/form-data">
                                            <div class="list-group">
                                             
                                             
                                                    @foreach($data as $msg)
                                                    @if($msg->sellerread_status == '0' && $msg->sellerfavourite_status == "Favourite" )
                                                  <div class="list-group-item">    
                                                        <a href="{{ url('sellermessagedetail') }}/{{$msg->id}}" class="list-box-user">

                                                          @if($msg->receiver_id == ($msg->type == 'B'))
                                                            

                                                             <img class="thumbnail no-margin" src="{{ url('public/image') }}/{{ $msg->buyer2_img }}" alt="img" height="30px" width="30px">

                                                             <strong> <span class="name"> {{$msg->buyer1_nm}}  {{$msg->buyer1_lnm}}
                                                         </span></strong>
                                                         @else
                                                              <img class="thumbnail no-margin" src="{{ url('public/image') }}/{{ $msg->buyer1_img }}" alt="img" height="30px" width="30px">

                                                              <strong> <span class="name"> {{$msg->buyer2_nm}}  {{$msg->buyer2_lnm}}
                                                         </span></strong>
                                                         @endif
                                                        </a>
                                                    <br>
                                                    <a href="{{ url('sellermessagedetail') }}/{{$msg->id}}" class="list-box-content">
                                                        <br>
                                                       <div class="message-text  ">
                                                         @if($msg->files!="")

                                                          @php $b = explode(",",$msg->files); @endphp
                                                         <p>{{$msg->message}}</p>
                                                            @foreach($b as $photo)
                                                          <img class="thumbnail no-margin" src="{{ url('public/image') }}/{{ $photo }}" alt="img" height="90px" width="90px">
                                                            @endforeach 
                                                        @else
                                                             <p> {{$msg->message}}</p>
                                                        @endif
                                                       
                                                        </div>
                                                        <div class="time text-muted">{{$msg->created_at}}</div>
                                                    </a>
                                                    <div class="list-box-action">
                                                          @if($msg->sellerfavourite_status == "Favourite")
                                                        <a  href="{{ url('unfavouritemail') }}/{{$msg->id}}"data-toggle="tooltip" data-placement="top" class="markAsStar" value=""
                                                           title="Mark as Favourite "><i class="fas fa-star"></i></a>
                                                        @endif

                                                        <a href="{{ url('sellerdelete') }}/{{$msg->id}}" data-toggle="tooltip" data-placement="top" title="Delete ">
                                                            <i class=" fas fa-trash"></i></a>


                                                         @if($msg->sellerimportant_status == "Important")
                                                        <a href="{{ url('importantemail') }}/{{$msg->id}}" class="markAsCircle" data-toggle="tooltip" data-placement="top" value="" name='important'
                                                           title="Mark as Important "> <i class="fas fa-circle"></i></a>
                                                        @else
                                                        <a href="{{ url('importantemail') }}/{{$msg->id}}" class="markAsCircle" data-toggle="tooltip" data-placement="top" value="Important" name='important'
                                                           title="Mark as Important "> <i class="far fa-circle"></i></a>
                                                        @endif
                                                    </div>
                                                </div>
                                                @elseif($msg->sellerread_status == '1' && $msg->sellerfavourite_status == "Favourite" )
                                                <div class="list-group-item">
                                                    <a href="{{ url('sellermessagedetail') }}/{{$msg->id}}" class="list-box-user">

                                                        @if($msg->receiver_id == ($msg->type == 'B'))
                                                        <img class="thumbnail no-margin" src="{{ url('public/image') }}/{{ $msg->buyer2_img }}" alt="img" height="30px" width="30px"> 
                                        
                                                        <span class="name">{{$msg->buyer1_nm}} {{$msg->buyer1_lnm}} </span>
                                                    
                                                       @else
                                                        <img class="thumbnail no-margin" src="{{ url('public/image') }}/{{ $msg->buyer1_img }}" alt="img" height="30px" width="30px"> 
                                        
                                                        <span class="name">{{$msg->buyer2_nm}} {{$msg->buyer2_lnm}} </span>
                                                    
                                                    @endif
                                                </a>
                                                <br>

                                                    <a href="{{ url('sellermessagedetail') }}/{{$msg->id}}" class="list-box-content">
                                                        <br>
                                                         <div class="message-text  ">
                                                            @if($msg->files!="")

                                                          @php $b = explode(",",$msg->files); @endphp
                                                         <p>{{$msg->message}}</p>
                                                          @foreach($b as $photo)
                                                          <img class="thumbnail no-margin" src="{{ url('public/image') }}/{{ $photo }}" alt="img" height="90px" width="90px">
                                                           @endforeach
                                                        @else
                                                             <p> {{$msg->message}}</p>
                                                        @endif
                                                       
                                                        </div>
                                                        <div class="time text-muted">{{$msg->created_at}}</div>
                                                    </a>
                                                    <div class="list-box-action">
                                                        @if($msg->sellerfavourite_status == "Favourite")
                                                        <a  href="{{ url('unfavouritemail') }}/{{$msg->id}}"data-toggle="tooltip" data-placement="top" class="markAsStar" value=""
                                                           title="Mark as Favourite "><i class="fas fa-star"></i></a>
                                                        @endif

                                                        <a href="{{ url('sellerdelete') }}/{{$msg->id}}" data-toggle="tooltip" data-placement="top" title="Delete ">
                                                            <i class=" fas fa-trash"></i></a>

                                                            @if($msg->sellerimportant_status == "Important")
                                                        <a href="{{ url('importantemail') }}/{{$msg->id}}" class="markAsCircle" data-toggle="tooltip" data-placement="top" value="" name='important'
                                                           title="Mark as Important "> <i class="fas fa-circle"></i></a>
                                                        @else
                                                        <a href="{{ url('importantemail') }}/{{$msg->id}}" class="markAsCircle" data-toggle="tooltip" data-placement="top" value="Important" name='important'
                                                           title="Mark as Important "> <i class="far fa-circle"></i></a>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                            </form>

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
     </div>
<script>
function refreshPage(){
    window.location.reload();
} 
</script>
@endsection