@extends('Layout.dashboard2')

@section('content')

<div class="row justify-content-between mb-4">
    <div class="col-xl-3 col-lg-4">
<!--        <h2 class="page-heading">Hi, Welcome Back!</h2>-->
<!--        <p class="mb-0">Digital Solutions Food Portal </p>-->
    </div>
</div>
<div class="sals-boxes">

    <div class="row">

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

    </div>
    <br/>

    <div class="table-responsive">

        <table class="table verticle-middle table-responsive-lg mb-0" id="myTable">
            <thead>
            <tr>
                <th>ORDER ID</th>
                <th>Order For</th>
                <th>Original Order</th>
                <th>Created At</th>
                <th>Modified Order</th>
                <th>Changed By</th>
                <th>Reason</th>
                <th>Modified On</th>

            </tr>
            </thead>
            <tbody>

            @foreach ($changedOrder as $item)
            <tr>
                <td>{{ $item->order_id }}</td>
                <td>{{ $item->lastname }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->order_created_at }}</td>
                @foreach($modified as $i)
                <td> {{$i->name}} </td>
                @endforeach
                <td>{{ $item->changed_by }}</td>
                <td>{{ $item->reason }}</td>
                <td>{{ $item->created_at }}</td>



            </tr>
            @endforeach
            </tbody>

        </table>
    </div>

 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fill in the form</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

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

      <script>
        $(document).ready(function(){
            $.noConflict();
            //DATA TABLES
            let reportTable = $('#myTable');
            let reportDataTable = reportTable.DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]

            });
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



</script>

@endsection
