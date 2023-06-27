
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" style="width: 50%">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span
                class="mdi mdi-close"></span>
        </button>
        <strong>Success! </strong> {{$message}}
    </div>
    @endif

    @if($message = Session::get('danger'))
    <div class="alert alert-danger alert-dismissible fade show" style="width: 50%">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span
                class="mdi mdi-close"></span>
        </button>
        <strong>Error!</strong> {{$message}}
    </div>
    @endif
