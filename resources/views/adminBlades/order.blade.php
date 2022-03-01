@extends('Layout.dashboard')
@section('content')

<div class="sals-boxes">
  <div class="col-lg-12 margin-tb">
    <div class="float-start">
      <h2>The Menu</h2>
     
  </div> 
<br/>    
    <div class="float-end">
   
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">Add New Item</button>
        <a class="btn btn-success" href="{{ route('showMenuItems') }}">Edit Menu</a>
      
    </div>
 
    <br/>
    
</div>
<br/>
<br/>
<form role="search"  class="app-search d-none d-md-block me-3">
    <input type="text" id="myInput" placeholder="Search for food item..." onkeyup="myFunction()"class="form-control mt-0">
 
</form>


<form id="order-form" method="POST" action="{{ route('order.store') }}">
    {{-- <form id="order-form" method="POST" action=""> --}}
@csrf
<small>Select staff to which order belogs</small>
<div class="dropdown">
  <button class="btn btn-primary"  data-bs-toggle="dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
    Staff
  </button>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
 
    @foreach($users as $users)
    <table>
      <thead>
        <tbody>
          <div id="staff">
          <tr data-id="{{$users->id}}" data-name="{{$users->username}}">
            
     <td> 
       
         <input type="radio" class="radio" name="staff_names[]" 
      value="{{ $users->firstname }}"></td> 
  
    <td><a class="dropdown-item" href="#">{{$users->firstname}}</a></td>
          </tr>
          <div>
        </tbody>
      </thead>
    </table>
    @endforeach
 
  </div>

</div>

  @if ($message = Session::get('success'))
  <div class="alert alert-success " style="width:70%">
      <p>{{ $message }}</p>
  </div>
@endif

@if($message = Session::get('danger'))
<div class="alert alert-danger" style="width: 70%">
  <p>{{ $message }}</p>
</div>

@endif

  <table class="table table-striped table-hover table-sm"  style =width: 60% id="myTable">
      <tr>

          <th>Food</th>
          <th>Price</th>
          <th width="28px">Action</th>
          
      </tr>
    <input type="hidden" name="total" id="sum-price">
    <input type="hidden" name="food_ids" id="id-food_ids">
    <input type="hidden" name="staff_name" id="staff_id">
    <input type="hidden" name="actual_staff_name" id="staff_name">
    <input type="hidden" value="{{ $i = 0 }}">

      @foreach ($menuTable as $menu) 
       
      
     <tr data-foodPrice="{{ $menu->price }}" data-foodID = {{ $menu->id }}>
         

          <td> {{ $menu->name }}</td>
          <td>@php 
          $num_price = number_format($menu->price)
           @endphp
           {{$num_price}}
          </td>
          <td class="text-center"> 
            <input type="hidden" name="checkbox[]" class="check" value="0">  
            <input type="checkbox" class="check" name="checkbox[]" value="{{ $menu->price }} ">
          
            </tr>
     
      @endforeach 
  
     
      <tr style="font-size: x-large;">
        <td colspan="2">TOTAL COST </td>
        <td colspan="2"><strong id="total_amount"></strong></td>
        
      </tr><br />
      <tr>
        <td colspan="4">
          <button type = "submit" class="btn btn-success btn-lg order-btn" id="order-btn">Order Now</button>
        </td>
      </tr>
     
  </table>
</form>
  
     <!-- Modal for adding a new item -->

     <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createModalLabel">Fill the form!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              
    <!-- Start Create form  -->
    <form class="form-horizontal form-material" method="POST" action="{{ route('createMenuItem') }}">
     @csrf
      
      <div class="form-group mb-4">
          <label class="col-md-12 p-0">Item Name</label>
          <div class="col-md-12 border-bottom p-0">
              <input type="text" class="form-control p-0 border-0" name="name" required > 
          </div>
      </div>
      <div class="form-group mb-4">
          <label class="col-md-12 p-0">Item Price</label>
          <div class="col-md-12 border-bottom p-0">
              <input type="text" class="form-control p-0 border-0" name="price" required> 
          </div>
      </div>
      <div class="form-group mb-4">
          <div class="col-sm-12">
              <button class="btn btn-success" >Create</button>
          </div>
      </div>
    </form>
    <!-- End Create form  -->
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           
          </div>
        </div>
      </div>
    </div> 
    
    <!-- End of New food item Modal -->
  
  </div>
  
  @endsection
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script> 



 
<script>

$(document).ready(function() {

     let total = 0;
     let foodIds = [];
     $(document).on('click', 'input.check', function() {
       const foodID = $(this).closest('tr').attr('data-foodID') 
       const foodPrice = $(this).closest('tr').attr('data-foodPrice')
     
       if ($(this).is(":checked")) {
       
         foodIds.push(foodID)
        
         total += parseInt(foodPrice);
         $("#total_amount").html(total);
      
         $("#sum-price").val(total)
       } else {
   
         total -= parseInt(foodPrice);
         const indexToRemove = foodIds.indexOf(foodID)
         foodIds.splice(indexToRemove, 1)
         $("#total_amount").html(total)
         $("#sum-price").val(total)
       }

     })

$(document).on('click', 'input.radio', function() {
  const all = $('.radio');
  let user_Ids = [];
  const userid = $(this).closest('tr').attr('data-id');
  const username = $(this).closest('tr').attr('data-name');
    if ('$(input[type=radio]:checked)'){
  
  alert("You are making an order for "+ username)
 
    }
    const form = $("#order-form")
     form.on('submit', function (e) {
       const selectedFoods = JSON.stringify(foodIds)
       const selected_staff = userid
       const selected_staff_name = username

       $("#id-food_ids").val(selectedFoods)
     $("#staff_id").val(selected_staff)
     $("#staff_name").val(selected_staff_name)
       const formData = form.serializeArray()
   
     })
});


   });
   

   //.....Search text area....//
   function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
//.....End of Search text area....//
  </script>
