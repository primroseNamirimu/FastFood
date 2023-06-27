@extends('Layout.dashboard2')
@section('content')

<div class="sals-boxes">

    <div class="row ">
        <div class="col-md-6">

            <div class="input-group mb-3">
                <div class="input-group-addon">
                    <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="bx bx-calendar bx-sm"
                                                                                           aria-hidden="true"></i></span>
                </div>
                <label for="date"></label><input type="text" class="form-control" id="date" placeholder="Date"/>
            </div>
            <br/>

        </div>

        <div class="col-md-6 pull-right">
            <a href="">
                <button class="btn btn-success">RESET</button>
            </a>
        </div>
    </div>

    <table class="table table-bordered table-hover table-striped mt-4" id="table_id">
        <thead>
        <tr>
            <th>ORDER ID</th>
            <th>NAME</th>

            <th>Company Contribution</th>
            <th>Self contribution</th>
            <th>Total</th>
            <th>DATE</th>
            <th>Sauce</th>
            <th>ordered By</th>

        </tr>
        </thead>
        <tbody>
        @php

        $company_contrib = 2500;
        $number_format_companycontrib = number_format($company_contrib);
        $self_total = 0;
        $company_total = 0;
        $overall_total = 0;
        $price = 0;
        $self_contrib = 0;
        $money_self = 0;
        $money_company = 0;
        $money_overall = 0;

        @endphp
        @foreach ($query as $item)

        <tr data-index="{{ $item->order_id }} data-firstName={{ $item->firstname }}">
            <td>{{ $item->order_id}}</td>

            <td> {{ $item->lastname }} {{ $item->firstname }}</td>

            <td>{{ $number_format_companycontrib }}</td>
            <td>@php


                $self_contrib =intval($item->total- $company_contrib);
                // $self_string = strval($self_contrib);
                // $money_self = number_format($self_string);

                $self_total += $self_contrib;
                $company_total += $company_contrib;
                $overall_total += intval($item->total);

                //money format for the totals
                $money_self = number_format($self_total);
                $money_company = number_format($company_total);
                $money_overall = number_format($overall_total);

                @endphp
                {{ $self_contrib }}
            </td>
            <td>@php
                $num_format = number_format($item->total);
                @endphp
                {{ $num_format }}
            </td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->name }}</td>
            <td>{{$item->order_made_by}}</td>
            {{--
            <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Launch demo modal
                </button>
            </td>
            --}}
            {{--
            <td>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">More
                </button>
            </td>
            --}}
        </tr>
        @endforeach

        </tbody>

        <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td><strong>Total: {{ $money_company }}</strong></td>
            <td><strong>Total: {{ $money_self }}</strong></td>
            <td><strong>Total: {{ $money_overall }}</strong></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tfoot>


    </table>


</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Food items on the order are:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->

<div class="modal fade" id="exampleModalwrong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Food items on the order are:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            {{--
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="wrong-btn" data-bs-target="#exampleModalToggle2"
                        data-bs-toggle="modal" data-bs-dismiss="modal">Wrong Order
                </button>

            </div>
            --}}
        </div>
    </div>
</div>
<!-- Wrong order Modal -->
<div class="modal fade" id="exampleModalToggle2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter the order you received</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-bdy">
                <div class="sals-boxes">

                    <!-- Start Update form  -->
                    <form class="form-horizontal form-material" method="POST" action="">
                        @csrf
                        {{-- {{ method_field('PATCH') }} --}}
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Item Name</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" class="form-control p-0 border-0" name="name"
                                       placeholder="Enter food item">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Item Name</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" class="form-control p-0 border-0" name="name"
                                       placeholder="Enter food item">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Item Name</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" class="form-control p-0 border-0" name="name"
                                       placeholder="Enter food item">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Item Name</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" class="form-control p-0 border-0" name="name"
                                       placeholder="Enter food item">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Item Name</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" class="form-control p-0 border-0" name="name"
                                       placeholder="Enter food item">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="col-sm-12">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Update Menu Details
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- End update form  -->


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">close</button>


            </div>
        </div>
    </div>
</div>
<!-- End Wrong order Modal -->

<!-- End of Modal -->

<script>
    $(document).ready(function () {
        $.noConflict();
        //DATA TABLES
        let reportTable = $('#table_id');
        let reportDataTable = reportTable.DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ]

        });
        // Date range picker
        let startDate = "";
        let date = document.getElementById('date');

        $(date).on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD ') + ' to ' + picker.endDate.format('YYYY-MM-DD '));
        });

        $(date).on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });

        $(function () {
            $(date).daterangepicker({
                timePicker: false,
                startDate: moment().startOf('hour'),

                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'DD-MM-YYYY hh:mm A'
                }
            }, function (start, end) {
                let startDate = start.format('YYYY-MM-DD ');
                let endDate = end.format('YYYY-MM-DD ');

                if (startDate !== "" && endDate !== "") {
                    getDateRangeRecord(startDate, endDate);
                }
            });
        });

        // ajax for the date range picker
        function getDateRangeRecord(endDate, startDate) {
            $.ajax({
                url: "{{ url('/expenditure') }}",
                type: 'GET',
                dataSrc: '',
                cache: false,
                data: {
                    startDate: startDate,
                    endDate: endDate
                },
                dataType: "json",
                success: function (response) {
                    const {data} = response;
                    console.log(data);
                    let trows = '';
                    let extraRow = '';
                    let company_contrib = 2500;
                    let self_contrib = 0;
                    let money_company = 0;
                    let money_self = 0;
                    let money_overall = 0;
                    let y = [];
                    data.forEach(record => {
                        const {order_id, total, created_at, firstname, lastname, order_made_by, name} = record;
                        self_contrib = total - company_contrib;
                        trows += `<tr><td>${order_id}</td><td>${firstname} ${lastname}</td><td>${company_contrib}</td><td>${self_contrib}</td><td>${total}</td><td>${created_at}</td><td>${name}</td><td>${order_made_by}</td></tr>`
                        money_self += self_contrib;
                        money_company += company_contrib;

                        money_overall += (total);

                    });

                    extraRow = `<tr style="color: green"><td></td><td></td><td><strong>Total: ${money_company} </strong></td><td><strong>Total: ${money_self} </strong></td><td><strong>Total:  ${money_overall} </strong></td><td></td> <td></td> <td></td></tr>`;

                    // clear before i repopulate
                    reportDataTable.clear().draw();
                    let node = document.getElementById('table_id');
                    node.deleteTFoot()

                    //repopulate
                    reportTable.DataTable().rows.add($(trows)).draw();
                    $("#table_id").append(
                        $('<tfoot/>').append($(extraRow).clone())
                    );

                }
            });
        }

        //  <!-- Order details button -->

        $(document).on('click', 'button', function () {
            let data = table.row( $(this).parents('tr') ).data();
            const orderID = $(this).closest('tr').attr('data-index')
            const firstname = $(this).closest('tr').attr('data-firstname')
            if ((orderID !== "")) {
                foodItems(orderID, firstname);
            }

        });

        function foodItems(orderID, firstname) {
            $.ajax({
                type: 'GET',
                url: "{{ url('/foodItemsAdmin') }}",
                dataType: "json",
                data: {
                    orderID: orderID,
                    firstname: firstname
                },
                dataSrc: "",
                cache: false,
                success: function (response) {
                    const {data} = response;
                    console.log(response);

                    let result = response.map(e => e.name);
                    console.log(result)
                    let good = result.join(" , ")

                    result.forEach(function (name, index) {

                        return $(".modal-body").append(
                            '<li>' + name + '</li>'
                        )
                    });

                }

            });
        }

        // End of order details button

        //disable button after some time js
        const button = document.querySelector('#wrong-btn');
        //let buttonDisabled = false;
        let setTime = 500000
        window.onload = function () {

            setTimeout(function () {

                button.disabled = true;
                button.textContent = 'Can not edit order';


            }, setTime);
        }

    });


</script>

</html>


@endsection
