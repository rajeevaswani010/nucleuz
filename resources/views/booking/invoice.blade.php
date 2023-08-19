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
<th>Invoice No</th>
<th>Booking Id</th>
<th>Customer</th>
<th>Advance Amount</th>
<th>Due Amount</th>
<th>Vehicle damage</th>
<th>Traffic fines</th>
<th>Misc/Others</th>
<th>Grand total</th>
<th>Action</th>
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
        // $customerCode=$customerArr->customer_id;
        //$customerName=$customerArr->title." ".$customerArr->first_name." ".$customerArr->middle_name." ".$customerArr->last_name;
        $customerName=$customerArr->title." ".$customerArr->first_name;
        $customerMobile="+".$customerArr->country_code."-".$customerArr->mobile;
        $customerEmail=$customerArr->email;
    }
    $invoiceNo="IV000".$DT->id;
    $recieptNo="R000".$DT->id;

    $grandTotal=$DT->grand_total;
    $subTotal=$DT->sub_total;
    $advanceAmt=$DT->advance_amount;
    $vatTax=($subTotal * 5) /100;
    $discountAmt=$DT->discount_amount;
    $dueAmt=$subTotal+$vatTax-$advanceAmt-$discountAmt;
    $demageAmt=$DT->dmage;//not sure
    $trafficFines=0;//not sure
    $additionalCharges=$DT->additional_charges;//not sure


    ?>
    <tr class="font-style">
    <td><a href="{{ URL('booking') }}/{{ $DT->id }}/edit">{{ $invoiceNo }}</a></td>
    <td>{{ $recieptNo }}</td>

    <td>
        <div class="d-flex flex-column">
        <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $customerName }}</strong></p>
        <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $customerMobile }}</strong></p>
        <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $customerEmail }}</strong></p>
       </div>
   </td>
   <td>{{ $DT->advance_amount }}</td>
   <td>{{ $dueAmt }}</td>
   <td>{{ $demageAmt }}</td>
   <td>{{ $trafficFines }}</td>
   <td>{{ $additionalCharges }}</td>
   <td>{{ $grandTotal }}</td>
    <td>
    <a href="{{ URL('license') }}/{{ $DT->id }}/edit">
            Export
        </a>
    </td>
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