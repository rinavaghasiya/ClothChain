@extends('layout.seller.content')
@section('title')
Seller ResetPassword
@endsection
@section('content')
<div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 login-box">
                    <div class="card card-default">
                        <div class="panel-intro text-center">
                            <h2 class="logo-title">
                              <span class="logo-icon"><i
                                        class="icon icon-search-1 ln-shadow-logo shape-0"></i></span>CLOTH<span>CHAIN</span>
                                    </h2>
                        </div>
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

                            <form role="form" action = "{{ url('reset') }}" method="post">
                                     {{ csrf_field() }}
                                    <input type="hidden" id="id"  name="id" value="{!! @$list->id !!}">
                                  <input type="hidden" id="token"  name="token" value="{!! @$list->remember_token !!}">
  
                                <div class="form-group">

                                    <label for="sender-email" class="control-label">New Password:</label>

                                    <div class="input-icon"><i class="icon-user fa"></i>
                                        <input id="sender-email" type="password" name="npass" placeholder="New Password"
                                               class="form-control email">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <label for="sender-email" class="control-label">Confirm Password:</label>

                                    <div class="input-icon"><i class="icon-user fa"></i>
                                        <input id="sender-email" type="password" name="cpass" placeholder="Confirm Password"
                                               class="form-control email">
                                    </div>
                                </div>
                              
                                <div class="form-group">
                                    
                                    <center><input type="submit" name="submit" class="btn btn-primary" value="Save"></center>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection 