 @extends('layout.seller.content')
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
                                            <li><a href="{{ url('accounthome') }}" ><i class="icon-home"></i> Personal Home </a>
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
                                                    class="icon-mail"></i> Message <span
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
                                <div class="col-md-9 col-lg-10 chat-row">
                                    <div class="message-chat">
                                        <div class="message-chat-history">
                                            @php $a=Session::get("user_id1"); @endphp
                                         @foreach($data as $msg) 
                                          @if( $msg->seller1_email!='')
                                            
                                           <strong>{{$msg->seller1_nm}} {{$msg->seller1_lnm}}</strong>
                                            <div style="float: right;">
                                            <span class="time-and-date"> {{$msg->created_at}}</span></div>
                                            <br><br>
                                            <div class="type-message" id="reply" >
                                            <form action="{{ url('draftmessagebuyer') }}" method="post" enctype="multipart/form-data">
                                                 {{ csrf_field() }}
                                            <div class="type-form" >

                                                   @if($msg->seller1_email !='')
                                                 <input type="hidden" name="receiver_id" class="form-control"  value="{{$msg->seller1_email}}">
                                                 @else
                                                 <input type="hidden" name="receiver_id" class="form-control"  value="{{$msg->seller2_email}}">
                                                 @endif
                                                 <input type="hidden" name="mid" class="form-control"  value="{{$msg->id}}">
                                                  @if($msg->files!="")

                                                          @php $b = explode(",",$msg->files); @endphp
                                                         <textarea  rows="5" class="form-control" id="message" name="message"> {{$msg->message}}   
                                                            </textarea>
                                                            <p id="image"></p>
                                                          @foreach($b as $photo)
                                                           <input type="text" readonly="readonly" name="aa" id="aa" value="{{$photo}}" >   
                                                        
                                                          @endforeach
                                                        @else
                                                            <textarea  rows="5" class="form-control" id="message" name="message"> {{$msg->message}}   
                                                             </textarea>
                                                             <p id="image"></p>
                                                        @endif 
                                                 <div class="button-wrap" >

                                                    <input type="file" multiple  name="files[]" id="imgupload" style="display:none"/> 
                                                    <input type="hidden"  name="oldimg" id="oldimg" value="{{$msg->files}}">   

                                                    <button class="btn btn-secondary" type="button" id="attech"><i class="fas fa-paperclip" aria-hidden="true"></i></button>
                                                    <button class="btn btn-secondary" type="submit" name="send" id="send" value="Success"><i class="fas fa-paper-plane" aria-hidden="true"></i></button>
                                                   
                                                   
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                     @else
                                                  <strong>{{$msg->seller2_nm}} {{$msg->seller2_lnm}}</strong>
                                            <div style="float: right;">
                                            <span class="time-and-date"> {{$msg->created_at}}</span></div>
                                            <br><br>
                                            <div class="type-message" id="reply" >
                                            <form action="{{ url('draftmessagebuyer') }}" method="post" enctype="multipart/form-data">
                                                 {{ csrf_field() }}
                                            <div class="type-form" >

                                                   @if($msg->seller1_email !='')
                                                 <input type="hidden" name="receiver_id" class="form-control"  value="{{$msg->seller1_email}}">
                                                 @else
                                                 <input type="hidden" name="receiver_id" class="form-control"  value="{{$msg->seller2_email}}">
                                                 @endif
                                                 <input type="hidden" name="mid" class="form-control"  value="{{$msg->id}}">
                                                @if($msg->files!="")

                                                          @php $b = explode(",",$msg->files); @endphp
                                                         <textarea  rows="5" class="form-control" id="message" name="message"> {{$msg->message}}   
                                                            </textarea>
                                                            <p id="image"></p>
                                                          @foreach($b as $photo)
                                                           <input type="text" readonly="readonly" name="aa" id="aa" value="{{$photo}}" >   
                                                        
                                                          @endforeach
                                                        @else
                                                            <textarea  rows="5" class="form-control" id="message" name="message"> {{$msg->message}}   
                                                             </textarea>
                                                             <p id="image"></p>
                                                        @endif 
                                                  
                                                         
                                                </textarea>
                                                <p id="image"></p>
                                                <div class="button-wrap" >

                                                    <input type="file" multiple   name="files[]" id="imgupload" style="display:none"/> 
                                                     <input type="hidden"  name="oldimg" id="oldimg" value="{{$msg->files}}"> 

                                                    <button class="btn btn-secondary" type="button" id="attech"><i class="fas fa-paperclip" aria-hidden="true"></i></button>
                                                    <button class="btn btn-secondary" type="submit" name="send" id="send" value="Success"><i class="fas fa-paper-plane" aria-hidden="true"></i></button>

                                                   
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                            @endif
                                                @endforeach
                                                 <br><br><br>
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
$("#send").click(function(){
  $("#reply").show();
  $("#btn").hide();
});

$('#attech').click(function(){ $('#imgupload').trigger('click'); });


  $("#imgupload").change(function(){

     // $('#image_preview').html("");

     var total_file=document.getElementById("imgupload").files.length;

     for(var i=0;i<total_file;i++)

     {

      // $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"' height='60' width='60' >");
      var fileName = event.target.files[i].name;
      var space="\n";
       var space1="\n";
      // alert(event.target.files[i].name);
      $('#image').append(space1,fileName,space);

     }
  });

</script>
@endsection