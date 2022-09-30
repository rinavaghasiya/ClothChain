<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

   

    <ul class="navbar-nav ml-auto">
     
    </ul>
    </nav>

   <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{ URL::asset('public/dist/assets/img/AdminLTELogo.png') }}" alt="Admin Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Cloth Chain-Admin</span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ URL::asset('public/image') }}/{{ Session::get('admin_profile_image') }}" class="img-circle elevation-2" alt="">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Session::get('admin_name')}}</a>
        </div>
      </div>
      <div ></div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
              
          <li class="nav-item">
            <a href="{{url('adminprofile')}}" class="nav-link">
             <i class="fas fa-user"></i>
              <p>
                Profile
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('adminshowcategory')}}" class="nav-link">
             <i class="fa-list-alt "> </i>
              
              <p>
                Category
              </p>
            </a>
          </li>

      @php $c1=Session::get('penstatus') @endphp
          <li class="nav-item">
            <a href="{{url('adminshowpost')}}" class="nav-link">
              <i class="fas fa-ad"></i>
              
              <p>
                Show Post Ads
              </p>
               <span class="badge badge-danger navbar-badge">{{$c1}}</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('adminshowseller')}}" class="nav-link">
             <i class="fas fa-user"> </i>
              
              <p>
                Seller Detail
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('adminshowbuyer')}}" class="nav-link">
             <i class="fas fa-user"> </i>
              
              <p>
                Buyer Detail
              </p>
            </a>
          </li>

            <li class="nav-item">
            <a href="{{url('adminlogout')}}" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
         </ul>
      </nav>
         <nav class="mt-5">
      
         </nav>

      <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
  </aside>
 

  </div>
