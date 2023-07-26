@extends('Layout.dashboard2')
@section('content')

<div class="sals-boxes">
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
        <strong>Success!</strong> {{$message}}
    </div>

    @endif

    <!-- Start Update form  -->
    @foreach ($deleteOrder as $item)
    <form class="form-horizontal form-material" action="{{ route('delete',$item->order_id ) }}">
        @csrf
        <div class="form-group mb-4">
            <label class="col-md-12 p-0">Order Belongs To:</label>
            <div class="col-md-12 border-bottom p-0">

                <label>
                    <input type="text" class="form-control p-0 border-0" name="name" value="{{ $item->lastname }} {{ $item->firstname }}">
                </label>
                <label>
                    <input type="hidden" class="form-control p-0 border-0" name="user_id" value="{{ $item->user_id}}">
                </label>

            </div>

        </div>

        <div class="form-group mb-4">
            <label class="col-md-12 p-0">Order Details:</label>
            <div class="col-md-12 border-bottom p-0">

                <label>
                    <input type="text" class="form-control p-0 border-0" name="food_nameText" value="{{ $item->name }}">

                </label>
            </div>
        </div>
            <div class="form-group mb-4">
                <label class="col-md-12 p-0">Made On:</label>
                <div class="col-md-12 border-bottom p-0">

                    <label>
                        <input type="text" class="form-control p-0 border-0" name="name" value="{{ $item->created_at }}">
                    </label>
                </div>
            </div>

        <div class="form-group mb-4">
            <label class="col-md-12 p-0">Ordered By:</label>
            <div class="col-md-12 border-bottom p-0">

                <label>
                    <input type="text" class="form-control p-0 border-0" name="name" value="{{ $item->order_made_by }} ">
                </label>
            </div>
        </div>

        <div class="form-group mb-4">
            <label class="col-md-12 p-0">Reason For Deleting:</label>
            <div class="col-md-12 border-bottom p-0">
                <label>
                    <input type="text" class="form-control p-0 border-0" name="reason" value="">
                </label>
            </div>
        </div>
        <div class="form-group mb-4">
            <label class="col-md-12 p-0">Deleted By:</label>
            <div class="col-md-12 border-bottom p-0">

                <label>
                    <input readonly type="text" class="form-control p-0 border-0" name="changed_by" value="&nbsp;{{Auth::user()->lastname }} {{Auth::user()->firstname }}">
                </label>
                <label>
                    <input readonly type="hidden" class="form-control p-0 border-0" name="changed_by_id" value="&nbsp; {{Auth::user()->id }} ">
                </label>
            </div>
        </div>


        <div class="form-group mb-4">
            <div class="col-sm-12">
                <button class="btn btn-success">Delete</button>
            </div>
        </div>
        @endforeach
    </form>
    <!-- End update form  -->


</div>

<script type="text/javascript">
    let isUpdated = false;
    let selectedFood;
    let foodnameField;
    function update() {
        let select = document.getElementById('selectFood');
        let option = select.options[select.selectedIndex];
        selectedFood = option.dataset.name;
        foodnameField = document.getElementById('food_name_text')
        foodnameField.value = option.value;
        console.log(option.dataset.name);
    }
    update();

</script>
@endsection
