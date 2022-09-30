@extends('layout.Admin.admincontent')
@section('title')
Seller detail
@endsection
@section('body')

<div class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
 <div class="content-wrapper">
    <section class="content"><div class="container">
    	<br>
       <p  style="font-size:24px"><strong>Seller Detail</strong></p>
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
                      <td><strong>Id</strong></td>
                      <td><strong>Profile Image</strong></td>
                      <td><strong>First Name</strong></td>
                      <td><strong>Last Name</strong></td>
                      <td><strong>Email</strong></td>
                      <td><strong>Address</strong></td>
                      <td><strong>City</strong></td>
                       <td><strong>State</strong></td>
                      <td><strong>Phone</strong></td>
                      <td><strong>Message</strong></td>
                      <td><strong>Status</strong></td>
                   </tr>
                 
                	@foreach ($data as $user)
                  <tr>
                     <td>{{$user->id}}</td>
                     <td>
                         @if($user->profile_image!="")
                              <img class="thumbnail no-margin" src="{{ url('public/image') }}/{{ $user->profile_image }}" alt="img" height="30px" width="30px">
                    
                         @else
                         <p>Noimage</p>
                         @endif
                       </td>
                  	   <td>{{$user->fname}}</td>
                       <td>{{$user->lname}}</td>
                       <td>{{$user->email}}</td>
                       <td>{{$user->address}}</td>
                       <td>{{$user->city}}</td>
                       <td>{{$user->StateName}}</td>
                       <td>{{$user->phone}}</td>
                       <td>


                     @if(count($data1->where('receiver_id','=',$user->id)))
                      
                        <a href ='adminshowsellermessage/{{ $user->id }}'><button type="submit"  id="message" name="message" class="mj_btn btn btn-primary" >Message</button></a>

                      @else
                       <label >No Message</label>
                      @endif
                        <td>
                  @if($user->status=='Active')
                    <a href ='sellerchangestatus/{{ $user->id }}'><button type="submit"  id="active" name="active" class="mj_btn btn btn-success" value="Active" >Active</button></a>
                  @elseif($user->status=='Blocked')
                      <a href ='sellerchangestatus/{{ $user->id }}'><button type="submit"  id="blocked" name="blocked" class="mj_btn btn btn-danger" value="Blocked">Blocked</button></a>
                  @else
                      <p style="color:red" >Closed</p>
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
