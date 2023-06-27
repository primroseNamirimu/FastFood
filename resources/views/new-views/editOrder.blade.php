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
    @foreach ($orderDetails as $item)
    <form class="form-horizontal form-material" method="POST" action="{{ route('changeOrder', $item->order_id) }}">
        @csrf
        <div class="form-group mb-4">
            <label class="col-md-12 p-0">Order Belongs To:</label>
            <div class="col-md-12 border-bottom p-0">

                <label>
                    <input type="text" class="form-control p-0 border-0" name="name" value="{{ $item->lastname }} {{ $item->firstname }}">
                </label>
            </div>
        </div>

        <div class="form-group mb-4">
            <label class="col-md-12 p-0">Food Name:</label>
            <div class="col-md-12 border-bottom p-0">

                <label>
<!--                    <input type="text" id="food_nam_text" class="form-control p-0 border-0" name="food_name" value="{{ $item->name }}">-->
                    <input type="text" class="form-control p-0 border-0" name="food_nameText" value="{{ $item->name }}">
                    <input type="hidden" id="food_name_text" class="form-control p-0 border-0" name="food_name" value="{{ $item->name }}">
                    <select id="selectFood" class="form-control" onchange="update()">
                        <option selected="">Replace with...</option>
                        @foreach( $foodItems as $food)
                        <option data-id="{{$food->id}}" data-name="{{$food->name}}">{{$food->name}}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>

        <div class="form-group mb-4">
            <label class="col-md-12 p-0">Reason:</label>
            <div class="col-md-12 border-bottom p-0">

                <label>
                    <input type="text" class="form-control p-0 border-0" name="reason" value="">

                </label>
            </div>
        </div>
        <div class="form-group mb-4">
            <label class="col-md-12 p-0">Changed By:</label>
            <div class="col-md-12 border-bottom p-0">

                <label>
                    <input readonly type="text" class="form-control p-0 border-0" name="changed_by" value="&nbsp; {{Auth::user()->lastname }} {{Auth::user()->firstname }}">
                </label>
                <label>
                    <input readonly type="hidden" class="form-control p-0 border-0" name="changed_by_id" value="&nbsp; {{Auth::user()->id }} ">
                </label>
            </div>
        </div>


        <div class="form-group mb-4">
            <div class="col-sm-12">
                <button class="btn btn-success">Change</button>
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
