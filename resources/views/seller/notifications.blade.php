@extends('layout.seller.content')
@section('content')
<section>
<div class="container">
  <div class="row justify-content-md-center">
   <div class="col-lg-10">
    <div class="box">
   <div class="heading"><h1>Notifications</h1></div>
   <div class="p-3">
	 <div class="notifications-list">
	 	  <form action="" method="get"> 
	 	  	@foreach ($data as $user)
		<div class="alert alert-dismissible align-items-center">
		 	
		 	@if($user->read_status == '0')
		 	@if($user->status == 'Active')
			 
			 	 <strong><div class="alert alert-success alert-dismissible">{{ $user->notification }}<a href="{{ url('adsdetail') }}/{{$user->pro_id}}"> View Product</a><button type="button" class="close" data-dismiss="alert">&times;</button></div></strong>
			 	 @endif
			 	 @if($user->status == 'Decline')
			 	 
			 	 <strong><div class="alert alert-danger alert-dismissible">{{ $user->notification }}<a href="{{ url('adsdetail') }}/{{$user->pro_id}}"> View Product</a><button type="button" class="close" data-dismiss="alert">&times;</button></div></strong>
			 	 @endif
			 @else
		 
			 	@if($user->status == 'Active')
			 	
			 	 <div class="alert alert-success alert-dismissible">{{ $user->notification }}<a href="{{ url('adsdetail') }}/{{$user->pro_id}}"> View Product</a><button type="button" class="close" data-dismiss="alert">&times;</button></div>
			 	 @endif
			 	 @if($user->status == 'Decline')
			 	
			 	 <div class="alert alert-danger alert-dismissible">{{ $user->notification }}<a href="{{ url('adsdetail') }}/{{$user->pro_id}}"> View Product</a><button type="button" class="close" data-dismiss="alert">&times;</button></div>
			 	 @endif
			@endif

		</div>
			@endforeach
		</form>

	 </div>
	</div>
   </div>	
</div>
  </div>
 </div>

 </section>
 @endsection