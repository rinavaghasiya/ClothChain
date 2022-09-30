 @extends('layout.seller.content')
 @section('title')
Seller ForgotPassword
@endsection
@section('content')

    <label class="theme-switcher theme-switcher-left-right">
    	<span class="theme-switcher-label" data-on="Dark Off" data-off="Dark Mode"></span>
    	<span class="theme-switcher-handle"></span>
    </label>
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 login-box">
                    <div class="card card-default">
                        <div class="panel-intro text-center">
                            <h2 class="logo-title">
                                <span class="logo-icon"><i
                                        class="icon icon-search-1 ln-shadow-logo shape-0"></i> </span>CLOTH<span>CHAIN</span>
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
                            <form role="form" action="{{url('resendmail')}}" method="post">
                                  {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="sender-email" class="control-label">Email:</label>

                                    <div class="input-icon"><i class="icon-user fa"></i>
                                        <input id="email" name="email" type="text" placeholder="Email"
                                               class="form-control email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Send me my password
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <p class="text-center "><a href="{{ url('login') }}"> Back to Login </a></p>

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


