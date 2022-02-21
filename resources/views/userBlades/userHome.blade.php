@extends('Layout.dashboard')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<!-- data tables css-->

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

<!-- data tables js-->

<script type="text/javascript" src=" https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src=" https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src=" https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src=" https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>


    <div class="sals-boxes">
    <div class="recent-sales box">
      Your Recent Orders
     
        <table class="table table-bordered table-hover table-striped mt-4 data-table" id="table_id" >
            <thead>
              <tr>
               <th>Name</th>
                <th>Date</th>
                <th>Company Contribution</th>  
                <th>Self contribution</th>                      
                <th>Sauce</th>
          
    
              </tr>
            </thead>
            <tbody>

          
              @php
             $company_contrib = 2500;
              $self_total = 0;
              $company_total = 0;
              $overall_total = 0;
          
              @endphp
               
             

                @foreach ($queryuser as $item)
                <tr data-index={{ $item->id }}>
               
                <td>{{ $item->firstname }} {{ $item->lastname }} </td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $company_contrib }}</td>
                <td> @php
                  $self_contrib = 0;
                  $price = 0;
                  $price = intval($item->total);
                  $self_contrib = $price - 2500;
                  $self_total += $self_contrib;
                  $company_total +=$company_contrib
                  @endphp
                {{ $self_contrib }}  
                </td> 
              <td>{{ $item->name }}</td>
                  {{-- <td><button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" id="button">More</button></td> --}}
               </tr> 

                 @endforeach 
            </tbody>
            <tr>
              <td>
            </td>
              <td></td>
              <td>Total: {{ $company_total }}</td>
              <td>Total: {{ $self_total }} </td>
              <td></td>
            </tr>
          </table>
      
        
    </div>
        
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Food items on the order are:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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

<!--end of Modal -->

<script type="text/javascript">



    $(function () {
        $.noConflict();
      var table = $('.data-table').DataTable({
       
        dom:'Bfrtip',
            buttons:[
             'copy', 'excel', 'pdf'
            ]
      });
       
    //  <!-- Order details button -->

    $(document).on( 'click', 'button', function () {
        //var data = table.row( $(this).parents('tr') ).data();
        const orderID = $(this).closest('tr').attr('data-index')
        if((orderID !=="")){
          foodItems(orderID);
        }
       
    });
   function foodItems(orderID){
    $.ajax({
           
             type:'GET',
             url:"{{ url('/fooditems') }}",
             dataType:"json",
             data:{
               orderID:orderID
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

      });
      // End of order details button
    </script>

@endsection
