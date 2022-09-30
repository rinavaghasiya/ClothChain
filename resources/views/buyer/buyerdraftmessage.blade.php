 @extends('layout.seller.content')
 @section('title')
Buyer DraftMessage
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
                                    <h5 class="collapse-title no-border"> My Classified <a class="pull-right" aria-expanded="true" data-toggle="collapse" href="#MyClassified"><i
                                            class="fa fa-angle-down"></i></a></h5>
                                    @if(Session::has('user_id1'))
                                    <div id="MyClassified" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                            <li><a href="{{ url('accounthome') }}"><i class="icon-home"></i> Personal Home </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="collapse-box">
                                    <h5 class="collapse-title"> Message Inbox <a class="pull-right" aria-expanded="true" data-toggle="collapse" href="#MyAds"><i class="fa fa-angle-down"></i></a>
                                    </h5>
                                    <div id="MyAds" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                           
                                            <li class="active"><a href="{{ url('accountmessagebinbox') }}"><i
                                                    class="icon-mail"></i> Message  <span
                                                    class="badge">15</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @else
                                <div id="MyClassified" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                            <li><a href="{{ url('accounthome') }}"><i class="icon-home"></i> Personal Home </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                 <div class="collapse-box">
                                    <h5 class="collapse-title"> My Ads <a href="#MyAds" aria-expanded="true"  data-toggle="collapse"
                                                                          class="pull-right"><i
                                            class="fa fa-angle-down"></i></a></h5>

                                    <div class="panel-collapse collapse show" id="MyAds">
                                        <ul class="acc-list">
                                           <li class=""><a href="{{ url('accountmessageinbox') }}"><i
                                                    class="icon-mail"></i> Message Inbox <span
                                                    class="badge">15</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @endif
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

                                     @if(count($data)<0)
                                     <div class="message-tool-bar-right pull-right" id="cc" style="display: none;">
                                        <span class="text-muted count-message"><b> 
                                            {{($data->currentpage()-1)*$data->perpage()+1}} - {{ $data->lastItem() }} of   {{$data->total()}} 
                                            </b></span>
                                        <div
                                                class="btn-group btn-group-sm">
                                                <a   href="{{ $data->previousPageUrl() }}">
                                            <button type="button" class="btn btn-secondary"><span
                                                    class="fas fa-arrow-left"></span>
                                            </button></a>
                                            <a   href="{{ $data->nextPageUrl() }}">
                                            <button type="button" class="btn btn-secondary"><span
                                                    class="fas fa-arrow-right"></span>
                                            </button></a>
                                        </div>
                                    </div>
                                     @elseif(count($data)>0)
                                     <div class="message-tool-bar-right pull-right" id="ss" >
                                        <span class="text-muted count-message"><b> 
                                            {{($data->currentpage()-1)*$data->perpage()+1}} - {{ $data->lastItem() }} of   {{$data->total()}} 
                                            </b></span>
                                        <div
                                                class="btn-group btn-group-sm">
                                                <a   href="{{ $data->previousPageUrl() }}">
                                            <button type="button" class="btn btn-secondary"><span
                                                    class="fas fa-arrow-left"></span>
                                            </button></a>
                                            <a   href="{{ $data->nextPageUrl() }}">
                                            <button type="button" class="btn btn-secondary"><span
                                                    class="fas fa-arrow-right"></span>
                                            </button></a>
                                        </div>
                                    </div>
                                     @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 col-lg-2">
                                    <ul class="nav nav-pills  inbox-nav">
                                        <li class="active nav-item"><a  class="nav-link" href="{{ url('accountmessagebinbox') }}"> Inbox
                                            <span class="badge badge-gray count">{{count($inbox)}}</span></a>
                                        </li>
                                        <strong><li class="nav-item"><a  class="nav-link" href="{{ url('buyerdraftmessage') }}">Drafts <span
                                                class="badge badge-gray count">{{count($draft)}}</span></a>
                                        </li></strong>
                                        <li class="nav-item"><a  class="nav-link" href="{{ url('buyerfavourite') }}">Starred</a>
                                        </li>
                                        <li class="nav-item"><a  class="nav-link" href="{{ url('buyerimportant') }}"><i class="icon icon-important"></i>Important</a>
                                        </li>
                                        <li class="nav-item"><a  class="nav-link"  href="{{ url('buyersendmail') }}">Sent
                                            Mail</a> 
                                        </li>

                                    </ul>
                                </div>
                                <div class="col-md-9 col-lg-10">
                                    <div class="message-list">
                                        <div id="home">
                                            <div class="list-group">
                                             <form role="form" action="" method="get" enctype="multipart/form-data">
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

                                                {{ csrf_field() }}

                                                @foreach($data as $msg)
                                                    @if($msg->buyerread_status == '0')
                                                <div class="list-group-item">
                                                   
                                                    <a href="{{ url('draftbuyer') }}/{{$msg->id}}" class="list-box-user">
                                                        @if($msg->profile_image!="")

                                                          @php $a = explode(",",$msg->profile_image); @endphp
                                                        
                                                          <img class="img-circle" src="{{ url('public/image') }}/{{ $a[0] }}" alt="img" height="30px" width="30px">
                                                
                                                         @endif
                                                         <strong> <span class="name"> {{$msg->fname}}  {{$msg->lname}}</span></strong>
                                                    </a>
                                                    <br>
                                                    <a href="{{ url('draftbuyer') }}/{{$msg->id}}" class="list-box-content">
                                                        <div class="message-text">
                                                        @if($msg->files!="")

                                                         @php $b = explode(",",$msg->files); @endphp
                                                         @foreach($b as $photo)
                                                          <img class="thumbnail no-margin" src="{{ url('public/image') }}/{{ $photo }}" alt="img" height="90px" width="90px">
                                                          @endforeach
                                                           {{$msg->message}}
                                                        @else
                                                              {{$msg->message}}
                                                        @endif

                                                          
                                                        </div>
                                                        <div class="time text-muted">{{$msg->created_at}}</div>
                                                    </a>
                                                    <div class="list-box-action">
                                                         @if($msg->buyerfavourite_status == "Favourite")
                                                        <a href="{{ url('buyerfavouritemail') }}/{{$msg->id}}" data-toggle="tooltip" data-placement="top" class="markAsStar"  value="" 
                                                           title="Mark as Favourite "><i class="fas fa-star"></i></a>
                                                        @else
                                                            <a href="{{ url('buyerfavouritemail') }}/{{$msg->id}}" data-toggle="tooltip" data-placement="top" class="markAsStar"  value="Favourite"
                                                           title="Mark as Favourite "><i class="far fa-star "></i></a>
                                                       
                                                        @endif

                                                        <a  href="{{ url('buyerdelete') }}/{{$msg->id}}" data-toggle="tooltip" data-placement="top" title="Delete ">
                                                            <i class=" fas fa-trash"></i></a>

                                                           
                                                         @if($msg->buyerimportant_status == "Important")
                                                        <a href="{{ url('buyerimportantemail') }}/{{$msg->id}}" class="markAsCircle" data-toggle="tooltip" data-placement="top" value="" name='important'
                                                           title="Mark as Important "> <i class="fas fa-circle"></i></a>
                                                        @else
                                                        <a href="{{ url('buyerimportantemail') }}/{{$msg->id}}" class="markAsCircle" data-toggle="tooltip" data-placement="top" value="Important" name='important'
                                                           title="Mark as Important "> <i class="far fa-circle"></i></a>
                                                        @endif

                                                          
                                                    </div>
                                                </div>
                                                 @else

                                                <div class="list-group-item seen">
                                                    <a href="{{ url('draftbuyer') }}/{{$msg->id}}" class="list-box-user">
                                                         @if($msg->profile_image!="")

                                                          @php $a = explode(",",$msg->profile_image); @endphp
                                                        @foreach($a as $photo)
                                                          <img class="img-circle" src="{{ url('public/image') }}/{{ $photo }}" alt="img" height="30px" width="30px">
                                                        @endforeach

                                                         @endif
                                                        
                                                         <span class="name"> {{$msg->fname}} {{$msg->lname}} </span>
                                                    </a>
                                                    <br>
                                                    <a href="{{ url('draftbuyer') }}/{{$msg->id}}" class="list-box-content">
                                                        <br>
                                                       <div class="message-text  ">
                                                            
                                                           @if($msg->files!="")

                                                          @php $b = explode(",",$msg->files); @endphp
                                                        
                                                          <img class="thumbnail no-margin" src="{{ url('public/image') }}/{{ $b[0] }}" alt="img" height="90px" width="90px">
                                                           {{$msg->message}}
                                                        @else
                                                              {{$msg->message}}
                                                        @endif
                                                       
                                                        </div>
                                                         <div class="time text-muted">{{$msg->created_at}}</div>
                                                    </a>
                                                    <div class="list-box-action">

                                                        @if($msg->buyerfavourite_status == "Favourite")
                                                        <a href="{{ url('buyerfavouritemail') }}/{{$msg->id}}" data-toggle="tooltip" data-placement="top" class="markAsStar"  value="" 
                                                           title="Mark as Favourite "><i class="fas fa-star"></i></a>
                                                        @else
                                                            <a href="{{ url('buyerfavouritemail') }}/{{$msg->id}}" data-toggle="tooltip" data-placement="top" class="markAsStar"  value="Favourite"
                                                           title="Mark as Favourite "><i class="far fa-star "></i></a>
                                                       
                                                        @endif

                                                        <a  href="{{ url('buyerdelete') }}/{{$msg->id}}" data-toggle="tooltip" data-placement="top" title="Delete ">
                                                            <i class=" fas fa-trash"></i></a>
                                                          
                                                         @if($msg->buyerimportant_status == "Important")
                                                        <a href="{{ url('buyerimportantemail') }}/{{$msg->id}}" class="markAsCircle" data-toggle="tooltip" data-placement="top" value="" name='important'
                                                           title="Mark as Important "> <i class="fas fa-circle"></i></a>
                                                        @else
                                                        <a href="{{ url('buyerimportantemail') }}/{{$msg->id}}" class="markAsCircle" data-toggle="tooltip" data-placement="top" value="Important" name='important'
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
<script>
function refreshPage(){
    window.location.reload();
} 
</script>

@endsection