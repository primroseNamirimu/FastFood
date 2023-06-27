@extends('Layout.dashboard')
@section('content')
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <div class="sals-boxes">
        <div class="recent-sales box">
            <div class="row ">
                <div class="col-md-6">

                    <div class="input-group mb-3">
                        <div class="input-group-addon">
                            <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fa fa-calendar"
                                    aria-hidden="true"></i></span>
                        </div>
                        <input type="text" class="form-control" id="date" placeholder="Date" />
                    </div><br />

                </div>

                <div class="col-md-6 pull-right">
                    {{-- <a href="{{ route('admin.currentMonthReport') }}"><button class="btn btn-success">RESET</button></a> --}}
                    <a href=""><button class="btn btn-success">RESET</button></a>
                </div>
            </div>


            <table class="table table-bordered table-hover table-striped " id="table_id">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>NAME</th>
                        <th>Food item</th>
                        <th>Food Cost</th>
                        <th>Company discount</th>
                        <th>Self input</th>
                        <th>Ordered By</th>
                        <th>Date</th>
                        <th>Order details</th>

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

                    @foreach ($adminReport as $item)
                        <tr data-index={{ $item->order_id }} data-email={{ $item->email }}>
                            <td>{{$item->order_id}}</td>
                            <td> {{ $item->lastname }} {{ $item->firstname }}</td>
                            <td>{{ $item->name }}</td>
                            <td>@php
                                $num_format = number_format($item->total);
                                @endphp
                                {{ $num_format }}</td>
                            <td>{{ $number_format_companycontrib }}</td>
                            <td>@php


                                $self_contrib =intval($item->total- $company_contrib);
                                // $self_string = strval($self_contrib);
                                // $money_self = number_format($self_string);

                                $self_total  += $self_contrib;
                                $company_total += $company_contrib;
                                $overall_total += intval($item->total);

                                //money format for the totals
                                $money_self = number_format($self_total);
                                $money_company = number_format($company_total);
                                $money_overall = number_format($overall_total);

                            @endphp
                                {{ $self_contrib }}
                            </td>

                            <td>{{$item->order_made_by}}</td>
                            <td>{{ $item->created_at }}</td>
                            <td><button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">More</button></td>

                        </tr>
                    @endforeach
                </tbody>
                    <tfoot>
                      <tr>
                      <td></td><td></td><td></td>
                      <td><strong>Total: {{ $money_overall }}</strong></td></td>
                      <td><strong>Total: {{ $money_company }}</strong></td>
                      <td><strong>Total: {{ $money_self }}</strong></td>
                      <td><strong></strong></td>
                          <td></td><td></td>
                      </tr>
                     </tfoot>

            </table>
        </div>
    </div>
    </div>
    </div>

    <!-- Modal -->

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

    <!-- End of Modal -->

    <!--popper js-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>


    <!-- date range picker js-->

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- data tables js-->

    <script type="text/javascript" src=" https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src=" https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src=" https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>


    <script>
        $(document).ready(function() {
            $.noConflict();
            //DATA TABLES
            var reportTable = $('#table_id');
            var reportDataTable = $('#table_id').DataTable({
                dom: 'Bfrtip',
                "searching":true,
                "bPaginate": true,
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
                        format: 'YYYY-MM-DD '
                    }
                }, function(start, end) {
                    var startDate = start.format('YYYY-MM-DD ');
                    var endDate = end.format('YYYY-MM-DD ');
                    // console.log(startDate,endDate)

                    if (startDate !== "" && endDate !== "") {
                        getDateRangeRecord(startDate, endDate);
                    }
                });
            });

            // ajax for the date range picker
            function getDateRangeRecord(endDate, startDate) {
                const company_contrib = 2500;

                const self_total = 0;
                const company_total = 0;
                const overall_total = 0;
                const price = 0;
                const self_contrib = 0;
                const money_self = 0;
                const money_company = 0;
                const money_overall = 0;
                $.ajax({
                    url: "{{ url('/expenditure') }}",
                    type: 'GET',
                    cache: false,
                    data: {
                        startDate: startDate,
                        endDate: endDate
                    },

                    dataSrc: "",
                    dataType: "json",
                    success: function(response) {
                        const {
                            data
                        } = response;
                        let result = response.map(e => e.total);
                        console.log(data);
                        var trows = ''
                        var tfoot = ''
                        data.forEach(record => {

                            const {
                                order_id,
                                total,
                                created_at,
                                firstname,
                                company_contrib =2500,
                                self_contrib = total-company_contrib,
                                order_made_by,
                                name,lastname


                            } = record;


                            console.log(result)
                            // data2.forEach(totalRecord => {
                            //     const {
                            //         self_total = self_total + self_contrib
                            //     }
                            // }) = totalRecord;
                            trows +=
                                `<tr><td>${order_id}</td><td>${firstname} ${lastname}</td><td>${company_contrib}</td><td>${self_contrib}</td><td>${total}</td><td>${created_at}</td><td>${name}</td><td>${order_made_by}</td><td><button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">More</button></td></tr>`
                             tfoot +=`<tr><td></td><td></td><td>${record.order_id}</td><td></td><td></td><td></td><td></td>`
                        });
                        // clear before i repopulate
                        reportDataTable.clear().draw();
                        //repopulate
                        reportTable.DataTable().rows.add($(trows)).draw()
                    }
                });
            }

            //  <!-- Order details button -->

            $(document).on('click', 'button', function() {
                const orderID = $(this).closest('tr').attr('data-index')
                const email = $(this).closest('tr').attr('data-email')
                if (orderID !== "") {

                    foodItems(orderID, email);
                }

            });

            function foodItems(orderID, email) {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('/fooditems') }}",
                    dataType: "json",
                    data: {
                        orderID: orderID,
                        email: email,

                    },
                    dataSrc: "",
                    cache: false,
                    success: function(response) {
                        const {
                            data
                        } = response;
                        console.log(response);
                        let result = response.map(e => e.name);
                        let order_id = response.map(e => e.order_id);
                        let good = result.join(" , ")
                        $(".modal-body").html("<b>OrderID: </b>" + order_id[0] + "<br> "  +"<b> Food Items: </b>" + good )

                    }
                });
            }


            // End of order details button

        });
        //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    </script>

    </html>
@endsection
