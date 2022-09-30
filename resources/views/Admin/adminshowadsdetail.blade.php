@extends('layout.Admin.admincontent')
@section('title')
Show AdsDetail
@endsection
@section('body')

<div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div  style="float: right;">
                    <div class="pull-right backtolist"><a href="{{ url('adminshowpost') }}"> <i
                            class="fa fa-angle-double-left"></i> Back to Results</a></div>
                    </div>
                </div>
            </div>
        </div>
    <div class="container">
         
        <div class="row" >
            <div style="padding-left: 191px">
             <div class="card" style="width:1000px;">
                    <div class="card-body login-card-body">
                 <div class="col-md-4">
            </div>
                <div class="col-md-10 page-content col-thin-right">
                    <div class="inner inner-box ads-details-wrapper">
                         <center>
                          @foreach($data as $image) 
                        <h2> {{$image->ptitle}}</h2>
           
                        <div class="item-slider">
                         
                            <ul class="bxslider">
                               
                                @php $a = explode(",",$image->image); @endphp
                                <li> @foreach($a as $b)<img class="myImages" id="myImg" src="{{ url('public/image') }}/{{ $b }}" alt="Product Image" height='200' width='200'/> @endforeach</li>
                            </ul>   
                                       
                        </div>
                        <div class="Ads-Details">
                            <h5 class="list-title"><strong>Ads Detsils</strong></h5>
                               <h5>{{$image->description}}</h5>
                               </center>
                            <div class="row">
                            
                                  <div class="col-md-7">
                                  </div>
                             
                                
                                  <div  style="float: right;">
                                <div class="col-md-16">
                                    <aside class="panel panel-body panel-details">
                                        <ul>
                                             <li>
                                                <p class="no-margin"><strong>Category Name:</strong>{{$image->c_name}} </p>
                                            </li>
                                            <li>
                                                <p class=" no-margin "><strong>Price:</strong>{{$image->price}}</p>
                                            </li>
                                            <li>
                                                <p class="no-margin"><strong>Title:</strong> {{$image->ptitle}}</p>
                                            </li>
                                          
                                            <li>
                                                <p class=" no-margin "><strong>Condition:</strong> {{$image->condition_type}}</p>
                                            </li>
                                           
                                        </ul>
                                    </aside>
                                      
                                </div>
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

