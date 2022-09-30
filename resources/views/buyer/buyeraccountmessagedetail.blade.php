 @extends('layout.seller.content')
 @section('title')
Buyer AccountMessageDetail
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
                                    <h5 class="collapse-title no-border"> My Classified <a class="pull-right"  aria-expanded="true" data-toggle="collapse" href="#MyClassified"><i class="fa fa-angle-down"></i></a></h5>
                                   <div id="MyClassified" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                            <li><a href="{{ url('accounthome') }}" ><i class="icon-home"></i> Personal Home </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.collapse-box  -->
                                <div class="collapse-box">
                                    <h5 class="collapse-title"> Message Inbox <a class="pull-right" aria-expanded="true" data-toggle="collapse" href="#MyAds"><i class="fa fa-angle-down"></i></a>
                                    </h5>
                                    <div id="MyAds" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                           <li class="active"><a href="{{ url('accountmessagebinbox') }}"><i
                                                    class="icon-mail"></i> Message <span
                                                    class="badge">{{count($inbox)}}</span></a></li>
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
                                <div class="col-md-3 col-lg-2 hidden-sm">
                                    <ul class="nav nav-pills  inbox-nav">
                                        <li class="active nav-item"><a class="nav-link" href="{{ url('accountmessagebinbox') }}"> Inbox
                                            <span class="badge badge-gray count">{{count($inbox)}}</span></a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('buyerdraftmessage') }}">Drafts <span
                                                class="badge badge-gray count">{{count($draft)}}</span></a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('buyerfavourite') }}">Starred</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('buyerimportant') }}">Important</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link"  href="{{ url('buyersendmail') }}">Sent
                                            Mail</a>
                                        </li>

                                    </ul>
                                </div>

                                <div class="col-md-9 col-lg-10 chat-row">
                                    <div class="message-chat">
                                        <div class="message-chat-history">
                                            @php $a=Session::get("user_id1"); @endphp
                                         @foreach($data as $msg) 
                                           @if($msg->sender_id == ($msg->stype == 'S'))
                                          <strong>{{$msg->sfname}} {{$msg->slname}}</strong>
                                            <div style="float: right;">
                                            <span class="time-and-date"> {{$msg->created_at}}</span></div>
                                            <br><br>
                                            <!-- <div class="chat-item object-user"> -->
                                                <div class="chat-item-content">
                                                    <div class="chat-item-content-inner">
                                                        <div class="msg">

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
                                                        
                                                    </div>
                                                </div>
                                                @else
                                                 <strong>{{$msg->fname}} {{$msg->lname}}</strong>
                                            <div style="float: right;">
                                            <span class="time-and-date"> {{$msg->created_at}}</span></div>
                                            <br><br>
                                            <div class="chat-item-content">
                                                    <div class="chat-item-content-inner">
                                                        <div class="msg">

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
                                                        
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                                 <br><br><br>
                                         <div class="type-form-footer" id="btn">
                                             <button type="submit" class="btn btn-secondary btn-icon"><i class="icon-reply"></i> Reply</button>     
                                            </div>
                                            <br><br>

                                        <div class="type-message" id="reply" style="display: none;">

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
                                        <form action="{{ url('replymessagebuyer') }}" method="post" enctype="multipart/form-data">
                                                 {{ csrf_field() }}
                                              
                                            <div class="type-form">


                                                  @if($msg->sender_id == ($msg->stype == 'S'))

                                                <input type="hidden" name="receiver_id" class="form-control" id="sender_id" value="{{$msg->semail}}">
                                                @else
                                                
                                                <input type="hidden" name="receiver_id" class="form-control" id="sender_id" value="{{$msg->email}}">

                                                 @endif
                                                 
                                                  <textarea class="form-control" id="message" name="message" rows="5"  placeholder="Type a message"></textarea>
                                                  <p id="image"></p>

                                                <div class="button-wrap">
                                                     <input type="file" multiple  name="files[]" id="imgupload" style="display:none"/> 
                                                    <button class="btn btn-secondary" type="button" id="attach"><i class="fas fa-paperclip" aria-hidden="true"></i></button>
                                                       <button class="btn btn-primary" type="submit" name="send" value="Success"><i class="fas fa-paper-plane" aria-hidden="true"></i></button>

                                                    <button type="submit" id="draft"  name="draft" value="Draft" class="btn btn-info btn-icon"><i class="fas fa-tag"></i> Draft</button>
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
             </div>
          </div>
      </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type ="text/javascript">
$("#btn").click(function(){
  $("#reply").show();
  $("#btn").hide();
});

$('#attach').click(function(){ $('#imgupload').trigger('click'); });

$("#imgupload").change(function(){

     // $('#image_preview').html("");

     var total_file=document.getElementById("imgupload").files.length;
     for(var i=0;i<total_file;i++)

     {

      // $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"' height='60' width='60' >");
      var fileName = event.target.files[i].name;
      var space="\n";
        var space1="\n";
      $('#image').append(space1,fileName,space);

     }
  });
</script>

@endsection