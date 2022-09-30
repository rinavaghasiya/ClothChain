@extends('layout.Admin.admincontent')
@section('title')
Post Ads
@endsection
@section('body')

<div class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
 <div class="content-wrapper">
    <section class="content"><div class="container">
    	<br>
       <p  style="font-size:24px"><strong>Post Ads</strong></p>
       <form class="form-horizontal"  action ="" method="get">
    	<div  style="float: right;">
        {{ csrf_field() }}
        <input type="text"  name="search" id="search" value="{{$search}}">
   &nbsp;
    <button type="submit">Search</button>
</div>
</form>
         <br><br>
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
                      <td><strong>Category Name</strong></td>
                      <td><strong>Type</strong></td>
                      <td><strong>Ads Title</strong></td>
                      <td><strong>Description</strong></td>
                      <td><strong>Price</strong></td>
                       <td><strong>Condition</strong></td>
                      <td><strong>Image</strong></td>
                      <td><strong>Status</strong></td>
                      <td><strong>Action</strong></td>
                    </tr>
                 
                	@foreach ($data as $user)
                  <tr>
                  	  <td>{{$user->c_name}}</td>
                      <td>{{$user->type}}</td>
                      <td>{{$user->ptitle}}</td>
                      <td>{{$user->description}}</td>
                      <td>{{$user->price}}</td>
                       <td>{{$user->condition_type}}</td>
                       <td>
                         @if($user->image!="")

                          @php $a = explode(",",$user->image); @endphp
                           <a href="{{ url('showdata')}}/{{$user->id}}">
                       
                          <img class="thumbnail no-margin" src="{{ url('public/image') }}/{{ $a[0] }}" alt="img" height="30px" width="30px">
                    
                         @else
                         <p>Noimage</p>
                         @endif
                      </td>
                    <td>
                      @if($user->status=='Pendding')
                    
                     <p style="color:orange" >Pendding</p>
                     
                     @endif

                      @if($user->status=='Active')
                    
                     <p style="color:green" >Active</p>
                     
                     @endif

                      @if($user->status=='Decline')
                    
                     <p style="color:red" >Decline</p>
                     
                     @endif

                       @if($user->status=='Blocked')
                    
                     <p style="color:red" >Blocked</p>
                     
                     @endif
                   </td>
                   <td>
                    @if($user->status=='Pendding')
                      <a href ='changestatusads/{{ $user->id }}'><button type="submit"  id="approve" name="approve" class="mj_btn btn btn-success" value="active">Approve</button></a>

                      <a href ='changestatusadsdec/{{ $user->id }}'><button type="submit"  id="decline" name="decline" class="mj_btn btn btn-danger" value="decline" >Decline</button></a>
                    @elseif($user->status=='Decline')

                    @elseif($user->status=='Active')
                          <a href ='changestatusads/{{ $user->id }}'><button type="submit"  id="blocked" name="blocked" class="mj_btn btn btn-danger" value="blocked" >Blocked</button></a>
                    @elseif($user->status=='Blocked')
                         <a href ='changestatusads/{{ $user->id }}'><button type="submit"  id="active" name="active" class="mj_btn btn btn-success" value="active" >Active</button></a>
                    
                    @endif   
                   </td>
                 </tr>
              	@endforeach
                @if(count($data)<=0)
                   <td colspan="10" style="color: black;"><center><b style="font-size: 20px;">Result Not Found</b></center></td>
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
@endsection