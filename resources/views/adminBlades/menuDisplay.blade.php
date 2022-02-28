@extends('Layout.dashboard')
@section('content')



  <div class="sals-boxes">
  

   
  @if ($message = Session::get('success'))
  <div class="alert alert-success">
      <p>{{ $message }}</p>
  </div>
@endif


@if ($message = Session::get('danger'))
<div class="alert alert-danger">
  <p>{{ $message }}</p>
</div>
@endif
<div class="col-lg-12 margin-tb">
            
    <div class="float-end">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">Add New Item</button>
        {{-- <a class="btn btn-danger" href="{{ route('multiple_delete') }}">Delete Selected</a> --}}
      
    </div>
    <br/>
    
</div><br/>


<form role="search"  class="app-search d-none d-md-block me-3">
    <input type="text" id="myInput" placeholder="Search for food item..." onkeyup="myFunction()"class="form-control mt-0">

</form>

 
  <table class="table table-striped table-hover table-sm" width="60%" id="myTable">
      <tr>

          <th>Food</th>
          <th>Price</th>
          <th>Action</th>
      </tr>
    <input type="hidden" name="total" id="sum-price">
    <input type="hidden" name="food_ids" id="id-food_ids">
    <input type="hidden" value="{{ $i = 0 }}">

      @foreach ($menuTable as $menu)
      
     <tr data-foodPrice="{{ $menu->price }}" data-foodID = {{ $menu->id }}>
         

          <td> {{ $menu->name }}</td>
          <td>{{ $menu->price }}</td>
          <td> 
           
            <form action="{{ route('order.destroy',$menu->id) }}" method="POST">
      
                @csrf
                <a class="button" href="{{ route('order.show', $menu->id) }}"><span><i class="far fa-address-card" aria-hidden="true"></i></span></a>

                {{ method_field('DELETE') }}                 
  
                <button type="submit" class="btn delete" onclick="if (!confirm('{{ $menu->name }} will be permanently deleted, are you sure?')) { return false }">
                  <span><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                
                
            </form>
        </td>
            
      </tr>
      @endforeach 
     
     
     
  </table>          

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
                            <input type="text" class="form-control p-0 border-0" name="name" > 
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Item Price</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" class="form-control p-0 border-0" name="price"> 
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


    
    {{-- {!! $users->links() !!} --}}
  
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
