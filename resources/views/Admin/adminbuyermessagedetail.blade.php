@extends('layout.Admin.admincontent')
@section('title')
Buyer MessgeDetail
@endsection
@section('body')

<div class="main-container">
  <div class="content-wrapper">
        <div class="container">
            <div class="row">
                
                <div class="col-md-9 page-content" style="padding-left: 191px">
                    <div class="inner-box">
                        <br>
                        <h3 class="title-2"><i class="icon-mail"></i> Message Detail </h3>
                        <div class="inbox-wrapper">
                            <div class="row">
                              <div class="col-md-9 col-lg-10" style="padding-left: 480px">
                            
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
                                      <strong><li class="active nav-item"><a  class="nav-link" href="{{ url()->previous() }}"> Mail box
                                            <span class="badge badge-gray count"></span></a>
                                        </li></strong>
                                    
                                    </ul>
                                   
                                </div>
                                <div class="col-md-9 col-lg-10 chat-row">

                                    <div class="message-chat">
                                        <div class="message-chat-history">
                                             
                                             @foreach($data as $msg) 
                                              @if($msg->sender_id == ($msg->type =='S'))
                                             <strong style="color: green;">{{$msg->fname}} {{$msg->lname}}</strong>
                                            @else
                                             <strong style="color: blue;"> {{$msg->seller1_nm}}  {{$msg->seller1_lnm}}</strong>
                                           @endif
                                            <div style="float: right;">
                                            <span class="time-and-date"> {{$msg->created_at}}</span></div>
                                            <br><br>
                                            <div class="chat-item object-me">
                                                <div class="chat-item-content">

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
                                            @endforeach
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