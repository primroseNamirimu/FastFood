@extends('Layout.dashboard2')
@section('content')

<div class="container-fluid">
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

<!--<form role="search" class="app-search d-none d-md-block me-3">-->
<!--    <input type="text" id="myInput" placeholder="Search for food item..." onkeyup="myFunction()"-->
<!--           class="form-control mt-0">-->
<!---->
<!--</form>-->

    <div class="col-lg-6">
        <div class="card" style="display: none" id="notification">
            <div class="card-body">
                <h4 class="card-title">Order on a person's behalf</h4>

                <div class="alert alert-success notification">
                    <p class="notificaiton-title"><strong>Warning!</strong> </p>
                    <p id="para"></p>
                    <button class="btn btn-success btn-sm rounded-0">Confirm</button>
                    <button class="btn btn-transparent btn-sm">Cancel</button>
                </div>
            </div>
        </div>
    </div>
<div class="row">


    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">MENU ITEMS</h4>
                <div class="table-responsive">

                    <table class="table table-bordered verticle-middle table-responsive-lg mb-0">
                        <thead>
                        <tr>

                            <th>Food</th>
                            <th>Price</th>
                            <th>Action</th>

                        </tr>
                        </thead>


                        <input type="hidden" name="total" id="sum-price">
                        <input type="hidden" name="food_ids" id="id-food_ids">
                        <input type="hidden" value="{{ $i = 0 }}">
                        <tbody>

                        @foreach ($menuTable as $menu)

                        <tr data-foodPrice="{{ $menu->price }}" data-foodID="{{ $menu->id }}" data-foodName="{{ $menu->name}}">


                            <td> {{ $menu->name }}</td>
                            <td>{{ $menu->price }}</td>
                            <td>

                                <div class="modal fade" id="deleteItem" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Food Item</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="#" method="POST">

                                                    @csrf
                                                    <p>{{$menu->name}}</p>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!--                                <form action="#" method="">-->
<!---->
<!--                                    @csrf-->
                                    <a class="button" href="{{ route('order.show', $menu->id) }}"><span><i class="bx bx-edit bx-xs bx-tada-hover"></i></span></a>



                                                                   <button type="submit" class="btn delete"
                                                                       onclick="if (!confirm('{{ $menu->name }} will be permanently deleted, are you sure?')) { return false }">
                                                                     <span><i class='bx bx-trash-alt bx-tada-hover bx-xs' aria-hidden="true"></i>
                                                                </button>
                                <button type="submit" id="btn-delete" class="btn delete" onclick="deleteFood()" value="{{$menu->name}}">
                                </button>

                            </td>


                        </tr>
                        @endforeach

                        </tbody>

                    </table>

                    <div class="modal fade" id="deleteItem" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Food Item</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Are you sure?</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal for adding a new item -->

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Fill the form!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- Start Create form  -->
                <form class="form-horizontal form-material" method="POST" action="{{ route('createMenuItem') }}">
                    @csrf

                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Item Name</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" class="form-control p-0 border-0" name="name">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Item Price</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" class="form-control p-0 border-0" name="price">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Create</button>
                        </div>
                    </div>
                </form>
                <!-- End Create form  -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<!-- End of New food item Modal -->


{{-- {!! $users->links() !!} --}}
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>


<script>


    $(document).ready(function () {


        let total = 0;
        let foodIds = [];
        $(document).on('click', 'input.check', function () {
            const foodID = $(this).closest('tr').attr('data-foodID')
            const foodPrice = $(this).closest('tr').attr('data-foodPrice')

            if ($(this).is(":checked")) {

                foodIds.push(foodID)

                total += parseInt(foodPrice);
                $("#total_amount").html(total)
                $("#sum-price").val(total)
            } else {

                total -= parseInt(foodPrice);
                const indexToRemove = foodIds.indexOf(foodID)
                foodIds.splice(indexToRemove, 1)
                $("#total_amount").html(total)
                $("#sum-price").val(total)
            }

        })
        const form = $("#order-form")
        form.on('submit', function (e) {
            const selectedFoods = JSON.stringify(foodIds)
            console.log(selectedFoods)
            $("#id-food_ids").val(selectedFoods)
            const formData = form.serializeArray()
            console.log(formData)
        })



    });
    const notifyDiv = $("#notification")

    function deleteFood(){
        const foodID = document.getElementById('btn-delete')
        console.log(foodID)
        // $("#deleteItem").modal()



    }


    //.....Search text area....//
    function myFunction() {
        // Declare variables
        let input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    //.....End of Search text area....//
</script>
