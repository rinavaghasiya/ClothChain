@extends('layout.admin.content')
@section('body')
<div class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    

    <!-- Main content -->
    <section class="content"><div class="container">
 <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><font color="red">Services List </font></h3>
                 <button type="submit" class="btn btn-primary"><a href="{{ url('admin/add_services') }}" style="color: white">Add</a></button> 
               </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                 <tr>
                      <td>Name</td>
                      <td>Price</td>
                      <td>Status</td>
                      <td>Edit</td>
                      <td>Delete</td>
                  </tr>
                  <tr>
                  <td>{{$service->service_name}}</td>
                  <td>{{$service->price}}</td>
                 <td>
                     @if($service->status=='1')
                     <input type="button" value="Active">
                     @else
                     <input type="button" value="Blocked">
                     @endif
                  </td>
                  <td><button type="submit" class="btn btn-primary">Edit</button> </td>
                  <td><button type="submit" class="btn btn-primary">Delete</button></td>
                 </tr>
                </table>
                
                </div>
                <hr></div> 
                <div class="card">
              <div class="card-header">
                
                 <h3 class="card-title"><font color="red">Option List</font></h3>
                 <button type="submit" class="btn btn-primary"><a href="{{ url('admin/add_option') }}" style="color: white">Add</a></button> 
               </div>
               <div>
                <table class="table table-hover">
                 <tr>
                      <td>Name</td>
                      <td>Price</td>
                      <td>Status</td>
                      <td>Edit</td>
                      <td>Delete</td>
                  </tr>
                 
                   <tbody>
                   @foreach ($data as $service)
                  <tr>
                  <td>{{$service->option_type}}</td>
                  <td>{{$service->price}}</td>
                 <td>
                     @if($service->status=='1')
                     <input type="button" value="Active">
                     @else
                     <input type="button" value="Blocked">
                     @endif
                  </td>
                  <td><button type="submit" class="btn btn-primary">Edit</button>
                  <td><button type="submit" class="btn btn-primary">Delete</button></td>
                  
                 </tr>
                  @endforeach
                  </tbody> 
                </table>
                </div>

                <hr>
                </div>
                <div class="card">
              <div class="card-header">
                 <h3 class="card-title"><font color="red">Delivery Requesting duration list </font></h3>
                 
               </div>
               <div>
                <table class="table table-hover">
                 <tr>
                      <td>Name</td>
                      <td>Price</td>
                      <td>Status</td>
                      <td>Edit</td>
                      <td>Delete</td>
                  </tr>
                   <tbody>
                  <tr>
                  <td>{{$service->delivery_time_duration}}</td>
                  <td>{{$service->price}}</td>
                 <td>
                     @if($service->status=='1')
                     <input type="button" value="Active" bgcolour="green">
                     @else
                     <input type="button" value="Blocked" bgcolour="red">
                     @endif
                  </td>
                  <td> <button type="submit" class="btn btn-primary"><a href="{{ url('admin/add_delivery_time') }}" style="color: white">Edit</a></button> </td>
                  <td><button type="submit" class="btn btn-primary">Delete</button></td>

                 </tr>
                  </tbody> 
                </table>
                </div>
            </div>
          </div>
        </div>
 </section>
  </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
 <script type="text/javascript">
    jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });
</script>

@endsection