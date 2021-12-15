@extends('Layout.dashboard')
@section('content')
<div class="sals-boxes">
              
<!-- Start Update form  -->
<form class="form-horizontal form-material" method="POST" action="{{ route('order.update',$foodItem->id) }}">
    @csrf
     {{ method_field('PATCH') }}
     <div class="form-group mb-4">
         <label class="col-md-12 p-0">Item Name</label>
         <div class="col-md-12 border-bottom p-0">
             <input type="text" class="form-control p-0 border-0" name="name" value="{{ $foodItem->name }}"> 
         </div>
     </div>
     <div class="form-group mb-4">
         <label class="col-md-12 p-0">Item Price</label>
         <div class="col-md-12 border-bottom p-0">
             <input type="text" class="form-control p-0 border-0" name="price" value="{{ $foodItem->price }}"> 
         </div>
     </div>
     <div class="form-group mb-4">
         <div class="col-sm-12">
             <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Update Menu Item</button>
         </div>
     </div>
   </form>
   <!-- End update form  -->
           

</div>
@endsection