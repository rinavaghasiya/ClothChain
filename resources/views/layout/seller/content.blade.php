<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- Mirrored from templatecycle.com/demo/bootclassified-5.1/dist/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 23 Dec 2019 08:52:35 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fav and touch icons -->
    
    <title>Cloth Chain   @yield('title')</title>
    <!-- Bootstrap core CSS -->
    <link href="{{URL::asset('public/assets/bootstrap/css/bootstrap.css')}}" rel="stylesheet">


    <link href="{{URL::asset('public/assets/css/style.css')}}" rel="stylesheet">

    <!-- styles needed for carousel slider -->
    <link href="{{URL::asset('public/assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/plugins/owl-carousel/owl.theme.css')}}" rel="stylesheet">

    <!-- bxSlider CSS file -->
    <link href="{{URL::asset('public/assets/plugins/bxslider/jquery.bxslider.css')}}" rel="stylesheet"/>
<style type="text/css">
	/*#img {
    transition: -webkit-transform 0.60s ease;
}#img:active {
    -webkit-transform: scale(10);
}*/

body {font-family: Arial, Helvetica, sans-serif;}

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
 /*overflow: auto;  /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 50%;
  max-width: 500px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 300px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: center;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 300px){
  .modal-content {
    width: 50%;
  }
}
</style>
    <!-- Just for debugging purposes. -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- include pace script for automatic web page progress bar  -->
    <script>
        paceOptions = {
            elements: true
        };
    </script>
    <script src="{{URL::asset('public/assets/js/pace.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/modernizr/modernizr-custom.js')}}"></script>



</head>
<body>
<div id="wrapper">

        <div class="header">
        	@include('layout.seller.header')
        </div>
        <!-- /.header -->

        <label class="theme-switcher theme-switcher-left-right">
        	<span class="theme-switcher-label" data-on="Dark Off" data-off="Dark Mode"></span>
        	<span class="theme-switcher-handle"></span>
        </label>


    @yield('content')
    <!-- /.main-container -->

    @include('layout.seller.footer')
    <!-- /.footer -->
</div>
<!-- /.wrapper -->

<!-- Le javascript
================================================== -->

<!-- Placed at the end of the document so the pages load faster -->

<!-- <script src="../../../../cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <script>window.jQuery || document.write('<script src="assets/js/jquery/jquery-3.3.1.min.js">\x3C/script>')</script> -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="{{URL::asset('public/assets/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{URL::asset('public/assets/js/vendors.min.js')}}"></script>

<!-- include custom script for site  -->

 @yield('script')

 <script src="{{URL::asset('public/assets/js/main.min.js')}}"></script>


</body>

<!-- Mirrored from templatecycle.com/demo/bootclassified-5.1/dist/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 23 Dec 2019 08:52:35 GMT -->
</html>
