@extends('layout.Admin.admincontent')
@section('title')
Category
@endsection
@section('body')

<div class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content"><div class="container">
     <br><p  style="font-size:24px"><strong>Category</strong></p>
    <br>
    	<div  style="float: right;">
                 <button type="submit" class="btn btn-primary"><a href="{{ url('admininsertcategory') }}" style="color: white;">Add Category</a></button> 
    </div>
<form class="form-horizontal"  action ="" method="get">
            {{ csrf_field() }}
        <input type="text"  name="search" id="search" value="{{$search}}">
   &nbsp;
    <button type="submit">Search</button>
</form>
           <br>    
 <div class="row">
          <div class="col-12">
            <div class="card">

            	<div></div>
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
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                 <tr>
                      <td><b>Name</b></td>
                      <td><b>Status</b></td>
                      <td><b>Edit</b></td>
                      <td><b>Delete</b></td>
                  </tr>
                 
                	@foreach ($data as $user)
                  <tr>
                  	  <td>{{$user->c_name}}</td>
					         <td>
                     @if($user->status=='Active')
                    
                     <a href ='changestatus/{{ $user->id }}'><button type="submit"  id="active" name="active" class="mj_btn btn btn-success" value="Active" >Active</button></a>
                     @else
                      <a href ='changestatus/{{ $user->id }}'><button type="submit"  id="blocked" name="blocked" class="mj_btn btn btn-danger" value="Blocked">Blocked</button></a>

                     @endif
                  </td>
	                  <td><a href ='adminupdate/{{ $user->id }}'><button type="submit" class="btn btn-primary">Edit</button></a> </td>
	                  <td><a href ='admindelete/{{ $user->id }}'><button type="submit" class="btn btn btn-danger">Delete</button></a></td>
                 </tr>
                 @endforeach
                  @if(count($data)<=0)
                    <td colspan="4" style="color: black;"><center><b style="font-size: 20px;">Result Not Found</b></center></td>
                    @endif
                </table>
                </div>
                <hr>
            </form>
            </div> 
                  <div class="pagination-bar text-center"  style="float: right;">
                    <nav aria-label="Page navigation " class="d-inline-b">
                        <ul class="pagination">
                            <li class="page-item">{{$data->appends(\Request::except('_token'))->render() }}</li>
                        </ul>
                    </nav>
                </div>    
          </div>
        </div>
 </section>
   </div>
</div>
</div>

@endsection