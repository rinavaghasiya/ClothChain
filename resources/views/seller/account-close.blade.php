 @extends('layout.seller.content')
 @section('title')
Account Close
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
                                    <h5 class="collapse-title no-border"> My Classified <a href="#MyClassified"aria-expanded="true"  data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a></h5>
                                     @if(Session::has('user_fname1'))
                                    <div class="panel-collapse collapse show" id="MyClassified">
                                        <ul class="acc-list">
                                            <li><a href="{{ url('accounthome') }}"><i class="icon-home"></i> Personal Home </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="collapse-box">
                                    <h5 class="collapse-title"> Message Inbox  <a href="#MyAds" aria-expanded="true"  data-toggle="collapse"
                                                                          class="pull-right"><i
                                            class="fa fa-angle-down"></i></a></h5>

                                    <div class="panel-collapse collapse show" id="MyAds">
                                        <ul class="acc-list">
                                          <li class=""><a href="{{ url('accountmessagebinbox') }}"><i
                                                    class="icon-mail"></i> Message  <span
                                                    class="badge">{{count($binbox)}}</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @else
                                <div class="panel-collapse collapse show" id="MyClassified">
                                        <ul class="acc-list">
                                            <li><a href="{{ url('selleraccounthome') }}"><i class="icon-home"></i> Personal Home </a>
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
                                            <li><a href="{{ url('accountmyads') }}"><i class="icon-docs"></i> My ads <span
                                                    class="badge">{{count($myads)}}</span> </a></li>
                                           
                                            <li><a href="{{ url('pendingapproval') }}"><i
                                                    class="icon-hourglass"></i> Pending approval <span
                                                    class="badge">{{count($penddingads)}}</span></a></li>
                                                    
                                            <li class=""><a href="{{ url('accountmessageinbox') }}"><i
                                                    class="icon-mail"></i> Message Inbox <span
                                                    class="badge">{{count($sinbox)}}</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @endif
                                <div class="collapse-box">
                                    <h5 class="collapse-title"> Terminate Account <a href="#TerminateAccount"
                                                                                     aria-expanded="true"  data-toggle="collapse"
                                                                                     class="pull-right"><i
                                            class="fa fa-angle-down"></i></a></h5>

                                    <div class="panel-collapse collapse show" id="TerminateAccount">
                                        <ul class="acc-list">
                                            <li><a class="active" href="{{ url('accountclose') }}"><i
                                                    class="icon-cancel-circled "></i> Close account </a></li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                        </div>
                        </aside>
                </div>
                <div class="col-md-9 page-content">
                 <div class="inner-box">
                        <h2 class="title-2"><i class="icon-cancel-circled "></i> Close account </h2>
                        <p>You are sure you want to close your account?</p>
                        <div>
                             <form action = "{{ url('close') }}" method="get">
                                 {{ csrf_field() }}
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="close" id="inlineRadio1" value="Yes">  Yes
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="close" id="inlineRadio2" value="No">  No
                                </label>
                            </div>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Submit">

                        </form>
                    </div>
                   </div>
                </div>
         </div>
     </div>
@endsection