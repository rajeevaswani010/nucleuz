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
<h4 class="m-b-10">Booking Reciepts</h4>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item">
<a href="{{ URL('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item">Booking Reciepts</li>
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
<th>Recipt No</th>
<th>Vehicle</th>
<th>Customer Code</th>
<th>Customer Name</th>
<th>Email</th>
<th>Mobile</th>
<th>Advance Amount</th>
</tr>
</thead>

<tbody>
    
    @foreach($bookingreciept as $DT)
    <?php
    $customerCode="";
    $customerName="";
    $customerMobile="";
    $customerEmail="";
    $customerTotal=DB::table('customers')->where('id',$DT->customer_id)->count();
    if($customerTotal!=0){
        $customerArr=DB::table('customers')->where('id',$DT->customer_id)->first();
        $customerCode=$customerArr->customer_id;
        $customerName=$customerArr->title." ".$customerArr->first_name." ".$customerArr->middle_name." ".$customerArr->last_name;
        $customerMobile="+".$customerArr->country_code."-".$customerArr->mobile;
        $customerEmail=$customerArr->email;
    }
    $recieptNo="R000".$DT->id;
    ?>
    <tr class="font-style">
    <td><a href="{{ URL('booking') }}/{{ $DT->id }}/edit" >{{ $recieptNo }}</a></td>
    <td>{{ $DT->car_type }}</td>
    <td>{{ $customerCode }}</td>
    <td>{{ $customerName }}</td>
    <td>{{ $customerMobile }}</td>
    <td>{{ $customerEmail }}</td>
    <td>{{ $DT->advance_amount }}</td>
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


@endsection