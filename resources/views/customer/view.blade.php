@extends("layout.default")

@section("content")


<!-- [ Main Content ] start -->
<div class="dash-container">
<div class="dash-content">
<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-auto">
<div class="page-header-title">
<h4 class="m-b-10">View Customers</h4>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item">
<a href="{{ URL('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item">View Customers</li>
</ul>
</div>
<div class="col">
<div class="float-end">

{{--<a href="{{ URL('license/create') }}" data-size="lg" data-url="{{ URL('license/create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="Create" data-title="Add New" class="btn btn-sm btn-primary">
<i class="ti ti-plus"></i>
</a>--}}

</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body table-border-style">
<div class="table-responsive">
<table class="table datatable">
<thead>
<tr>
<th>Code</th>
<th>Name</th>
<th>Nationality</th>
<th>Email</th>
<th>Mobile</th>
<th>Total Amount</th>
<th>Action</th>
</tr>
</thead>

<tbody>
    
    @foreach($Data as $DT)
    <?php
    $totalAmt=0;
    $customerBookingTotal=DB::table('bookings')->where('customer_id',$DT->id)->count();
    if($customerBookingTotal!=0){
        $customerBookingArr=DB::table('bookings')->where('customer_id',$DT->id)->first();
        $totalAmt=$customerBookingArr->grand_total;
    }
    ?>
    <tr class="font-style" id="customerId-{{$DT->id}}">
    <td>{{ $DT->customer_id }}</td>
    <td>{{ $DT->title }} {{ $DT->first_name }} {{ $DT->last_name }}</td>
    <td>{{ $DT->nationality }}</td>
    <td>{{ $DT->email }}</td>
    <td>+{{ $DT->country_code }}{{ $DT->mobile }}</td>
    <td>{{ $totalAmt }}</td>

    <td class="Action">
                                                <span>
                                                    <div class="action-btn bg-danger ms-2">
                                                            <a href="#" onclick="deleteCustomer({{ @$DT->id }})"
                                                                class="mx-3 btn btn-sm align-items-center"
                                                                data-ajax-popup="true" data-title="Edit Coupon"
                                                                data-bs-toggle="tooltip" title="Delete"
                                                                data-original-title="Edit">
                                                                <i class="fa fa-trash-alt text-white"> </i>
                                                            </a>
                                                    </div>

                                                </span>
                                            </td>

    {{--<td class="Action">
        <span>
    <div class="action-btn bg-primary ms-2">
            <a href="{{ URL('license') }}/{{ $DT->id }}/edit" class="mx-3 btn btn-sm align-items-center" data-url="{{ URL('license') }}/{{ $DT->id }}/edit" data-ajax-popup="true" data-title="Edit Coupon" data-bs-toggle="tooltip"  title="Edit" data-original-title="Edit">
            <i class="ti ti-pencil text-white"></i>
        </a>
    </div>     
    </span>
    </td>--}}
    </tr>
    @endforeach

                        </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<!-- [ Main Content ] end -->
</div>
</div>

<script>
   function deleteCustomer(id){
    console.log("delete customer id - " + id);
    $.ajax({
          url: "{{ URL('customer/delete') }}",
          method: "POST",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            id: id
          },
          success: function( data, textStatus, jqXHR ) {
            var row = $("tr#customerId-"+id); // Get the  row

            row.animate({
                opacity: 0
            }, 400, function () {
                row.remove();
            });

            toastr["success"]("customer deleted successfully")
          },
          error: function( jqXHR, textStatus, errorThrown ) {
            toastr["error"]("Failed to delete customer")
          }
        });
    
}
</script> 
@endsection