@extends("layout.default")

@section("content")

@php
$CheckStaff = App\Models\Staff::where("company_id", session("CompanyLinkID"))->count();
//$GetMaxNumber = App\Models\License::where("company_id", session("CompanyLinkID"))->where("user_type", 1)->latest()->first();

$role = array("Super Admin", "Admin", "Staff");
@endphp

<!-- [ Main Content ] start -->
<div class="dash-container">
<div class="dash-content">
<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-auto">
<div class="page-header-title">
<h4 class="m-b-10">{{ __("View Staff") }}</h4>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item">
<a href="{{ URL('dashboard') }}">{{ __("Dashboard") }}</a></li>
<li class="breadcrumb-item">{{ __("View Staff") }}</li>
</ul>
</div>
<div class="col">
<div class="float-end">
{{--@if($GetMaxNumber->total_employee > $CheckStaff)--}}
<a href="{{ URL('staff/create') }}" data-size="lg" data-url="{{ URL('staff/create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="Create" data-title="Add New" class="btn btn-sm btn-primary">
<i class="ti ti-plus"></i>
</a>
{{--@endif--}}

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
<th>{{ __("Image") }}</th>
<th>{{ __("Name") }}</th>
<!-- <th>ID</th> -->
<th>{{ __("Mobile") }}</th>
<th>{{ __("Email") }}</th>
<!-- <th>Role</th> -->
<th>{{ __("Action") }}</th>
</tr>
</thead>

<tbody>
    
    @foreach($Data as $DT)
    <tr class="font-style">
    <td>{{ $DT->image }}</td>
    <td>
        <div class="d-flex flex-column">
        <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->name }}</strong></p>
        <small class="js-lists-values-employee-email text-50">{{ $DT->conact_name }}</small>
        </div>
    </td>

    <!-- <td>{{ $DT->admin_id }}</td> -->
    <td>{{ $DT->mobile }}</td>
    <td>{{ $DT->email }}</td>
    <!-- <td>{{ $DT->role }}</td> -->
    <td class="Action">
        <span>
        <div class="action-btn bg-primary ms-2">
            <!-- <a href="{{ URL('staff') }}/{{ $DT->admin_id }}/edit" class="mx-3 btn btn-sm align-items-center" data-url="{{ URL('staff') }}/{{ $DT->admin_id }}/edit" data-ajax-popup="true" data-title="Edit Coupon" data-bs-toggle="tooltip"  title="Edit" data-original-title="Edit"> -->
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