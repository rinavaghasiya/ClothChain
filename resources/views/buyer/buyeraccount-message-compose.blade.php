@extends('layout.seller.content')
@section('title')
Buyer ResetPassword
@endsection
@section('content')

    <label class="theme-switcher theme-switcher-left-right">
        <span class="theme-switcher-label" data-on="Dark Off" data-off="Dark Mode"></span>
        <span class="theme-switcher-handle"></span>
    </label>

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
                                            <li><a href="{{ url('accounthome') }}"><i class="icon-home"></i> Personal Home </a>
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
                                                    class="icon-mail"></i> Message<span
                                                    class="badge">{{count($inbox)}}</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.collapse-box  -->
                                <div class="collapse-box">
                                    <h5 class="collapse-title"> Terminate Account
                                        <a class="pull-right"
                                           aria-expanded="true"
                                           data-toggle="collapse"
                                           href="#TerminateAccount"><i
                                                class="fa fa-angle-down"></i></a></h5>
                                    <div id="TerminateAccount" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                            <li><a href="{{ url('accountmsgbcompose') }}"><i class="icon-cancel-circled "></i> Close
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
                        <h2 class="title-2"><i class="fas fa-edit"></i> Compose Mail </h2>
                        <div class="inbox-wrapper">
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
                            <form role="form" action="{{ url('insertmessage') }}" method="post">
                                 {{ csrf_field() }}
                            <div class="row">

                                <div class="col-md-9 col-lg-10 ">
                                    <div class="user-bar-top">
                                        <div class="user-top-comp">
                                            <div class="col m-0 p-0">
                                                <label class="sr-only" for="inlineFormInputGroup"> </label>
                                                <div class="input-group">
                                                    <!-- <div class="input-group-prepend">
                                                        <div class="input-group-text">To:</div>
                                                    </div> -->
                                                    <input readonly  type="hidden" class="form-control" name="receiver_id" id="receiver_id" value="{!! @$data[0]->email !!}" >
                                                </div>
                                            </div>
                                        </div>

                                  
                                </div>
                            </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3 col-lg-2 hidden-sm">
                                    <ul class="nav nav-pills  inbox-nav">
                                        <li class="active nav-item"><a class="nav-link" href="{{ url('accountmessagebinbox') }}"> Inbox
                                            <span class="badge badge-gray count">{{count($inbox)}}</span></a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('buyerdraftmessage') }}">Drafts <span
                                                class="badge badge-gray count">{{count($draft)}}</span></a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link"  href="{{ url('buyerfavourite') }}">Starred</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('buyerimportant') }}">Important</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('buyersendmail') }}">Sent
                                            Mail</a>
                                        </li>

                                    </ul>
                                </div>

                                <div class="col-md-9 col-lg-10 chat-row">
                                    <div class="message-compose">

                                          <div class="type-form">
                                            <input type="hidden" name="id" value="{!! @$data[0]->id !!}">
                                               <textarea class="form-control" id="message" name="message"  rows="4" placeholder="Type a message" ></textarea>
                                            </div>
                                            <br>
                                            <div class="type-form-footer">
                                               
                                                <button type="submit" id="draft"  name="draft" value="Draft" class="btn btn-info"><i class="fas fa-tag"></i> Draft</button>
                                               <button type="submit" id="send" name="send" value="Success" class="btn btn-primary btn-icon"><i class="fas fa-tag"></i> Send</button>
                                                
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
   
<div class="modal fade modalHasList" id="selectRegion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><i class=" icon-map"></i> Select your region </h4>

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="contactAdvertiser" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class=" icon-mail-2"></i> Contact advertiser </h4>

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Name:</label>
                        <input class="form-control required" id="recipient-name" placeholder="Your name"
                               data-placement="top" data-trigger="manual"
                               data-content="Must be at least 3 characters long, and must only contain letters."
                               type="text">
                    </div>
                    <div class="form-group">
                        <label for="sender-email" class="control-label">E-mail:</label>
                        <input id="sender-email" type="text"
                               data-content="Must be a valid e-mail address (user@gmail.com)" data-trigger="manual"
                               data-placement="top" placeholder="email@you.com" class="form-control email">
                    </div>
                    <div class="form-group">
                        <label for="recipient-Phone-Number" class="control-label">Phone Number:</label>
                        <input type="text" maxlength="60" class="form-control" id="recipient-Phone-Number">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Message <span class="text-count">(300) </span>:</label>
                        <textarea class="form-control" id="message-text" placeholder="Your message here.."
                                  data-placement="top" data-trigger="manual"></textarea>
                    </div>
                    <div class="form-group">
                        <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not
                            valid. </p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success pull-right">Send message!</button>
            </div>
        </div>
    </div>
</div>


<script src="../../../../cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/js/jquery/jquery-3.3.1.min.js">\x3C/script>')</script>
<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets/js/vendors.min.js"></script>

<!-- include custom script for site  -->
<script src="assets/js/main.min.js"></script>

<!-- include footable   -->

<!-- include custom script for ads table [select all checkbox]  -->
<script>
    function checkAll(bx) {
        var chkinput = document.getElementsByTagName('input');
        for (var i = 0; i < chkinput.length; i++) {
            if (chkinput[i].type == 'checkbox') {
                chkinput[i].checked = bx.checked;
            }
        }
    }

</script>
@endsection


<!-- Mirrored from templatecycle.com/demo/bootclassified-5.1/dist/account-message-compose.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 23 Dec 2019 08:52:35 GMT -->
