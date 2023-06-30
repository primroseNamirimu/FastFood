@extends('Layout.dashboard2')
@section('content')
<div class="row justify-content-between mb-4">
    <div class="col-xl-3 col-lg-4">

    </div>

</div>
                        <div class="sals-boxes">

                                @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                        @endif
                                <form class="form-horizontal form-material" action=" ">
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0"><b>Full Names</b></label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input readonly type="text" class="form-control p-0 border-0" >{{ $user->lastname }} {{ $user->firstname }}
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0"><b>Username</b></label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" class="form-control p-0 border-0" name="example-email" id="example-email">{{ $user->username }}
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0"><b>Email</b></label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" class="form-control p-0 border-0" name="example-email" id="example-email">{{ $user->email }}
                                        </div>
                                    </div>
                                    {{-- <div class="form-group mb-4">
                                        <label class="col-md-12 p-0"><b>Password</b></label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" value="password" class="form-control p-0 border-0">
                                        </div>
                                    </div> --}}
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0"><b>Phone No</b></label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" class="form-control p-0 border-0">{{ $user->phone }}
                                        </div>
                                    </div>


                                </form>
                                <div class="form-group mb-4">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Update Profile</button>
                                    </div>
                                </div>
                            </div>

                    <!-- Column -->


                <!-- Modal for updating the profile -->

 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Fill in the details you wish to change</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

 <!-- Start Update form  -->
 <form class="form-horizontal form-material" method="POST" action="{{ route('admin-actions.update',$user->id) }}">
   @csrf
    {{ method_field('PATCH') }}
    <div class="form-group mb-4">
        <label class="col-md-12 p-0">First Name</label>
        <div class="col-md-12 border-bottom p-0">
            <input type="text" class="form-control p-0 border-0" name="firstname" value="{{ $user->firstname }}">
        </div>
    </div>
    <div class="form-group mb-4">
        <label class="col-md-12 p-0">Last Name</label>
        <div class="col-md-12 border-bottom p-0">
            <input type="text" class="form-control p-0 border-0" name="lastname" value="{{ $user->lastname }}">
        </div>
    </div>
    <div class="form-group mb-4">
        <label for="username" class="col-md-12 p-0">Username</label>
        <div class="col-md-12 border-bottom p-0">
            <input type="text" class="form-control p-0 border-0" name="username"  value="{{ $user->username }}">
        </div>
    </div>
    <div class="form-group mb-4">
        <label for="example-email" class="col-md-12 p-0">Email</label>
        <div class="col-md-12 border-bottom p-0">
            <input type="email" class="form-control p-0 border-0" name="email" value="{{ $user->email }}">
        </div>
    </div>
    {{-- <div class="form-group mb-4">
        <label class="col-md-12 p-0">Password</label>
        <div class="col-md-12 border-bottom p-0">
            <input type="password" value="password" class="form-control p-0 border-0">
        </div>
    </div> --}}
    <div class="form-group mb-4">
        <label class="col-md-12 p-0">Phone No</label>
        <div class="col-md-12 border-bottom p-0">
            <input type="text" class="form-control p-0 border-0" name="phone" value="{{ $user->phone }}">
        </div>
    </div>

    <div class="form-group mb-4">
        <div class="col-sm-12">
            <button class="btn btn-success" >Update Profile</button>
        </div>
    </div>
</form>
 <!-- End Update form  -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>

  <!-- End of Modal -->



                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    {{-- <script src="{{ url('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ url('bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('js/app-style-switcher.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ url('js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ url('js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ url('js/custom.js') }}"></script> --}}

    <script>


    </script>
    @endsection
