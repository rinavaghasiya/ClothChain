@extends('layout.seller.content')
@section('title')
Pending Approval
@endsection
@section('content')

<div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-3 page-sidebar">
                    <aside>
                        <div class="inner-box">
                            <div class="user-panel-sidebar">
                                <div class="collapse-box">
                                    <h5 class="collapse-title no-border"> My Classified <a class="pull-right"                                                                                           href="#MyClassified"><i
                                            class="fa fa-angle-down"></i></a></h5>
                                   
                                    <div id="MyClassified" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                            <li><a href="{{ url('selleraccounthome') }}"><i class="icon-home"></i> Personal Home </a>
                                            </li>
                                            <li><a href="{{ url('sellerprofile') }}"><i class="fas fa-user"></i> Profile </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <!-- /.collapse-box  -->
                                <div class="collapse-box">
                                    <h5 class="collapse-title"> My Ads <a class="pull-right" aria-expanded="true"  data-toggle="collapse"
                                                                          href="#MyAds"><i class="fa fa-angle-down"></i></a>
                                    </h5>

                                    <div id="MyAds" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                            <li><a href="{{ url('accountmyads') }}"><i class="icon-docs"></i> My ads <span
                                                    class="badge">{{count($data2)}}</span> </a></li>

                                            <li><a href="{{ url('addproduct') }}"><i
                                                    class="fa fa-product-hunt"></i> Post Ads <span
                                                    class="badge">{{count($data1)}}</span></a></li>
                                            
                                            <li class="active"><a href="{{ url('pendingapproval') }}"><i
                                                    class="icon-hourglass"></i> Pending approval <span
                                                    class="badge">{{count($pen)}}</span></a></li>

                                             <li><a href="{{ url('decline') }}"><i class="fa fa-ban" aria-hidden="true"></i> Decline Product <span
                                                    class="badge">{{count($decline)}}</span></a></li>

                                                <li class=""><a href="{{ url('accountmessageinbox') }}"><i
                                                    class="icon-mail"></i> Message Inbox <span
                                                    class="badge">{{count($inbox)}}</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <!-- /.collapse-box  -->
                                <div class="collapse-box">
                                    <h5 class="collapse-title"> Terminate Account <a class="pull-right" aria-expanded="true"  data-toggle="collapse" href="#TerminateAccount"><i class="fa fa-angle-down"></i></a></h5>

                                    <div id="TerminateAccount" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                            <li><a href="{{ url('accountclose') }}"><i class="icon-cancel-circled "></i> Close
                                                account </a></li>
                                        </ul>
                                    </div>
                                </div>
                                 </div>
                        </div>
                       </aside>
                </div>
                 <div class="col-md-9 page-content">
                    <div class="inner-box">
                        <h2 class="title-2"><i class="icon-hourglass"></i> Pending approval </h2>

                        <div class="table-responsive">
                            <div class="table-action">
                               
                                <div class="table-search pull-right col-sm-7">
                                    <div class="form-group">
                                         <form class="form-horizontal"  action = "{{ url('pendingapproval') }}" >
                                        <div class="row">
                                           {{ csrf_field() }}
                                              <div class="col-sm-7 searchpan">
                                                <input type="text" class="form-control"  name="search" id="search" value="{{$search}}">
                                            </div>&nbsp;&nbsp;
                                             <button type="submit">Search</button>
                                        
                                        </div>
                                    </div>
                                     </form>
                                </div>
                            </div>
                            <table id="addManageTable"
                                   class="table table-striped table-bordered add-manage-table table demo"
                                   data-filter="#filter" data-filter-text-only="true">
                                <thead>
                                <tr>
                                   
                                    <th> Photo</th>
                                    <th data-sort-ignore="true"> Adds Details</th>
                                    <th data-type="numeric"> Price</th>
                                    <th> Option</th>
                                </tr>
                                </thead>
                                <tbody>
                                 @foreach($data as $image)   
                                <tr>
                                    @php $a = explode(",",$image->image); @endphp
                                   
                                    <td style="width:14%" class="add-img-td">
                                        <a href="{{ url('adsdetail') }}/{{ $image->p_id }}">
                                            @foreach($a as $b)
                                             <img
                                            class="thumbnail  img-responsive"
                                            src="{{ url('public/image') }}/{{ $b }}"

                                            alt="img">
                                           @endforeach
                                        </a></td>
                                            
                                    <td style="width:14%" class="add-img-td">
                                    <strong>{{$image->ptitle}}</strong><br><br>
                                        {{$image->description}}<br><br>
                                     <strong>Posted On: </strong><span>{{ date('d-M-y', strtotime($image->created_at)) }}</span>
                                    <br><br>
                                    <strong>Located In: </strong>
                                    <span>{{$image->StateName}}</span>         
                                    <!-- {{$image->description}} -->
                                     </td>
                                   <td style="width:14%" class="add-img-td"><strong>Rs.</strong>{{$image->price}}</td>

                                   
                                    <td style="width:10%" class="action-td">
                                        <div>
                                            <a href ='deleteproduct/{{ $image->p_id }}'><button type="submit" class="btn btn-danger">Delete</button></a>
                                        </div>
                                    </td> 
                                    @endforeach
                                   
                                      @if(count($data)<=0)
                                    <td colspan="4" style="color: red;"><center><b style="font-size: 20px;">No More Product</b></center></td>
                                    @endif
                                </tr>
                              
                                </tbody>
                            </table>
                        </div>
                       </div>
                </div>
              </div>
         </div>
        </div>
@endsection