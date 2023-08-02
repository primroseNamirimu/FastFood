@extends('Layout.dashboard2')

@section('content')


<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

<div class="container-fluid">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" style="width: 50%">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-close"></span>
        </button>
        <strong>Success! </strong> {{$message}}
    </div>
    @endif

    @if($message = Session::get('danger'))
    <div class="alert alert-danger alert-dismissible fade show" style="width: 50%">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-close"></span>
        </button>
        <strong>Warning!</strong> {{$message}}
    </div>

    @endif

    @if($message = Session::get('warning'))
    <div class="alert alert-warning alert-dismissible fade show" style="width: 50%">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-close"></span>
        </button>
        <strong>Warning!</strong> {{$message}}
    </div>

    @endif
    <div class="row justify-content-between mb-4">
        <div class="col-xl-3 col-lg-4">
            <h2 class="page-heading">Hi, Welcome Back!</h2>
            <p class="mb-0">Digital Solutions Food Portal </p>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Monthly Orders Overview</h4>

                    <canvas id="donut"></canvas>

                </div>
            </div>
        </div>


        <div class="col-xl-6 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Expenditure</h4>

                    <canvas id="myChart"></canvas>

                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Order List</h4>
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
                            <!--            {{-- <a href="{{ route('admin.currentMonthReport') }}"><button class="btn btn-success">RESET</button></a> --}}-->
                            <a href="">
                                <button class="btn btn-success">RESET</button>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">

                        <table class="table verticle-middle table-responsive-lg mb-0" id="table_id">
                            <thead>
                            <tr>
                                <th>ORDER ID</th>
                                <th>NAME</th>
                                <th>Company discount</th>
                                <th>Individual input</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Sauce</th>
                                <th>Ordered By</th>
                                <th>Modified</th>
                                <th>Action</th>
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
                            @foreach ($queryuser as $item)
                            <tr data-index="{{ $item->order_id }} data-firstName={{ $item->firstname }}">
                                <td>{{ $item->order_id }}</td>

                                <td> {{ $item->lastname }} {{ $item->firstname }}</td>
                                <td>{{ $number_format_companycontrib }}</td>
                                <td>@php

                                    $self_contrib = intval($item->total - $company_contrib);

                                    $self_total += $self_contrib;
                                    $company_total += $company_contrib;
                                    $overall_total += intval($item->total);

                                    //money format for the totals
                                    $money_self = number_format($self_total);
                                    $money_company = number_format($company_total);
                                    $money_overall = number_format($overall_total);
                                    $val =  number_format($self_contrib)
                                    @endphp
                                    {{$val}}

                                </td>
                                <td>@php
                                    $num_format = number_format($item->total);
                                    @endphp
                                    {{ $num_format }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->order_made_by }}</td>

                                @if(($item->is_changed) == "YES")
                                <td><a style="color: #0a58ca" href="{{ route('viewChangedOrder', $item->order_id ) }}" data-toggle="tooltip"  data-placement="top" title=""
                                       data-original-title="Details"aria-hidden="true">{{$item->is_changed}}</a></td>
                                @else
                                <td>{{$item->is_changed}}</td>
                                @endif


                                <td>
                                    <a href="{{ route('deleteOrder',$item->order_id ) }}" ><button type="submit" class="btn delete">
                                            <span><i class='bx bx-trash-alt'></i></button></a>
                                    <a href="{{ route('editOrder', $item->order_id) }}"><span><i class="icon-note"></i></span></a>
                                </td>

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
                                <td></td>
                                <td></td>

                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade none-border" id="event-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Order Log</strong></h4>
                </div>
                <div class="modal-body">
                    <!-- Start Create form  -->
                    <form class="form-horizontal form-material" method="POST" action="">
                        @csrf

                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Original Order</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" class="form-control p-0 border-0" name="name" value="" >
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Modified Order</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" class="form-control p-0 border-0" name="price" value="">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="col-sm-12">
                                <button class="btn btn-success" >Create</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Create form  -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.noConflict();
        //DATA TABLES
        var reportTable = $('#table_id');
        var reportDataTable = reportTable.DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ]

        });

        // Date range picker
        var startDate = "";
        var endDate = "";
        $('#date').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD ') + ' to ' + picker.endDate.format(
                'YYYY-MM-DD '));
        });

        $('#date').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });


        $(function() {

            $('#date').daterangepicker({
                timePicker: false,
                startDate: moment().startOf('hour'),

                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'DD-MM-YYYY hh:mm A'
                }
            }, function(start, end) {
                var startDate = start.format('YYYY-MM-DD ');
                var endDate = end.format('YYYY-MM-DD ');
                console.log(startDate, endDate)

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
                    console.log(response)
                    let trows = '';
                    let extraRow = '';
                    let company_contrib = 2500;
                    let self_contrib = 0;
                    let money_company = 0;
                    let money_self = 0;
                    let money_overall = 0;
                    data.forEach(record => {
                        const {order_id, total, created_at, firstname, lastname, made_by, name,is_changed} = record;
                        self_contrib = total - company_contrib;
                        trows += `<tr><td>${order_id}</td><td>${lastname} ${firstname}</td><td>${company_contrib}</td><td>${self_contrib}</td><td>${total}</td><td>${created_at}</td><td>${name}</td><td>${made_by}</td><td>${is_changed}</td>
                        <td>
                                                        <a href="{{ route('deleteOrder',$item->order_id ?? 0 ) }}" ><button type="submit" class="btn delete">
                                                            <span><i class='bx bx-trash-alt'></i></button></a>
                                                        <a href="{{ route('editOrder', $item->order_id ?? 0) }}"><span><i class="icon-note"></i></span></a>
                                                    </td>
                                                    </tr>`
                        money_self += self_contrib;
                        money_company += company_contrib;
                        money_overall += (total);

                    });

                    extraRow = `<td></td><td></td><td style="color: green"><strong>Total: ${money_company} </strong></td><td style="color: green"><strong>Total: ${money_self} </strong></td><td style="color: green"><strong>Total:  ${money_overall} </strong></td><td> <td></td> <td></td><td></td><td></td></tr>`;

                    // clear before i repopulate
                    reportDataTable.clear().draw();
                    let node = document.getElementById('table_id');
                    node.deleteTFoot()

                    //repopulate
                    let reportTable = $('#table_id');
                    reportTable.DataTable().rows.add($(trows)).draw();
                    $("#table_id").append(
                        $('<tfoot/>').append($(extraRow).clone())
                    );

                }
            });
        }

        //  <!-- Order details button -->

        $(document).on('click', 'button', function() {

            const orderID = $(this).closest('tr').attr('data-index')
            const firstname = $(this).closest('tr').attr('data-firstname')
            if ((orderID !== "")) {

                foodItems(orderID);
            }

        });

        function foodItems(orderID) {
            $.ajax({
                type: 'GET',
                url: "{{ url('/foodItemsAdmin') }}",
                dataType: "json",
                data: {

                    orderID: orderID,

                },
                dataSrc: "",
                cache: false,
                success: function(response) {
                    const {
                        data
                    } = response;
                    console.log(response);

                    let result = response.map(e => e.name);
                    let good = result.join(" , ")
                    $(".modal-body").html(good)

                }
            });
        }
        // End of order details button

        function displayOrderDetails(){
            const ctx = document.getElementById('myChart');
            $.ajax({
                type: 'GET',
                url: "{{ url('/fetchOrderDetails') }}",
                dataType: "json",
                dataSrc: "",
                cache: false,
                success: function(response) {
                    const {
                        data
                    } = response;
                    const labels =  response[0].map(row => row.month)
                    const c = [{c:1000}]
                    new Chart(ctx, {
                        type: 'bar',
                        options: {

                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,

                                    }
                                }],
                                xAxes: [{
                                    barPercentage: 0.4,
                                }]
                            }
                        },
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Monthly Expenditure',
                                    data: response[0].map(row => row.total),
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(255, 159, 64, 0.2)',
                                        'rgba(255, 205, 86, 0.2)',

                                    ],
                                    borderColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(255, 159, 64)',
                                        'rgb(255, 205, 86)',

                                    ],


                                },
                        //         {
                        //
                        //             label: 'Monthly orders',
                        //             data: c.map(row => row.c),
                        //             backgroundColor: [
                        //                 'rgba(255, 159, 64, 0.2)',
                        //
                        //
                        //
                        //             ],
                        //             borderColor: [
                        //                 'rgb(255, 159, 64)',
                        //                ,
                        //
                        //
                        //             ],
                        //
                        //
                        //         }
                            ]
                        //
                        }

                    });

                }
            });


        }

        function donutChart(){
            const ctx = document.getElementById('donut');
            let orders;

            $.ajax({
                type: 'GET',
                url: "{{ url('/fetchUserAnalytics') }}",
                dataType: "json",
                dataSrc: "",
                cache: false,
                success: function(response) {
                    const {
                        data
                    } = response;

                    console.log(response);

                    new Chart(ctx, {
                        type: 'doughnut',
                        options: {

                        },
                        data: {
                            labels: response.map(row => row.food),
                            datasets: [
                                {
                                    data: response.map(row => row.count),


                                    backgroundColor: [

                                        'rgba(255, 159, 64, 0.2)',
                                        'rgba(255, 205, 86, 0.2)',
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(255, 55, 155,0.2)',


                                    ],
                                    borderColor: [

                                        'rgb(255, 159, 64)',
                                        'rgb(255, 205, 86)',
                                        'rgb(255, 99, 132)',
                                        'rgba(255, 55, 155)',

                                    ],


                                }
                            ]

                        }

                    });

                }
            });


        }

        displayOrderDetails();
        donutChart();


    });
</script>


@endsection




