@extends('Layout.dashboard2')
@section('content')
<div class="row justify-content-between mb-4">
    <div class="col-xl-3 col-lg-4">

    </div>
</div>
<div class="sals-boxes">
    @if ($errors->any())
    <div class="alert alert-danger" style="width: 40%">
        <ul>
            @foreach ($errors->all() as $error)
            @if($error == 'validation.alpha_num')
            <li>Password should contain numbers and characters</li>
            @elseif($error == 'validation.min.string')
            <li>Password should be more than 8 characters long</li>
            @elseif($error == 'validation.confirmed')
            <li> Passwords do not match</li>
            @else
            <li>{{ $error }}</li>
            @endif

            @endforeach
        </ul>
    </div>
    @endif
    <form class="form-horizontal form-material" method="POST"
          action="{{ route('updatePassword',$user->id) }}">
        @csrf
        <div class="form-group mb-4">
            <label class="col-md-12 p-0"><b>Old Password</b></label>
            <div class="col-md-12 border-bottom p-0">
               <label for="old-pass"><input type="password" value="" id="old-pass" name="old-password"
                             class="form-control p-0 border-0"></label>
                <span style="float:right;"><input type="checkbox" onclick="oldPass()"> Show Password</span>
            </div>
            <br>

        </div>
        <div class="form-group mb-4">
            <label class="col-md-12 p-0"><b>New Password</b></label>
            <div class="col-md-12 border-bottom p-0">
                <label for="new-pass"><input type="password" value="" id="new-pass" name="password"
                              class="form-control p-0 border-0"></label> <span style="float: right"> <label><input type="checkbox" onclick="newPass()"> Show Password</label></span>
            </div>
            <ul>
                <li>- Should be more than 8 characters long</li>
                <li>- Can contain both numbers and characters</li>
            </ul>
        </div>
        <div class="form-group mb-4">
            <label class="col-md-12 p-0"><b>Confirm Password</b></label>
            <div class="col-md-12 border-bottom p-0">
                <label for="confirm-pass"><input type="password" value="" name="password_confirmation" id="confirm-pass"
                                                 class="form-control p-0 border-0"></label>
                <span style="float: right"><input type="checkbox" onclick="confirmPass()"> Show Password</span>
            </div>
            <br>

        </div>

        <div class="form-group mb-4">
            <div class="col-sm-12">
                <button class="btn btn-success">Update Password</button>
                <span style="float: right"><button class="btn btn-success" onclick="history.back()"><i class="icon-arrow-left-circle"></i> Go Back</button></span>

            </div>

        </div>

    </form>
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

    function confirmPass() {
        let x = document.getElementById("confirm-pass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

</script>
@endsection
