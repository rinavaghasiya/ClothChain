@extends('layout.seller.content')
@section('title')
Buyer Login
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

                            <form role="form" action = "{{ url('buyerlogindata') }}" >
                                     {{ csrf_field() }}
  
                                <div class="form-group">
                                    <label for="sender-email" class="control-label">Username:</label>

                                    <div class="input-icon"><i class="icon-user fa"></i>
                                        <input id="sender-email" type="text" name="email" placeholder="Username"
                                               class="form-control email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user-pass" class="control-label">Password:</label>

                                    <div class="input-icon"><i class="icon-lock fa"></i>
                                        <input type="password" class="form-control" name="password" placeholder="Password"
                                               id="user-pass">
                                    </div>
                                </div>


                                <div class="form-group">
                                    
                                    <center><input type="submit" name="submit" class="btn btn-primary" value="Login"></center>
                                </div>

                               
                            </form>
                        </div>
                        <div class="card-footer">

                            <div class="checkbox pull-left">
                                <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                    <input type="checkbox" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                    
                                </label>
                            </div>


                            <p class="text-center pull-right"><a href="{{ url('buyerforgotpassword') }}"> Lost your password? </a>
                            </p>

                            <div style=" clear:both"></div>
                        </div>
                    </div>
                    <div class="login-box-btm text-center">
                        <p> Don't have an account? <br>
                            <a href="{{ url('signup') }}"><strong>Sign Up !</strong> </a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

