@extends('Layout.dashboard')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"/>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Three charts -->
    <!-- ============================================================== -->
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total users</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <div id="sparklinedash"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <li class="ms-auto"><span class="counter text-success">659</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total monthly orders</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <div id="sparklinedash2"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <li class="ms-auto"><span class="counter text-purple">869</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total expenditure</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <div id="sparklinedash3"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <li class="ms-auto"><span class="counter text-info">911</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
                <!-- PRODUCTS YEARLY SALES -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Monthly Sales</h3>
                            <div class="d-md-flex">
                                <ul class="list-inline d-flex ms-auto">
                                    <li class="ps-3">
                                        <h5><i class="fa fa-circle me-1 text-info"></i>Mac</h5>
                                    </li>
                                    <li class="ps-3">
                                        <h5><i class="fa fa-circle me-1 text-inverse"></i>Windows</h5>
                                    </li>
                                </ul>
                            </div>
                            <div id="ct-visits" style="height: 405px;">
                                <div class="chartist-tooltip" style="top: -17px; left: -12px;"><span
                                        class="chartist-tooltip-value">6</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- ============================================================== -->

                {{-- datatables for the monthly orders taken --}}
           
            <!-- ============================================================== -->
                {{-- <div class="sales-boxes">
                    <div class="recent-sales box">
                      <div class="row ">
                        <div class="col-md-6">
              
                          <div class="input-group mb-3">
                            <div class="input-group-addon">
                              <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="date" placeholder="Date"/>
                          </div><br/>
                          
                        </div>
                         
                        <div class="col-md-6 pull-right">
                          {{-- <a href="{{ route('admin.currentMonthReport') }}"><button class="btn btn-success">RESET</button></a> --}}
                          {{-- <a href=""><button class="btn btn-success">RESET</button></a>
                        </div>
                      </div>  --}}
              
              
                      {{-- <table class="table table-bordered table-hover table-striped mt-4" id="table_id" >
                        <thead>
                          <tr>
                            <th>FIRST NAME</th>
                                  
                            <th>TOTAL</th>             
                            <th>DATE</th>
                            <th>Action</th>
              
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Sample data</td>
                            <td>Sample data</td>
                            <td>Sample data</td>
                            <td><button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">More</button></td>
                          </tr>
                          <tr>
                            <td>Sample data</td>
                            <td>Sample data</td>
                            <td>Sample data</td>
                            <td><button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">More</button></td>
                          </tr> --}}
                          {{-- <tr>
                          @foreach ($query as $item)
                    
                       <tr data-index={{ $item->order_id }} data-firstName={{ $item->firstname }}>
                          
                        <td> {{ $item->firstname }}</td>
                        <td>{{ $item->total }}</td>
                        <td>{{ $item->created_at }}</td>
                        
                        <td><button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">More</button></td>
                    </tr>
                     @endforeach 
                            @foreach ($query as $item)
                            <tr>
                              <td>{{ $item->firstname }}</td> 
                              <td>{{ $item->order_id }}</td>               
                              <td>{{ $item->total }}</td>       
                              <td>{{ $item->created_at }}</td>
                           </tr>
                            @endforeach  --}}
                        </tbody>
                      </table>
                    </div>
                  </div>
                  </div>
              </div>
              
              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Food items on the order are:</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
{{-- <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}

<!-- date range picker js-->

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- data tables js-->

<script type="text/javascript" src=" https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src=" https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
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
                            buttons: [
                              'copy', 'excel', 'pdf'
                            ]
                        
                          });

                  // Date range picker
                  var startDate = "";
                  var endDate = "";
                  $('#date').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD ' ) + ' to ' + picker.endDate.format('YYYY-MM-DD '));
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
                      console.log(startDate,endDate)
                  
                      if (startDate !== "" && endDate !== "") {
                        getDateRangeRecord(startDate, endDate);
                      }
                    });
                  });
                
                      // ajax for the date range picker
                      function getDateRangeRecord(endDate, startDate) {
                        $.ajax({
                          data: [],
                          url: "{{ url('/expenditure') }}",
                          type: 'GET',
                          dataSrc:'',
                          cache: false,
                          data: {
                            startDate: startDate,
                            endDate: endDate
                          },
                         
                          dataSrc: "",
                          dataType: "json",
                          success: function(response) {
                            const { data } = response;
                            console.log(data);
                            var trows =''
                            data.forEach(record => {
                              const { total, created_at, firstname} = record;
                              trows+=`<tr><td>${firstname}</td><td>${total}</td><td>${created_at}</td><td><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">More</button></td></tr>`
                                
                            });
                            // clear before i repopulate
                            reportDataTable.clear().draw();
                            //repopulate
                            reportTable.DataTable().rows.add($(trows)).draw()
                          }
                        });
                      }
                       
                 //  <!-- Order details button -->
              
                 $(document).on( 'click', 'button', function () {
                      //var data = table.row( $(this).parents('tr') ).data();
                      const orderID = $(this).closest('tr').attr('data-index')
                      const firstname = $(this).closest('tr').attr('data-firstname')
                      if((orderID !=="")){
                        foodItems(orderID,firstname);
                      }
                     
                  });
                 function foodItems(orderID,firstname){
                  $.ajax({
                           data:[],
                           type:'GET',
                           url:"{{ url('/foodItemsAdmin') }}",
                           dataType:"json",
                           data:{
                             orderID:orderID,
                             firstname:firstname
                           },
                           dataSrc: "",
                           cache:false,
                           success:function(response){
                                const{ data } = response;
                            console.log(response);
                          
                            let result = response.map(e => e.name);
                            let good = result.join(" , ")
                            $(".modal-body").html(good)
                            
                           }
                           });
                     }
              
                    
                    // End of order details button
              
                });
                      //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
              
              
              </script>
              


</div>
@endsection