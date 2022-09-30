@extends('layout.seller.content')
@section('title')
MyAds
@endsection
@section('content')

<div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <nav aria-label="breadcrumb" role="navigation" class="pull-left">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="icon-home fa"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ url('category') }}">All Ads</a></li>
                          
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-9 page-content col-thin-right">
                    <div class="inner inner-box ads-details-wrapper">
                          @foreach($data as $image) 
                        <h2> {{$image->ptitle}}</h2>
                        <div class="item-slider">
                            <h1 class="pricetag"> Rs.{{$image->price}}</h1>
                            <ul class="bxslider" >
                                
                                @php $a = explode(",",$image->image); @endphp
                                <li> @foreach($a as $b)
                            <img class="myImages" id="myImg" src="{{ url('public/image') }}/{{ $b }}" alt="" height='380' width='330'/> @endforeach</li> 

                                
                            </ul>

                        </div>
                     <div class="Ads-Details">
                            <h5 class="list-title"><strong>Ads Details</strong></h5>

                            <div class="row">
                                <div class="ads-details-info col-md-8">
                                   <h4>{{$image->description}}</h4>
                                 </div>
                                 <div class="col-md-4">
                                    <aside class="panel panel-body panel-details">
                                        <ul>
                                            <li>
                                                <p class=" no-margin "><strong>Price:</strong>Rs.{{$image->price}}</p>
                                            </li>
                                            <li>
                                                <p class="no-margin"><strong>Title:</strong> {{$image->ptitle}}</p>
                                            </li>
                                            <li>
                                                <p class="no-margin"><strong>Location:</strong>{{$image->StateName}} </p>
                                            </li>
                                            <li>
                                                <p class=" no-margin "><strong>Condition:</strong> {{$image->condition_type}}</p>
                                            </li>
                                           
                                        </ul>
                                    </aside>
                                      
                                </div>
                            </div>
                            <div class="content-footer text-left">

                              
                                @if(Session::has('user_id'))    
                               <!--  <a class="btn  btn-default"  href="{{ url('accountmessageinbox') }}"><i class=" icon-mail-2"></i> Send a message </a>  -->
                                @else
                                 <a class="btn  btn-default"  href="{{ url('accountmessagebcompose') }}/{{$image->id}}"><i
                                    class=" icon-mail-2"></i> Send a message </a> 
                                @endif
                                    <a class="btn  btn-info"><i
                                    class=" icon-phone-1"></i>(+91) {{$image->phone}} </a></div>
                        </div>
                        @endforeach
                    </div>
                   
                </div>
                <div class="col-md-3  page-sidebar-right">
                    <aside>
                         @foreach($data as $image1) 
                        <div class="card card-user-info sidebar-card">
                            <div class="block-cell user">

                                  @php $a = explode(",",$image1->profile_image); @endphp
                                   
                                <div class="cell-media"> <img class="thumbnail no-margin" src="{{ url('public/image') }}/{{ $a[0] }}" alt="img" height="60px" width="60px"></div>
                                <div class="cell-content">
                                    <h5 class="title">Posted by</h5>
                                     <span class="name"><a href="seller-profile.html"></a>{{$image1->fname}}  {{$image1->lname}} </span>
                                     </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body text-left">
                                    <div class="grid-col">
                                        <div class="col from">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>Location</span>
                                        </div>
                                        <div class="col to">
                                            <span> {{$image1->StateName}} </span>
                                        </div>
                                    </div>

                                    <div class="grid-col">
                                        <div class="col from">
                                            <i class="fas fa-user"></i>
                                            <span>Posted</span>
                                        </div>
                                        <div class="col to">
                                            <span>{{ date('d-M-y', strtotime($image1->created_at)) }}
                                            </span>
                                        </div>
                                    </div>
                                        
                                </div>

                                <div class="ev-action">
                                     @if(Session::has('user_id'))    
                                   <!--  <a class="btn btn-success btn-block" href="{{ url('accountmessageinbox') }}">
                                        <i class=" icon-mail-2"></i> Contact User
                                    </a> -->

                                    @else
                                   <!--  <a class="btn btn-success btn-block" href="{{ url('accountmessagebinbox') }}"> -->
                                     <a class="btn btn-success btn-block" href="{{ url('accountmessagebcompose') }}/{{$image->id}}">
                                        <i class=" icon-mail-2"></i> Contact User
                                    </a>
                                   
                                    @endif
                                    <a class="btn  btn-info btn-block">
                                        <i class=" icon-phone-1"></i>(+91) {{$image1->phone}} </a>
                                </div>

                            </div>
                        </div>
                        @endforeach
                        </aside>
                </div>
              </div>
        </div>
    </div>
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script type ="text/javascript">

var modal = document.getElementById('myModal');
var images = document.getElementsByClassName('myImages');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
for (var i = 0; i < images.length; i++) {
  var img = images[i];
  img.onclick = function(evt) {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }
}

var span = document.getElementsByClassName("close")[0];
span.onclick = function() {
  modal.style.display = "none";
}
</script>
@endsection