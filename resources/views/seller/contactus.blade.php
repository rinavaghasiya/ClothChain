@extends('layout.seller.content')
@section('title')
Contact Us
@endsection
@section('content')

<div class="intro-inner">
        <div class="about-intro" style="
    background:url(public/images/c1.jpg) no-repeat center;
  background-size:cover; height: 250px;" >
            
        </div>
      </div>

<div class="main-container" style="padding-top: 0px">
        <div class="container">
            <div class="row" style="padding-left: 270px">
                
                 <div class="col-md-8 page-content">
                    <div class="inner-box category-content">
                     <div class="row">
                            <div class="col-sm-12">
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
                                <form class="form-horizontal" action="{{url('insertcontact')}} " method='post'>
                                  {{ csrf_field() }}
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Name *</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control"  onkeypress="return checkNum(event)" required=""  name="name" id="name" placeholder="Name"><p id="name_validation" ></p>
                                           
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email *</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Email"><p  id="email_validation" >
                                           
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Phone</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" onkeypress="return isNumber(event)" maxlength="10" id="phone" ><p id="Mobile_validate"></p>
                                           
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Message *</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="message" id="message" rows="5" required="" placeholder="Type a message"></textarea>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-8" style="padding-left: 200px">
                                          <center>
                                          <button type="Submit" id="button1id" class="btn btn-success">Submit</button>
                                        &nbsp;<button type="reset" class="btn btn-danger">cancel</button>
                                      </center>
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

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type ="text/javascript">


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

  function checkNum(event)
{

   if ((event.keyCode > 64 && event.keyCode < 91) || (event.keyCode > 96 && event.keyCode < 123) || event.keyCode == 8 || event.keyCode == 32)
      return true;
   else
   {
       return false;
   }
}


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
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
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

function check_email()
{

   var email = $("#email").val();

   if(email !== '')
   {
     function isEmail(email) 
     {
        var regex = /^([a-zA-Z0-9_.+-])+\@@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9] {2,4})+$/;
        return regex.test(email);
     }
   }

   else
   {
   document.getElementById('email_validation').innerHTML = "<font color=red>Please Enter Email</font>";
   $("#email").css("border","1px solid red");
   error_email = true;
   }
}



function check_mobile()
{

   var mobile = $("#phone").val();

   if(mobile !== '')
   {

      if(mobile.length!=10)
      {
      document.getElementById('Mobile_validate').innerHTML = "<font color=red>Please Enter 10 digit Mobile Number!</font>";
      $("#phone").css("border","1px solid red");
      error_mobile = true;
      }
       else
       {
       document.getElementById('Mobile_validate').innerHTML = "<font color=green></font>";
       $("#phone").css("border","1px solid lightblue");
       error_mobile = false;
       }
    }
    else
    {
       document.getElementById('Mobile_validate').innerHTML = "<font color=red>Please Enter Mobile Number!</font>";
       $("#phone").css("border","1px solid red");
       error_mobile = true;
    }
}
function isNumber(evt)
{
   evt = (evt) ? evt : window.event;
   var charCode = (evt.which) ? evt.which : evt.keyCode;
   if (charCode > 31 && (charCode < 48 || charCode > 57)) 
   {
      return false;
   }
   return true;
}

$("#mobile").focusout(function()
   {
    check_mobile();
   });
</script>

@endsection