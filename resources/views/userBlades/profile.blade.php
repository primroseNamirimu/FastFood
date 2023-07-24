@extends('Layout.dashboard2')
@section('content')
<div class="row justify-content-between mb-4">
    <div class="col-xl-3 col-lg-4">

    </div>
</div>
<div class="sals-boxes">

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" style="width: 40%">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span
                class="mdi mdi-close"></span>
        </button>
        <strong>Success! </strong> {{$message}}
    </div>
    @endif

    @if($message = Session::get('danger'))
    <div class="alert alert-danger fade show" style="width: 40%">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span
                class="mdi mdi-close"></span>
        </button>
        <strong>Error!</strong> {{$message}}
    </div>

    @endif
    <form class="form-horizontal form-material" action="{{ route('admin-actions.update',$user->id) }} ">
        <div class="form-group mb-4">
            <label for="example-email" class="col-md-12 p-0"><b>Full Names</b></label>
            <div class="col-md-12 border-bottom p-0">
                <label>
                    <input readonly type="text" class="form-control p-0 border-0"
                           value="&nbsp; {{ $user->lastname }} {{ $user->firstname }}">
                </label>
            </div>
        </div>

        <div class="form-group mb-4">
            <label for="example-email" class="col-md-12 p-0"><b>Username</b></label>
            <div class="col-md-12 border-bottom p-0">
                <input type="text" class="form-control p-0 border-0" name="name" id="username"
                       value="{{ $user->username }}">
            </div>
        </div>
        <div class="form-group mb-4">
            <label for="example-email" class="col-md-12 p-0"><b>Email</b></label>
            <div class="col-md-12 border-bottom p-0">
                <input type="email" class="form-control p-0 border-0" name="email" id="email"
                       value="{{ $user->email }}">
            </div>
        </div>
        <div class="form-group mb-4">
            <label class="col-md-12 p-0"><b>Phone No</b></label>
            <div class="col-md-12 border-bottom p-0">
                <input type="text" class="form-control p-0 border-0" value="{{ $user->phone }}">
            </div>
        </div>

        <div class="form-group mb-4">
            <div class="col-sm-12">
                <button class="btn btn-success">Update Profile</button>
            </div>
        </div>
    </form>

    <div class="form-group mb-4">
        <div class="col-sm-12">
            <a href="{{ route('updateUserPassword',$user->id)}}">
                <button class="btn btn-success">Change Password</button>
            </a>
            <span style="float: right"><button class="btn btn-success" onclick="history.back()"><i class="icon-arrow-left-circle"></i> Go Back</button></span>

        </div>
    </div>

</div>

<script>
    function oldPass() {
        let x = document.getElementById("old-pass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function newPass() {
        let x = document.getElementById("new-pass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function confirm() {
        let x = document.getElementById("confirm-pass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

</script>
@endsection
