<nav class="navbar  fixed-top navbar-site navbar-light bg-light navbar-expand-md"
             role="navigation">
            <div class="container">

            <div class="navbar-identity">


               
                 <a href="{{url('/')}}" class="navbar-brand logo logo-title">
                <span class="logo-icon"> <img src="{{ url('public/images/logo-3.png') }}">
                </span></a>


                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggler pull-right"
                        type="button">

                    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 30 30" width="30" height="30" focusable="false"><title>Menu</title><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/></svg>


                </button>

            </div>

                <div class="navbar-collapse collapse">
                    
                    <ul class="nav navbar-nav ml-auto navbar-right">

                        <li class="nav-item"><a href="{{ url('category') }}" class="nav-link"><i class="icon-th-thumb"></i> All Ads</a>
                        </li>
                        

                         <li class="dropdown no-arrow nav-item"><a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        {{ Session::get("user_fname") }}
                        {{ Session::get("user_lname") }}
                        {{ Session::get("user_fname1") }}
                        {{ Session::get("user_lname1") }}

                        @if(Session::has('user_fname1'))
                         @if(Session::get('user_image1')!='')<img src="{{ url('public/image') }}/{{ Session::get('user_image1')}}" height="20px" width="20px">
                             @else
                             <img src="{{ url('public/images/user1.png') }}" height="20px" width="20px">
                             @endif<i class=" icon-down-open-big fa"></i></a>
                            <ul
                                class="dropdown-menu user-menu dropdown-menu-right">
                                <li class="active dropdown-item"><a href="{{ url('accounthome') }}"><i class="icon-home"></i> Personal Home

                                </a>
                                </li>
                                   
                               @if(Session::has('user_fname1'))
                              
                                    <li class="dropdown-item"><a href="{{ url('logout') }}"><i class="icon-logout" ></i>Log out </a>
                                    </li>
                                @else
                                   <li class="dropdown-item"><a href="{{ url('main') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                                   </li> 
                                @endif

                            </ul>
 
                        @else
                             <span></span>
                             @if(Session::get('user_fname')!='')
                            @if(Session::get('user_image')!='')
                             <img src="{{ url('public/image') }}/{{ Session::get('user_image')}}" height="20px" width="20px">
                             @else
                              <img src="{{ url('public/images/user1.png') }}" height="20px" width="20px">
                             @endif
                             @else
                             <!-- <img src="{{ url('public/images/user1.png') }}" height="20px" width="20px"> -->

                            @endif<i class=" icon-down-open-big fa"></i></a>
                            <ul class="dropdown-menu user-menu dropdown-menu-right">
                               
                                
                               @if(Session::has('user_fname'))
                                <li class="dropdown-item"><a href="{{ url('selleraccounthome') }}"><i class="icon-home"></i> Personal Home

                                </a> </li>
                               <li class="dropdown-item"><a href="{{ url('accountmyads') }}"><i class="fas fa-band-aid"></i> My ads </a>
                                </li>

                                 <li class="dropdown-item"><a href="{{ url('addproduct') }}"> <i class="fa fa-product-hunt"></i>Post Ads </a>
                                </li>  

                                <li class="dropdown-item"><a href="{{ url('pendingapproval') }}"><i class="icon-hourglass"></i> Pending Approval </a>
                                </li>

                                   <li class="dropdown-item"><a href="{{ url('decline') }}"><i class="fa fa-ban" aria-hidden="true"></i> Decline Product </a></li>
                                
                               
                                <li class="dropdown-item"><a href="{{ url('notification') }}"><i class="fa fa-bell" aria-hidden="true"></i> Notification  <span
                                                    class="badge">{{Session::get('noti')}}</span></a>
                                </li>

                                <li class="dropdown-item"><a href="{{ url('sellerlogout') }}"><i class="icon-logout" ></i>Log out </a>
                                    </li>
                                @else
                                 <li class="active dropdown-item"><a href="{{ url('signup') }}"><i class="icon-home"></i> Registration  </a> </li>
                                   <li class="dropdown-item"><a href="{{ url('main') }}"><i class="fas fa-sign-in-alt"></i>Login</a>
                                   </li> 
                                @endif


                            </ul>


                        @endif

                        </li>

                       
                        
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
            <!-- /.container-fluid -->
</nav>
 

<!-- include custom script for site  -->

  @yield('script')