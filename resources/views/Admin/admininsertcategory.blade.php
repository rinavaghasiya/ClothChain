@extends('layout.Admin.admincontent')
@section('title')
Add Category
@endsection
@section('body')
<div class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
 <div class="content-wrapper">
<br><br>
   <section class="content"><div class="container">
   <div class="row">
    <div class="col-md-4">
    <div class="box">
    	<button type="submit" class="btn btn-primary"><a href="{{ url('adminshowcategory') }}" style="color: white">Show Category</a></button> <br><br>
     <div class="card">
    <div class="card-body login-card-body">
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
  <form class="form-horizontal" action="{{ url('admininsert')}}" method="post">
          {{ csrf_field() }}
      <div class="form-group">
     <label>Categoty Name</label>
      <input type="text" class="form-control" placeholder="Category Name"  name="c_name" id="c_name" >
      </div>

       <button type="submit" class="btn btn-success">Save Category</button> <button type="reset" class="btn btn-danger">cancel</button>
       
    </div>
   </div>
   </div>
 </form>
</div>
</div>
  </div></section>
   </div>
</div>
@endsection