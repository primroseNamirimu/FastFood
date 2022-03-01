@extends('Layout.dashboard')
@section('content')

<div class="sals-boxes">
  <div class="col-lg-12 margin-tb">
    <div class="float-start">
      <h2>The Menu</h2>
  </div>     
 
</div>
<form role="search"  class="app-search d-none d-md-block me-3">
    <input type="text" id="myInput" placeholder="Search for food item..." onkeyup="myFunction()"class="form-control mt-0">
 
</form>


<form id="order-form" method="POST" action="{{ route('order.store') }}">
    {{-- <form id="order-form" method="POST" action=""> --}}
@csrf

  @if ($message = Session::get('success'))
  <div class="alert alert-success">
      <p>{{ $message }}</p>
  </div>
@endif

@if(Session::has('fail'))
<div class="alert alert-danger">{{Session::get('fail')}}
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
    <input type="hidden" value="{{ $i = 0 }}">

      @foreach ($menuTable as $menu)
      
     <tr data-foodPrice="{{ $menu->price }}" data-foodID = {{ $menu->id }}>
         

          <td> {{ $menu->name }}</td>
          <td>@php
          $num_price = number_format($menu->price)
          @endphp
          {{$num_price}}</td>
          <td class="text-center"> 
            <input type="hidden" name="checkbox[]" class="check" value="0">  
            <input type="checkbox" class="check" name="checkbox[]" value="{{ $menu->price }} ">
               {{-- <form action="{{ route('order.destroy',$menu->id) }}" method="POST">
               
                @csrf
              
              {{-- </form>  --}}
          {{-- </td> --}}
      </tr>
      @endforeach 
     
      <tr style="font-size: x-large;">
        <td colspan="2">TOTAL COST </td>
        <td colspan="2"><strong id="total_amount"></strong></td>
        
      </tr><br />
      <tr>
        <td colspan="4">
          <button type = "submit" class="btn btn-success btn-lg order-btn" id="order-btn">Order now </button>
        </td>
      </tr>
     
  </table>
</form>
  
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
         $("#total_amount").html(total)
         $("#sum-price").val(total)
       } else {
   
         total -= parseInt(foodPrice);
         const indexToRemove = foodIds.indexOf(foodID)
         foodIds.splice(indexToRemove, 1)
         $("#total_amount").html(total)
         $("#sum-price").val(total)
       }

     })
     const form = $("#order-form")
     form.on('submit', function (e) {
       const selectedFoods = JSON.stringify(foodIds)
       console.log(selectedFoods)
       $("#id-food_ids").val(selectedFoods)
       const formData = form.serializeArray()
       console.log(formData)
     })

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
