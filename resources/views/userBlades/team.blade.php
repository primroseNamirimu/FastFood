@extends('Layout.dashboard')
 
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<style>
  

  #myInput {
  background-image: url('/css/searchicon.png'); /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 100%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
}
</style>
 

<div class="sals-boxes">
   
    <div class="row">
        
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="col-lg-12 margin-tb">
            
            <div class="float-end">
              <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Create New User</button>
               <a href="{{ route('disabled-users') }}" ><button class="btn btn-success">Disabled Users</button></a>
               {{-- <a class="btn btn-danger" href="{{ route('multiple_delete') }}">Delete Selected</a>       --}}
            </div>
            
        </div>
       
    </div>
    <br/>
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by email">
   
    <table class="table table-bordered" id="myTable">
        <tr>
            <th><input type ="checkbox" name ="checkbox[]" onchange="checkAll(this)" id="checkAll"></th>
            <th>Username</th>
            <th>email</th>
           
           
            <th>Action</th>
        </tr>
        
        <input type="hidden" value="{{ $i = 0 }}">

        @foreach ($users as $userData)
        <tr>
           
            
            <td ><input type="checkbox" class="checkboxes"  onchange='checkChange();' value="{{ $userData->id }}"></td>
            <td>{{ $userData->username }}</td>
            <td>{{ $userData->email }}</td>
            
           
            <td>
                <form action="{{ route('admin-actions.destroy',$userData->id) }}" method="POST">
                   
                    <a class="btn" href="{{ route('admin-actions.show',$userData->id) }}"><span><i class="far fa-address-card" aria-hidden="true"></i></a>

                    
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}                 
      
                    <button type="submit" data-bs-toggle="popover" data-bs-content="Click to disable user" class="btn delete" onclick="if (!confirm('{{ $userData->firstname }} will be permanently disabled, are you sure?')) { return false }">
                      <span><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                    
                    
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fill in the form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
<!-- Start Create New User form  -->
<form class="form-horizontal form-material" method="POST" action="{{ route('admin-actions.store') }}">
 @csrf
 
  <div class="form-group mb-4">
      <label class="col-md-12 p-0">First Name</label>
      <div class="col-md-12 border-bottom p-0">
          <input type="text" class="form-control p-0 border-0" name="firstname"> 
      </div>
  </div>
  <div class="form-group mb-4">
      <label class="col-md-12 p-0">Last Name</label>
      <div class="col-md-12 border-bottom p-0">
          <input type="text" class="form-control p-0 border-0" name="lastname"> 
      </div>
  </div>
  <div class="form-group mb-4">
      <label for="username" class="col-md-12 p-0">Username</label>
      <div class="col-md-12 border-bottom p-0">
          <input type="text" class="form-control p-0 border-0" name="username">
      </div>
  </div>
  <div class="form-group mb-4">
      <label for="example-email" class="col-md-12 p-0">Email</label>
      <div class="col-md-12 border-bottom p-0">
          <input type="email" class="form-control p-0 border-0" name="email" >
      </div>
  </div>
  <div class="form-group mb-4">
      <label class="col-md-12 p-0">Password</label>
      <div class="col-md-12 border-bottom p-0">
          <input type="password" name="password" class="form-control p-0 border-0">
      </div>
  </div>
  <div class="form-group mb-4">
    <label class="col-md-12 p-0">Confirm Password</label>
    <div class="col-md-12 border-bottom p-0">
        <input type="password" name="confirm_password" class="form-control p-0 border-0">
    </div>
</div>
  <div class="form-group mb-4">
      <label class="col-md-12 p-0">Phone No</label>
      <div class="col-md-12 border-bottom p-0">
          <input type="text" class="form-control p-0 border-0" name="phone" >
      </div>
  </div>

  <div class="form-group mb-4">
      <div class="col-sm-12">
          <button class="btn btn-success"> Create</button>
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
<!--End create modal -->
    
<div class="modal fade" id="disabledUsers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Disabled users</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
<!-- start table  -->
<table class="table table-bordered" id="disabledUsersTable">
  <tr>
      <th><input type ="checkbox" name ="checkbox[]" onchange="checkAll(this)" id="checkAll"></th>
      <th>Username</th>
      <th>email</th>
      <th>Action</th>
  </tr>
  
  <input type="hidden" value="{{ $i = 0 }}">

  @foreach ($users as $userData)
  <tr>
     
      
      <td ><input type="checkbox" class="checkboxes"  onchange='checkChange();' value="{{ $userData->id }}"></td>
      <td>{{ $userData->username }}</td>
      <td>{{ $userData->email }}</td>
      
     
      <td>
    
          <form action="{{ route('admin-actions.destroy',$userData->id) }}" method="POST">
             
              <a class="btn" href="{{ route('admin-actions.show',$userData->id) }}"><span><i class="far fa-address-card" aria-hidden="true"></i></a>

              
              {{ csrf_field() }}
              {{ method_field('DELETE') }}                 

              <button type="submit" class="btn delete" onclick="if (!confirm('{{ $userData->firstname }} will be permanently disabled, are you sure?')) { return false }">
                <span><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
              
              
          </form>
      </td>
  </tr>
  @endforeach
</table>
<!-- End table  -->
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div> 
<!-- End of Disabled Users Modal -->
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script> 
      <script>
        $(document).ready(function(){
          
          $('[data-bs-toggle="popover"]').popover();
        });
        </script>
        


    <script>
      // Set check or unchecked all checkboxes
 function checkAll(e) {
   var checkboxes = document.getElementsByName('checkbox[]');
 
   if (e.checked) {
     for (var i = 0; i < checkboxes.length; i++) { 
       checkboxes[i].checked = true;
     }
   } else {
     for (var i = 0; i < checkboxes.length; i++) {
       checkboxes[i].checked = false;
     }
   }
 }
 
 function checkChange(){

    var totalCheckbox = document.querySelectorAll('input[name="checkbox[]"]').length;
    var totalChecked = document.querySelectorAll('input[name="checkbox[]"]:checked').length;

    // When total options equals to total checked option
    if(totalCheckbox == totalChecked) {
       document.getElementsByName("showhide")[0].checked=true;
    } else {
       document.getElementsByName("showhide")[0].checked=false;
    }
 }


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
    td = tr[i].getElementsByTagName("td")[1];
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
      
@endsection 
