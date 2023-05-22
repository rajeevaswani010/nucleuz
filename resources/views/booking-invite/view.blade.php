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
<h4 class="m-b-10">Invite Customer</h4>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item">
<a href="{{ URL('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item">Invite Customer</li>
</ul>
</div>
<div class="col">
<div class="float-end">

<a href="{{ URL('booking-invite/create') }}" data-size="lg" data-url="{{ URL('booking-invite/create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="Create" data-title="Add New" class="btn btn-sm btn-primary">
<i class="ti ti-plus"></i>
</a>

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
    <?php //echo '<pre>';print_r($Data); die; ?>
<table class="table datatable">
<thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>
    
    @foreach($Data as $DT)
    <tr class="font-style">
    <td>{{ $DT->name }}</td>
    <td>{{ $DT->email }}</td>
    <td>
        @if($DT->status == 0)
        {{ __("Pending") }}
        <span class="indicator-line rounded bg-warning"></span>
        @endif

        @if($DT->status == 1)
        {{ __("Customer Registered") }}
        <span class="indicator-line rounded bg-primary"></span>
        @endif

        @if($DT->status == 2)
        {{ __("Finish") }}
        <span class="indicator-line rounded bg-success"></span>
        @endif
    </td>
    <td class="Action">
        <span>

    <div class="action-btn bg-primary ms-2">
            <a href="{{ URL('booking') }}/{{ $DT->booking_id }}/edit" class="mx-3 btn btn-sm align-items-center" data-url="{{ URL('booking') }}/{{ $DT->booking_id }}/edit" data-ajax-popup="true" data-title="Edit Coupon" data-bs-toggle="tooltip"  title="Edit" data-original-title="Edit">
            <i class="ti ti-pencil text-white"></i>
        </a>
    </div>
           
    </span>
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