@extends('layout.seller.content')
@section('content')

 
<div class="main-container">

  <div class="intro" style="background-image: url(public/images/bg3.jpg);">
   <div class="container">
            <div class="row">
                <div class="col-sm-5 login-box">
                     <div class="form-group">
                                    <center><b><a href="{{ url('buyerlogin') }}" class="btn btn-primary " style=color:white>Buy</a></b>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ url('login') }}" class="btn btn-primary " style=color:white>Sell</a></center>
                     </div>   
                      <div style=" clear:both"></div>
                      </div> 
                   </div>
          </div> 
    </div>
    </div>
    

@endsection
