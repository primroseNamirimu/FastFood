@extends('Layout.dashboard')
@section('content')


            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Start first frame Column -->
                    
                    <div class="col-lg-4 col-xlg-3 col-md-12">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="{{ url('plugins/images/large/img1.jpg') }}">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="{{ url('plugins/images/users/genu.jpg') }}"
                                                class="thumb-lg img-circle" alt="img"></a>
                                               
                                        <h4 class="text-white mt-2">{{ $user->username }}</h4>
                                        <h5 class="text-white mt-2">{{ $user->email }}</h5>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="user-btm-box mt-5 d-md-flex">
                                <div class="col-md-4 col-sm-4 text-center">
                                    <h1>258</h1>
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <h1>125</h1>
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <h1>556</h1>
                                </div>
                            </div> --}}
                        </div>
                    </div>                    
                    
                    
                    <!-- End first frame Column -->
                    <!-- Start second frame Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" action=" ">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Full Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" class="form-control p-0 border-0"> {{ $user->firstname }} {{ $user->lastname }}
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Username</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" class="form-control p-0 border-0" name="example-email" id="example-email">{{ $user->username }}
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" class="form-control p-0 border-0" name="example-email" id="example-email">{{ $user->email }}
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
                                            <input type="text" class="form-control p-0 border-0">{{ $user->phone }}
                                        </div>
                                    </div>
                                    
                                    
                                </form>
                                <div class="form-group mb-4">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>

                <!-- Modal for updating the profile -->

 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Fill in the details you wish to change</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         
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
    <script src="{{ url('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ url('bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('js/app-style-switcher.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ url('js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ url('js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ url('js/custom.js') }}"></script>

    <script>


    </script>
    @endsection