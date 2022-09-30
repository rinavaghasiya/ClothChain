@extends('layout.seller.content')
@section('title')
MenSubCategoty
@endsection
@section('content')

<div class="search-row-wrapper" style="background-image: url(../public/images/bg.jpg)">
<div class="inner">
        <div class="container ">
            <form action="#" method="GET">
                <div class="row">
                 <div class="col-md-3">
                       </div>
                     <form action="" method="get">
                    <div class="col-sm-4 searchpan">
                        <input type="text" class="form-control" name="search" value="{{$search}}" id="search">
                    </div>
                     <div class="col-md-2">
                        <button class="btn btn-block btn-primary btn-gradient"> Search <i class="fa fa-search"></i>
                        </button>
                    </div>
                    </form> 
                </div>
            </form>
        </div>
        </div>
    </div>

 <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-3 page-sidebar mobile-filter-sidebar">
                    <aside>
                        <div class="sidebar-modern-inner">
                            <div class="block-title has-arrow sidebar-header">
                                <h5><a href="#">All Categories</a></h5>
                            </div>
                            <div class="block-content categories-list  list-filter ">
                                <ul class=" list-unstyled">
                                    @foreach($cat as $ct)
                                    <li><a href="{{ url('mensubcategory') }}/{{$ct->c_name}}"><span class="title">{{$ct->c_name}}</span><span class="count">&nbsp;</span></a>
                                    </li>
                                    @endforeach
                                   
                                </ul>
                            </div> 
                             <div class="block-title has-arrow ">
                                <h5><a href="#">Location</a></h5>
                            </div>
                            <div class="block-content locations-list  list-filter ">
                                <ul class="browse-list list-unstyled long-list">
                                    @foreach($state as $st)
                                    <li><a href="{{ url('menstate') }}/{{$st->StateName}}"> {{$st->StateName}} </a></li>
                                    @endforeach
                                    
                                 </ul>
                            </div>
                            <div class="block-title has-arrow">
                                <h5><a href="#">Price range</a></h5>
                            </div>
                            <div class="block-content categories-list  list-filter ">

                               <form role="form"  action = "" method="get" class="form-inline ">
                                    {{ csrf_field() }}
                                    <div class="form-group col-lg-4 col-md-12 no-padding">
                                        <input type="text" id="mmin" name="mmin" value="{{ Request::get('mmin') }}" placeholder="Min Rs." id="minPrice" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-1 col-md-12 no-padding text-center hidden-md"> -</div>
                                    <div class="form-group col-lg-4 col-md-12 no-padding">
                                        <input type="text" id="mmax" value="{{ Request::get('mmax') }}" name="mmax" placeholder="Max Rs. " id="maxPrice" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-3 col-md-12 no-padding">
                                        <button class="btn btn-default pull-right btn-block-md" type="submit">GO
                                        </button>
                                    </div>
                                </form>
                                <div style="clear:both"></div>
                            </div>
                             <div class="block-title has-arrow">
                                <h5><a href="#">Condition</a></h5>
                            </div>
                            <div class="block-content categories-list  list-filter ">
                                <ul class="browse-list list-unstyled ">
                                    <li><a >New <span class="count">{{count($data1)}}</span></a>
                                    </li>
                                    <li><a >Used <span class="count">{{count($data2)}}</span></a>
                                    </li>
                                   
                                </ul>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                     </aside>
                </div>
               <div class="col-md-9 page-content col-thin-left">
                <div class="category-list ">
                    <div class="tab-box ">
                        <ul class="nav nav-tabs add-tabs tablist" role="tablist">
                                <li class="nav-item">
                                    <a href="{{ url('category') }}"  id="all">All Ads <span class="badge badge-pill badge-secondary">{{count($call)}}</span></a>
                                </li>
                                <li class=" active nav-item">
                                    <a href="{{ url('men') }}" data-toggle="tab" class="nav-link active"  id="men"> Men <span class="badge badge-pill badge-secondary">{{count($men)}}</span></a>
                                </li>
                                <li class=" nav-item">
                                    <a href="{{ url('woman') }}"  id="woman"> Woman <span class="badge badge-pill badge-secondary">{{count($cwoman)}}</span></a>
                                </li>
                            </ul>


                           <form action="" method="get">

                            <div class="tab-filter">
                                <select id="myddl" onchange='this.form.submit()' name="myddl" title="sort by" class="selectpicker semyddllect-sort-by" data-style="btn-select" 
                                        data-width="auto">
                                   <!--  <option value=" ">Sort by</option> -->
                                    <option value="1" @if($sort == 1) selected @endif>Price Low to High
                                    </option>
                                    <option value="2" @if($sort == 2) selected @endif>Price High to Low
                                    </option>
                                    <p>detail</p>
                                </select>
                            </div>
                        </form>

                        </div>
                         <div class="listing-filter">
                           
                            <div class="pull-right col-xs-6 text-right listing-view-action"><span
                                    class="list-view active"><i class="  icon-th"></i></span> <span
                                    class="compact-view"><i class=" icon-th-list  "></i></span> <span
                                    class="grid-view "><i class=" icon-th-large "></i></span></div>
                            <div style="clear:both"></div>
                        </div>
                        <div class="mobile-filter-bar col-xl-12  ">
                            <ul class="list-unstyled list-inline no-margin no-padding">
                                <li class="filter-toggle">
                                    <a class="">
                                        <i class="  icon-th-list"></i>
                                        Filters
                                    </a>
                                </li>
                                <li>
                                 <div class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle"> Short by </a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="#" rel="nofollow">Relevance</a>
                                        </li>
                                        <li class="dropdown-item"><a href="#" rel="nofollow">Date</a>
                                        </li>
                                        <li class="dropdown-item"><a href="#" rel="nofollow">Company</a>
                                        </li>
                                    </ul>
                                    </div>

                                </li>
                            </ul>
                        </div>
                        <div class="menu-overly-mask"></div>
                         <div class="tab-content">
                            <div class="tab-pane  active " id="alladslist">
                            <div class="adds-wrapper row no-margin">
                            <div class="item-list">
                               
                                <div class="row" id="men_row" >
                                      @foreach($men as $image) 
                                     
                                     @php $a = explode(",",$image->image); @endphp
                                    <div class="col-md-2 no-padding photobox">
                                     
                                         
                                        <div class="add-image"><span class="photo-count"><i class="fa fa-camera"></i> </span>
                                          <a href="{{ url('adsdetail')}}/{{$image->p_id}}">
                                           
                                            <img class="thumbnail no-margin" src="{{ url('public/image') }}/{{ $a[0] }}" alt="img">
                                        </a>
                                        </div>
                                     
                                    </div>
                                    <div class="col-md-7 add-desc-box">
                                        <div class="ads-details">
                                            <h5 class="add-title"><a href="{{ url('adsdetail') }}/{{$image->p_id}}">

                                               {{$image->ptitle}} </a></h5>
                         <span class="info-row"> <span class="add-type business-ads tooltipHere" data-toggle="tooltip" data-placement="right" title="Business Ads">B </span>
                                    <span
                                            class="date"><i class=" icon-clock"> </i> {{ date('d-M-y', strtotime($image->created_at)) }}</span>&nbsp; <span class="category">{{$image->c_name}} </span>-
                                        <span
                                                class="item-location"><i class="fa fa-map-marker-alt"></i> {{$image->StateName}}</span>
                                            </span>
                                        </div>
                                    </div>
                                     <div class="col-md-3 text-right  price-box">
                                        <h2 class="item-price">Rs.{{$image->price}} </h2>
                                     </div>
                                  
                                     @endforeach
                                </div>
                                   @if(count($men)<=0)
                                 <center><span style="color: black;"><b style="font-size: 20px;">Result Not Found</b></span></center>
                                @endif
                            </div>
                            </div>
                                </div>
                        </div>
                    </div>
                    <div class="pagination-bar text-center" id="men1" >
                        <nav aria-label="Page navigation " class="d-inline-b">
                            <ul class="pagination">

                                <li class="page-item active">{{$men->appends(\Request::except('_token'))->render() }}</li>
                                  
                            </ul>
                        </nav>
                    </div>
                   
                  </div>
               </div>
        </div>
    </div>
@endsection