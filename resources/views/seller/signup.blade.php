@extends('layout.seller.content')
@section('content')
<div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-8 page-content">
                    <div class="inner-box category-content">
                        <h2 class="title-2"><i class="icon-user-add"></i> Create your account, Its free </h2>
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
                                
                                <form class="form-horizontal" action = "{{ url('insert') }}" method = "post" enctype="multipart/form-data">
                                     {{ csrf_field() }}
                                    <fieldset>

                                       <div class="form-group  row required">
                                         <label class="col-md-4 control-label">User Type <sup>*</sup></label>
                                        <div class="col-sm-6">
                                            <select name="type" id="type" class="form-control">
                                                <option value="0" selected="selected"> Select a Type...</option>
                                                <option value="S"> Seller </option>
                                                <option value="B"> Buyer </option>

                                            </select>
                                        </div>
                                    </div>



                                      <div class="form-group  row required">
                                            <label class="col-md-4 control-label">First Name <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <input name="fname" placeholder="First Name" class="form-control input-md"
                                                      id='fname' onkeypress="return checkNum(event)" required="" type="text"><p id="name_validation" ></p>
                                            </div>
                                        </div>
                                         <div class="form-group  row required">
                                            <label class="col-md-4 control-label">Last Name <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <input name="lname" placeholder="Last Name"
                                                       class="form-control input-md" type="text" id='lname' onkeypress="return checkNum(event)" /><p id="lname_validation" ></p>
                                            </div>
                                        </div>
                                         <div class="form-group  row required">
                                            <label for="inputEmail3" class="col-md-4 control-label">Email
                                                <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <input type="email" name="email" class="form-control" id="email"
                                                       placeholder="Email"><p  id="email_validation" ></p>
                                            </div>
                                        </div>

                                        <div class="form-group  row required">
                                            <label for="inputPassword3" class="col-md-4 control-label">Password </label>

                                            <div class="col-md-6">
                                                <input type="password" name="password" class="form-control" id="password"
                                                       placeholder="Password"><p id="password_validation" ></p>
                                                       <small id="passwordHelpBlock" class="form-text text-muted">
                                                        At least 5 characters
                                                      </small>
                                            </div>
                                        </div>
                                           <div class="form-group row">
                                            <label class="col-md-4 control-label">Gender</label>

                                            <div class="col-md-6">
                                                <div class="radio">
                                                    <label for="Gender-0">
                                                        <input name="gender" id="Gender-0" value="Male" checked="checked"
                                                               type="radio">
                                                        Male </label>
                                                </div>
                                                <div class="radio">
                                                    <label for="Gender-1">
                                                        <input name="gender" id="Gender-1" value="Female" type="radio">
                                                        Female </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label" for="textarea">Address</label>

                                            <div class="col-md-6">
                                                <textarea class="form-control" id="textarea" name="address" placeholder="Address"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group  row required">
                                            <label class="col-md-4 control-label">City <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <input name="city" placeholder="City"
                                                       class="form-control input-md" type="text" id='city' onkeypress="return checkNum(event)" /><p id="city_validation" ></p>
                                            </div>
                                        </div>
                                         <div class="form-group  row required">
                                            <label class="col-md-4 control-label">State <sup>*</sup></label>
                                             <div class="col-md-6">
                                                      <select  name="state" id="state" class="form-control">
                                                    <option value="">Select State</option>
                                                  @foreach($state as $mystate)
                                                    <option value="{{$mystate->StateID}}">{{$mystate->StateName}}</option>
                                                    @endforeach</select>
                                              </div>
                                            </div>
                                            <div class="form-group  row required">
                                            <label class="col-md-4 control-label">Phone Number <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <input name="phone" placeholder="Phone Number"
                                                       class="form-control input-md " type="text" onkeypress="return isNumber(event)" maxlength="10" id="phone" ><p id="Mobile_validate"></p>
                                            </div>
                                        </div>
                                        <div class="form-group  row required">
                                            <label class="col-md-4 control-label">Profile_Picture <sup>*</sup></label>
                                            <div class="col-md-6">
                                               <input id="imgInp" type='file' name="image" value = "Choose image" />
                                    <img id="blah" src="#" alt="" height="50px" width="50px" />

                                  </div>
                                </div>
                                <div class="form-group row">
                                            <label class="col-md-4 control-label"></label>
                                            <div class="col-md-8">
                                              <div style="clear:both"></div>
                                                <input type="submit" class="btn btn-primary" name="register" value="Register">
                                            </div>
                                        </div>
                                    </fieldset>
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

  function readURL(input) 
   {
  if (input.files && input.files[0]) 
  {
    var reader = new FileReader();
    
    reader.onload = function(e)
     {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
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

   
$("#fname").focusout(function()
   {
      var name = $("#fname").val();
   if(name == '')
   {
      $("#fname").css({"border-color": "red", "border-style":"solid"});
      document.getElementById("name_validation").innerHTML = "<font style=color:red> Please enter name</font>";
   }
   else 
     {
      var a=/^[A-Za-z\s]+$/;

      if(!name.match(a))
      {
         $("#fname").css({"border-color": "red","border-style":"solid"});
      document.getElementById("name_validation").innerHTML = "<font style=color:red>Name can have only alphabets, spaces and dashes</font>";
      }
      else
      {
         $("#fname").css({"border-color": "black","border-style":"solid"});
      document.getElementById("name_validation").innerHTML = "<font style=color:white></font>";
      }

   }
});


$("#lname").focusout(function()
   {
      var name = $("#lname").val();
   if(name == '')
   {
      $("#lname").css({"border-color": "red", "border-style":"solid"});
      document.getElementById("lname_validation").innerHTML = "<font style=color:red> Please enter name</font>";
   }
   else if(name !='')
   {
      var a=/^[A-Za-z\s]+$/;

      if(!name.match(a))
      {
         $("#lname").css({"border-color": "red","border-style":"solid"});
      document.getElementById("lname_validation").innerHTML = "<font style=color:red>Name can have only alphabets, spaces and dashes</font>";
      }
      else
      {
         $("#lname").css({"border-color": "black","border-style":"solid"});
      document.getElementById("lname_validation").innerHTML = "<font style=color:white></font>";
      }

   }
});

$("#city").focusout(function()
   {
      var name = $("#city").val();
   if(name == '')
   {
      $("#city").css({"border-color": "red", "border-style":"solid"});
      document.getElementById("city_validation").innerHTML = "<font style=color:red> Please enter city</font>";
   }
   else 
     {
      var a=/^[A-Za-z\s]+$/;

      if(!city.match(a))
      {
         $("#city").css({"border-color": "red","border-style":"solid"});
      document.getElementById("city_validation").innerHTML = "<font style=color:red>city can have only alphabets, spaces and dashes</font>";
      }
      else
      {
         $("#city").css({"border-color": "black","border-style":"solid"});
      document.getElementById("city_validation").innerHTML = "<font style=color:white></font>";
      }

   }
});

$("#state").focusout(function()
   {
      var name = $("#state").val();
   if(name == '')
   {
      $("#state").css({"border-color": "red", "border-style":"solid"});
      document.getElementById("state_validation").innerHTML = "<font style=color:red> Please enter state</font>";
   }
   else 
     {
      var a=/^[A-Za-z\s]+$/;

      if(!state.match(a))
      {
         $("#state").css({"border-color": "red","border-style":"solid"});
      document.getElementById("state_validation").innerHTML = "<font style=color:red>state can have only alphabets, spaces and dashes</font>";
      }
      else
      {
         $("#state").css({"border-color": "black","border-style":"solid"});
      document.getElementById("state_validation").innerHTML = "<font style=color:white></font>";
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

   $("#password").focusout(function()
   {
      var password = $("#password").val();
      if(password == '')
      {
         $("#password").css({"border-color": "red","border-style":"solid"});
         document.getElementById("password_validation").innerHTML = "<font style=color:red> Please enter password</font>";
      }
      else 
      {
         var b = password.length;
         if(b == 5)
         {
            $("#password").css({"border-color": "black","border-style":"solid"});
            document.getElementById("password_validation").innerHTML = "<font style=color:white></font>";
           
         }
         else
         {
             $("#password").css({"border-color": "red","border-style":"solid"});
         document.getElementById("password_validation").innerHTML = "<font style=color:red>Enter only 5  characher password</font>";
         }
      }

  } );  
   


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

  </script>

@endsection
