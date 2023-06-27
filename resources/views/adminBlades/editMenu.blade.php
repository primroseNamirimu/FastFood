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
<form class="form-horizontal form-material" method="POST" action="{{ route('order.update',$foodItem->id) }}">
    @csrf
     {{ method_field('PATCH') }}
     <div class="form-group mb-4">
         <label class="col-md-12 p-0">Item Name</label>
         <div class="col-md-12 border-bottom p-0">
             <label>
                 <input type="text" class="form-control p-0 border-0" name="name" value="{{ $foodItem->name }}">
             </label>
         </div>
     </div>
     <div class="form-group mb-4">
         <label class="col-md-12 p-0">Item Price</label>
         <div class="col-md-12 border-bottom p-0">
             <label>
                 <input type="number" class="form-control p-0 border-0" name="price" value="{{ $foodItem->price }}">
             </label>
         </div>
     </div>
     <div class="form-group mb-4">
         <div class="col-sm-12">
             <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal" >Update Menu Item</button>
         </div>
     </div>
   </form>
   <!-- End update form  -->


</div>
@endsection
