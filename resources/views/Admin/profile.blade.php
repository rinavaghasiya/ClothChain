@extends('layout.Admin.admincontent')
@section('title')
Profile
@endsection
@section('body')

<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img  class="profile-user-img img-fluid img-circle" src="{{ URL::asset('public/image') }}/{{ Session::get('admin_profile_image') }}" alt="" >
                </div>
                <h3 class="profile-username text-center">{{Session::get('admin_name')}}</h3>
                <p class="text-muted text-center">Software Engineer</p>
              </div>
              </div>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>
                <p class="text-muted">
                 Master of Computer Application from Gujarat Technological University(GTU)
                </p>
                <hr>
                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                <p class="text-muted">Surat, Gujarat</p>
                <hr>
                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong><p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>
                <hr>
              </div>
              </div>
            </div>
          <div class="col-md-9">
            <div class="card">
              <!-- <div class="card-header p-2">
                <ul class="nav nav-pills"> -->
                
                 <!--  <li class="nav-item"><a class="nav-link" href="{{ url('adminprofile') }}" data-toggle="tab">Settings</a></li> -->
              <!--   </ul>
              </div> -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  <div class="tab-pane" id="settings">
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
                   <form class="form-horizontal" action="{{ url('profileupdate') }}" method="post" enctype='multipart/form-data' >
          {{ csrf_field() }}
      <div class="form-group">
        <input type="hidden" class="form-control" name="id" id="id" value="{{ $a->id }}">
      <label>Name</label>
      <input type="text" class="form-control" placeholder="Name"  onkeypress="return checkNum(event)"  name="name" id="name" value="{{ $a->name }}"><p id="name_validation"></p>
      </div>

      <div class="form-group">
      <label>Email </label>
      <input type="text" class="form-control" placeholder="Email" name="email" id="email" value="{{ $a->email }}"><p id="email_validation"></p>
      </div>
      
      <div class="form-group">
      <label>Profile Picture</label>
     <div>
      <img id="blah" src="{{ url('public/image') }}/{{ $a->profile_image }}" alt="" height="100" width="100" />
      <br><br><input type = 'file' id="imgInp" name="image" value="{{$a->profile_image}}" />
    <input type="hidden"  name="oldimg" id="oldimg" value="{{ $a->profile_image }}">            
       <br><br>
                      <div class="form-group row">
                        <div class="offset-sm-0 col-sm-10">
                         <button type="submit" class="btn btn-primary">Save</button> <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                      </div>
                    </form>
                  </div>
                 </div>
               </div>
            </div>
            </div>
          </div>
        </div>
    </section>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type ="text/javascript">

function readURL(input, imgControlName) 
        {
          if (input.files && input.files[0]) 
          {
            var reader = new FileReader();
            reader.onload = function(e) 
            {
             
              $(imgControlName).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          }
        }

    $("#imgInp").change(function() {
      var imgControlName = "#blah";
      readURL(this, imgControlName);
    
    });

function checkNum(event)
{

   if ((event.keyCode > 64 && event.keyCode < 91) || (event.keyCode > 96 && event.keyCode < 123) || event.keyCode == 8)
      return true;
   else
   {
       return false;
   }

}

   
$("#name").focusout(function()
   {
      var name = $("#name").val();
   if(name == '')
   {
      $("#name").css({"border-color": "red", "border-style":"solid"});
      document.getElementById("name_validation").innerHTML = "<font style=color:red> Please enter name</font>";
   }
   else 
     {
      var a=/^[A-Za-z\s]+$/;

      if(!name.match(a))
      {
         $("#name").css({"border-color": "red","border-style":"solid"});
      document.getElementById("name_validation").innerHTML = "<font style=color:red>Name can have only alphabets, spaces and dashes</font>";
      }
      else
      {
         $("#name").css({"border-color": "black","border-style":"solid"});
      document.getElementById("name_validation").innerHTML = "<font style=color:white></font>";
      }

   }
});

 $("#email").focusout(function()
   {
      var email = $("#email").val();
   if(email == '')
   {

      $("#email").css({"border-color": "red","border-style":"solid"});
      document.getElementById("email_validation").innerHTML = "<font style=color:red> Please enter email</font>";
   }
   else if(email !='')
   {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z]{2,4})+$/;
      if(!regex.test(email))
      {
         $("#email").css({"border-color": "red","border-style":"solid"});
      document.getElementById("email_validation").innerHTML = "<font style=color:red>Enter valid email</font>";
      }
      else
      {
         $("#email").css({"border-color": "black","border-style":"solid"});
      document.getElementById("email_validation").innerHTML = "<font style=color:white></font>";
      }
   }
});

</script>
  @endsection


