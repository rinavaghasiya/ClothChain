 @extends('layout.seller.content')
 @section('title')
Profile
@endsection
@section('content')
<div class="main-container inner-page">
        <div class="container">
            <div class="section-content">
                <div class="inner-box ">
                    <div class="row">
                    	<div class="col-sm-6">
                            <div class="seller-info seller-profile">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="seller-profile-img">
                                            <a>
                                             @if(Session::get('user_image')=='')
                                             <a> <img src="{{ url('public/images/user1.png') }}" height="100" width="100"></a>
                                             @else
                                             <img src="{{ url('public/image') }}/{{ $a->profile_image }}" alt="" height="100" width="100"> </a>
                                              @endif
                                        </div>
                                    </div>
                                        <div class="col-md-9">
                                            <h3 class="no-margin no-padding link-color uppercase "> {{$a->fname}} {{$a->lname}}</h3>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                        	<div class="seller-contact-info">
                        		<h3 class="no-margin uppercase color-danger"> Contact Information </h3>
                        		<dl class="dl-horizontal">
                                    <dt>Address:</dt>
                                    <dd class="contact-sensitive"> {{$a->address}}
                                    </dd>
                                    <dt>City:</dt>
                                    <dd class="contact-sensitive"> {{$a->city}}
                                    </dd>
                                   
                                    <dt>Mobile:</dt>
                                    <dd class="contact-sensitive">{{$a->phone}}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="section-block">
                    <div class="row">
                        <div class="col-sm-12 col-thin-left page-content ">

                            <div class="category-list">
                                <div class="tab-box ">
                                	<ul class="nav nav-tabs add-tabs" role="tablist">
                                        <li class="active nav-item"><a href="#allAds" role="tab" data-toggle="tab" class="nav-link">User all ads <span class="badge badge-pill badge-secondary">{{count($allads)}}</span></a>
                                        </li>
                                    </ul>
                                   <form action="" method="get">
                                   	<div class="tab-filter">
                                <select id="myddl" onchange='this.form.submit()' name="myddl" title="sort by" class="selectpicker semyddllect-sort-by" data-style="btn-select" 
                                        data-width="auto">
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
                                    <div class="pull-left col-xs-6">
                                        <div class="breadcrumb-list"><a href="#" class="current">
                                            <span>All ads</span></a> <a href="#selectRegion"  id="dropdownMenu1" data-toggle="modal"> <span class="caret"></span> </a></div>
                                    </div>
                                    <div class="pull-right col-xs-6 text-right listing-view-action"><span
                                            class="list-view active"><i class="  icon-th"></i></span> <span
                                            class="compact-view"><i class=" icon-th-list  "></i></span> <span
                                            class="grid-view "><i class=" icon-th-large "></i></span></div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="tab-content">
                            <div class="tab-pane  active " id="alladslist">
                            <div class="adds-wrapper row no-margin">
                            <div class="item-list">
                               
                                <div class="row" id="all_row">
                                      @foreach($data as $image) 
                                     
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
                                            <h5 class="add-title"><a href="{{ url('adsdetail') }}">

                                               {{$image->ptitle}} </a></h5>

                            <span class="info-row"> 
                            <span class="date"><i class=" icon-clock"> </i> {{ date('d-M-y', strtotime($image->created_at))}}</span> <span class="category">{{$image->c_name}} </span>-
                                 <span class="item-location"><i class="fa fa-map-marker-alt"></i> {{$image->StateName}}
                            </span>
                         </span>
                                        </div>
                                    </div>
                                     <div class="col-md-3 text-right  price-box">
                                        <h2 class="item-price">Rs.{{$image->price}} </h2>
                                    </div>
                                    @endforeach
                                     @if(count($data)<=0)
                                     <div class="col-md-7">
                                    <span style="color: red;"><b style="font-size: 20px;">No More Product</b></span>
                                </div>
                                    @endif
                                    </div>
                                     </div>
                                      </div>
                                </div>
                        </div>
                    </div>
                           <div class="pagination-bar text-center" id="all1">
                        <nav aria-label="Page navigation " class="d-inline-b">
                            <ul class="pagination">
                            	<li class="page-item active">{{$data->appends(\Request::except('_token'))->render() }}</li>
                               </ul>
                           </nav>
                    </div>

                          </div>
                           </div>
                </div>
            </div>
        </div>
    </div>


<script src="../../../../cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/js/jquery/jquery-3.3.1.min.js">\x3C/script>')</script>
<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets/js/vendors.min.js"></script>
<script src="assets/js/main.min.js"></script>

<div class="modal fade" id="contactAdvertiser" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class=" icon-mail-2"></i> Contact advertiser </h4>

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Close</span></button>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="form-group">
						<label for="recipient-name" class="control-label">Name:</label>
						<input class="form-control required" id="recipient-name" placeholder="Your name"
							   data-placement="top" data-trigger="manual"
							   data-content="Must be at least 3 characters long, and must only contain letters."
							   type="text">
					</div>
					<div class="form-group">
						<label for="sender-email" class="control-label">E-mail:</label>
						<input id="sender-email" type="text"
							   data-content="Must be a valid e-mail address (user@gmail.com)" data-trigger="manual"
							   data-placement="top" placeholder="email@you.com" class="form-control email">
					</div>
					<div class="form-group">
						<label for="recipient-Phone-Number" class="control-label">Phone Number:</label>
						<input type="text" maxlength="60" class="form-control" id="recipient-Phone-Number">
					</div>
					<div class="form-group">
						<label for="message-text" class="control-label">Message <span class="text-count">(300) </span>:</label>
						<textarea class="form-control" id="message-text" placeholder="Your message here.."
								  data-placement="top" data-trigger="manual"></textarea>
					</div>
					<div class="form-group">
						<p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not
							valid. </p>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-success pull-right">Send message!</button>
			</div>
		</div>
	</div>
</div>

@endsection
