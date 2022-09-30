 @extends('layout.seller.content')
@section('content')

    <label class="theme-switcher theme-switcher-left-right">
    	<span class="theme-switcher-label" data-on="Dark Off" data-off="Dark Mode"></span>
    	<span class="theme-switcher-handle"></span>
    </label>
     <div class="intro" style="background-image: url(public/images/bg3.jpg);">
        <div class="dtable hw100">
            <div class="dtable-cell hw100">
                <div class="container text-center">
                    <h1 class="intro-title animated fadeInDown"> Find Cloth Chain Ads </h1>

                   

                </div>
            </div>
        </div>
    </div>
     <div class="main-container">
        <div class="container">

            <div class="col-xl-12 content-box ">
                <div class="row row-featured row-featured-category">
                    <div class="col-xl-12  box-title no-border">
                        <div class="inner"><h2><span>Browse by</span>
                            Category <a href="{{ url('category') }}" class="sell-your-item"> View more <i
                                    class="  icon-th-list"></i> </a></h2>
                        </div>
                    </div>

                    <div class="col-xl-2 col-md-3 col-sm-3 col-xs-4 f-category">
                        <a href="{{ url('men') }}"><img src="public/images/man.jpg" class="img-responsive"
                                                     alt="img">
                            <h6> Men </h6></a>
                    </div>

                    <div class="col-xl-2 col-md-3 col-sm-3 col-xs-4 f-category">
                        <a href="{{ url('woman') }}"><img src="public/images/woman1.png" class="img-responsive"
                                                     alt="img"> <h6> Woman </h6></a>
                    </div>
                    </div>
                </div>

            <div style="clear: both"></div>
            <div class="col-xl-12 content-box ">
                <div class="row row-featured">
                    <div style="clear: both"></div>
                    <div class="tab-lite relative w100">
                        <ul class="nav nav-tabs " role="tablist">
                            <li role="presentation" class="active nav-item"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab" class="nav-link"><i class="icon-location-2"></i> Top Locations</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tab1">
                                <div class="col-xl-12 tab-inner">
                                    <div class="row">
                                        <ul class="cat-list col-md-3  col-6 col-xxs-12">
                                            @foreach($data as $st)
                                             @if ($st->StateID == 0)
                                                   @continue
                                               @endif
                                               <li><a href="{{ url('substate') }}/{{$st->StateName}}">{{$st->StateName}}</a>
                                            </li>
                                               @if ($st->StateID == 9)
                                                   @break
                                            @endif
                                         @endforeach
                                        </ul>
                                        <ul class="cat-list cat-list-border col-md-3  col-6 col-xxs-12">
                                            @foreach($data as $st)
                                                 @if ($st->StateID > 9)
                                                  <li><a href="{{ url('substate') }}/{{$st->StateName}}">{{$st->StateName}}</a>
                                            </li>
                                            @endif
                                                   @if ($st->StateID == 9)
                                                   @continue
                                               @endif
                                               @if ($st->StateID == 18)
                                                   @break
                                                   @endif
                                            @endforeach
                                        </ul>
                                        <ul class="cat-list cat-list-border col-md-3  col-6 col-xxs-12">
                                            @foreach($data as $st)
                                                 @if ($st->StateID > 18)
                                                  <li><a href="{{ url('substate') }}/{{$st->StateName}}">{{$st->StateName}}</a>
                                            </li>
                                            @endif
                                                   @if ($st->StateID == 18)
                                                   @continue
                                               @endif
                                               @if ($st->StateID == 27)
                                                   @break
                                                   @endif
                                           
                                            @endforeach
                                        </ul>
                                        <ul class="cat-list cat-list-border col-md-3  col-6 col-xxs-12">
                                            @foreach($data as $st)
                                                 @if ($st->StateID > 27)
                                                  <li><a href="{{ url('substate') }}/{{$st->StateName}}">{{$st->StateName}}</a>
                                            </li>
                                            @endif
                                                   @if ($st->StateID == 27)
                                                   @continue
                                               @endif
                                                 @if ($st->StateID == 35)
                                                   @break
                                                   @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="tab2">
                                <div class="col-xl-12 tab-inner">
                                    <div class="row">
                                        <ul class="cat-list cat-list-border col-md-3  col-6 col-xxs-12">
                                             @foreach($data as $st)
                                                 @if ($st->StateID == 11)
                                                   @continue
                                               @endif
                                                <li><a href="{{ url('substate') }}/{{$st->StateName}}">{{$st->StateName}}</a>
                                            </li>
                                               @if ($st->StateID == 19)
                                                   @break
                                                   @endif 
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
               
    <!-- /.main-container -->
    <div class="page-info hasOverly" style="background: url(public/images/bg.jpg); background-size:cover">
        <div class="bg-overly">
            <div class="container text-center section-promo">
                <div class="row">
                    <div class="col-sm-3 col-xs-6 col-xxs-12">
                        <div class="iconbox-wrap">
                            <div class="iconbox">
                                <div class="iconbox-wrap-icon">
                                    <i class="icon  icon-group"></i>
                                </div>
                                <div class="iconbox-wrap-content">
                                    <h5><span>{{count($sel)}}</span></h5>

                                    <div class="iconbox-wrap-text">Trusted Seller</div>
                                </div>
                            </div>
                          </div>
                    </div>

                    <div class="col-sm-3 col-xs-6 col-xxs-12">
                        <div class="iconbox-wrap">
                            <div class="iconbox">
                                <div class="iconbox-wrap-icon">
                                    <i class="icon  icon-th-large-1"></i>
                                </div>
                                <div class="iconbox-wrap-content">
                                    <h5><span>{{count($cat)}}</span></h5>

                                    <div class="iconbox-wrap-text">Categories</div>
                                </div>
                            </div>
                         </div>
                      </div>
                 <div class="col-sm-3 col-xs-6  col-xxs-12">
                        <div class="iconbox-wrap">
                            <div class="iconbox">
                                <div class="iconbox-wrap-icon">
                                    <i class="icon  icon-map"></i>
                                </div>
                                <div class="iconbox-wrap-content">
                                    <h5><span>{{count($data)}}</span></h5>

                                    <div class="iconbox-wrap-text">Location</div>
                                </div>
                            </div>
                          </div>
                     </div>
                    </div>
                </div>
        </div>
    </div>
    <!-- /.page-info -->

    <div class="page-bottom-info">
        <div class="page-bottom-info-inner">

            <div class="page-bottom-info-content text-center">
                <h1>If you have any questions, comments or concerns, please contact us <a href="{{ url('contactus') }}" style="color: white;"><u>here.</u></a>


                </h1>
<!--                 <a class="btn  btn-lg btn-primary-dark" href="tel:+000000000">
                    <i class="icon-mobile"></i> <span class="hide-xs color50">Call Now:</span> (000) 555-5555 </a> -->
            </div>
        </div>
    </div>
@endsection

<!-- Le javascript
================================================== -->

<!-- Placed at the end of the document so the pages load faster -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/js/jquery/jquery-3.3.1.min.js">\x3C/script>')</script>
<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets/js/vendors.min.js"></script>

 include custom script for site  -->
<!-- <script src="assets/js/main.min.js"></script>



include jquery autocomplete plugin 

<script type="text/javascript" src="assets/plugins/autocomplete/jquery.mockjax.js"></script>
<script type="text/javascript" src="assets/plugins/autocomplete/jquery.autocomplete.js"></script>
<script type="text/javascript" src="assets/plugins/autocomplete/usastates.js"></script>

<script type="text/javascript" src="assets/plugins/autocomplete/autocomplete-demo.js"></script> -->