@extends('Layout.dashboard2')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">THE MENU</h4>

                    <div class="table-responsive">

                        <form id="order-form" method="POST" action="{{ route('order.store') }}">

                            @csrf
                            @if (Auth::user()->is_admin == 1)
                            <fieldset>
                                <legend>Making Order for:</legend>

                                <div>
                                    <input type="radio" id="admin" name="owner" value="admin"
                                           checked>
                                    <label for="admin">Myself</label>
                                </div>

                                <div>
                                    <input type="radio" id="other" name="owner" value="other">
                                    <label for="other">Other</label>
                                </div>


                            </fieldset>
                            <div id="name"></div>
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
                                <div class="dropdown">

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="box" style="display: none">
                                        <small>Select staff to whom the order belongs</small>
                                        <table class="table table-bordered verticle-middle table-responsive-sm mb-0">
                                            <thead>
                                            <tr>
                                                <td>action</td>
                                                <td>Name</td>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($users as $users)
                                            <div id="staff">
                                                <tr data-id="{{$users->id}}" data-lname="{{$users->lastname}}"
                                                    data-fname="{{$users->firstname}}">

                                                    <td>
                                                        <label>
                                                            <input type="radio" class="radio" name="staff_names[]"
                                                                   value="{{ $users->firstname }} {{ $users->lastname}}">
                                                        </label></td>

                                                    <td><a class="dropdown-item" href="#">{{$users->lastname}} {{ $users->firstname}}</a>
                                                    </td>
                                                </tr>
                                                <div>
                                                    @endforeach
                                            </tbody>

                                        </table>

                                    </div>

                                </div>
                            @endif

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

                            <table class="table table-bordered verticle-middle table-responsive-lg mb-0">
                                <thead>
                                <tr>

                                    <th>Food</th>
                                    <th>Price</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                               <tbody>

                                <input type="hidden" name="total" id="sum-price">
                                <input type="hidden" name="food_ids" id="id-food_ids">
                                <input type="hidden" name="staff_id" id="staff_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="staff_name" id="staff_name" value="{{Auth::user()->lastname}} {{Auth::user()->firstname}}">
                                <input type="hidden" name="isForStaff" id="isForStaff" value="false">
                                <input type="hidden" value="{{ $i = 0 }}">

                                @foreach ($menuTable as $menu)


                                <tr data-foodPrice="{{ $menu->price }}" data-foodID="{{ $menu->id }}">


                                    <td> {{ $menu->name }}</td>
                                    <td>@php
                                        $num_price = number_format($menu->price)
                                        @endphp
                                        {{$num_price}}
                                    </td>
                                    <td>
                                        <input type="hidden" name="checkbox[]" class="check" value="0">
                                        <label>
                                            <input type="checkbox" class="check" name="checkbox[]" value="{{ $menu->price }} ">
                                        </label>
                                    </td>

                                </tr>

                                @endforeach


                                <tr style="font-size: x-large;">
                                    <td colspan="2">TOTAL COST</td>
                                    <td colspan="2"><strong id="total_amount"></strong></td>

                                </tr>
                                <br/>
                                <tr>
                                    <td colspan="4">
                                        <button type="submit" class="btn btn-success btn-lg order-btn" id="order-btn">Order Now</button>
                                    </td>
                                </tr>

                               </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--    <form role="search" class="app-search d-none d-md-block me-3">-->
<!--        <input type="text" id="myInput" placeholder="Search for food item..." onkeyup="myFunction()"-->
<!--               class="form-control mt-0">-->
<!---->
<!--    </form>-->




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
                                <input type="text" class="form-control p-0 border-0" name="name" required>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Item Price</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" class="form-control p-0 border-0" name="price" required>
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

</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>


<script>

    $(document).ready(function () {

        let userid;
        let username;
        let checked = false;
        const box = document.getElementById('box');
        const name = document.getElementById('name');
        const notify = document.getElementById('notification')
        const para = document.getElementById('para')

        function handleRadioClick() {

            if (document.getElementById('other').checked) {
                box.style.display = 'block';
                checked = true
            } else {
                box.style.display = 'none';
                name.innerHTML = 'Making Order for <b>Self</b>'
            }

        }

        const radioButtons = document.querySelectorAll('input[name="owner"]');
        console.log(radioButtons)
        radioButtons.forEach(radio => {
            radio.addEventListener('click', handleRadioClick);
        });

        let total = 0;
        let foodIds = [];

        $(document).on('click', 'input.check', function () {
            const foodID = $(this).closest('tr').attr('data-foodID')
            const foodPrice = $(this).closest('tr').attr('data-foodPrice')

            if ($(this).is(":checked")) {

                foodIds.push(foodID)

                total += parseInt(foodPrice);
                $("#total_amount").html(total);

                $("#sum-price").val(total)
            } else {

                total -= parseInt(foodPrice);
                const indexToRemove = foodIds.indexOf(foodID)
                foodIds.splice(indexToRemove, 1)
                $("#total_amount").html(total)
                $("#sum-price").val(total)
            }

        })

        //selecting employee to whom the order belongs
        $(document).on('click', 'input.radio', function () {

            const all = $('.radio');
            let user_Ids = [];
             userid = $(this).closest('tr').attr('data-id');
            const fname = $(this).closest('tr').attr('data-fname');
            const lname = $(this).closest('tr').attr('data-lname');
             username = lname + " " + fname
            if ('$(input[type=radio]:checked)') {
                // notify.style.display = 'block'
                para.innerHTML = 'You are making an order on behalf of ' + username

                // alert("You are making an order for " + username)
                box.style.display = 'none';
                name.innerHTML = 'Making Order for ' + '<span><b>' + username + '</b></span>'

            }


        });

        const form = $("#order-form")
        form.on('submit', function (e) {
            const selectedFoods = JSON.stringify(foodIds)

            //if the order belongs to other staff member, and not to the admin themselves
            if(checked){

                $("#staff_id").val(userid)

                $("#staff_name").val(username)
                $("#isForStaff").val("isForStaff")
            } else {
                $("#staff_id").val()

                $("#staff_name").val(username)

            }

            $("#id-food_ids").val(selectedFoods)



            const formData = form.serializeArray()

        })

    });


    //.....Search text area....//
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
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
