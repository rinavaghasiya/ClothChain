@extends('layout.Admin.admincontent')
@section('title')
Seller Message
@endsection
@section('body')

<div class="main-container">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                
                <div class="col-md-9 page-content" style="padding-left: 191px">
                    <div class="inner-box">
                        <br>
                        <h3 class="title-2"><i class="icon-mail"></i> INBOX </h3>
                        <div class="inbox-wrapper">

                            <div class="row">
                            <div class="col-md-9 col-lg-10">
                            <br>
                            <div class="col-md-4">
                                <div  style="float: left;">
                                <div class="pull-left backtolist"><a href="{{ url('adminshowseller') }}"> <i
                                        class="fa fa-angle-double-left"></i> Show Seller</a></div>
                                </div>
                            </div>

                                    @if(count($data)<0)
                                     <div class="message-tool-bar-right pull-right" id="cc" style="display: none;"  style="float:right; ">
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
                                     <div class="message-tool-bar-right pull-right" id="ss"  style="float:right; ">
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
                                      <strong><li class="active nav-item"><a  class="nav-link" href="{{ url('adminshowsellermessage') }}/{{$data[0]->receiver_id}}"> Mail box
                                            <span class="badge badge-gray count"></span></a>
                                        </li></strong>
                                    </ul>
                                </div>

                                <div class="col-md-9 col-lg-10">
                                    <div class="message-list">
                                        <div id="home">
                                              <form role="form" action="" method="get" enctype="multipart/form-data">
                                            <div class="list-group">
                                             
                                                    @foreach($data as $msg)
                                                
                                                <div class="list-group-item">    
                                                        <a href="{{ url('adminsellermessagedetail') }}/{{$msg->sender_id}}/{{$data[0]->receiver_id}}" class="list-box-user">
                                                             

                                                             <img class="thumbnail no-margin" src="{{ url('public/image') }}/{{ $msg->buyer1_img }}" alt="img" height="30px" width="30px">

                                                             <strong> <span class="name"> {{$msg->buyer2_nm}}  {{$msg->buyer2_lnm}}
                                                         </span></strong>
                                                         
                                                        </a>
                                                    <br>
                                                    <a href="{{ url('adminsellermessagedetail') }}/{{$msg->sender_id}}/{{$data[0]->receiver_id}}" class="list-box-content">
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
                                                    
                                                </div>
                                               
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
 </div>
@endsection