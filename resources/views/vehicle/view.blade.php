@extends("layout.default")

@section("content")

@php
    $additionalFeatureColRenderer["yes"] = '<span><i class="fa fa-check"></i></span>';
    $additionalFeatureColRenderer["no"] = '<span><i class="fa fa-cross"></i></span>';
@endphp

<!-- [ Main Content ] start -->
<div class="dash-container">
<div class="dash-content">
<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-auto">
<div class="page-header-title">
<h4 class="m-b-10">View Vehicle</h4>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item">
<a href="{{ URL('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item">View Vehicle Details</li>
</ul>
</div>
<div class="col">
<div class="float-end">

<a href="{{ URL('vehicle/create') }}" data-size="lg" data-url="{{ URL('vehicle/create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="Create" data-title="Add New" class="btn btn-sm btn-primary">
<i class="ti ti-plus"></i>
</a>

</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">

<div class="card mt-5">
        <div class="card-body">
            {!! Form::open(['url' => 'UplaodVehicle', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
            <div class="row">
                <div class="col-lg-4"><input type="file" name="ExcelFile" required class="form-control"></div>
                <div class="col-lg-4"><button class="btn btn-success">Upload</button></div>
                <div class="col-lg-4"><a href="{{ URL('public/Vehicle Sample.xlsx') }}">{{ __("Download Sample") }}</a></div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    {{--<div class="card-header">
        <div class="search-form">
            <input type="text" class="form-control search" placeholder="Search ...">
            <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
        </div>
    </div>--}}


<div class="card">
<div class="card-body table-border-style">
<div class="table-responsive">
<table class="table datatable">
<thead>
<tr>
<th>Type</th>
<th>Make</th>
<th>Model</th>
<th>Mfg. Year</th>
<th>Reg. No.</th>
<th>Additional Features</th>
<th>Action</th>
</tr>
</thead>

<tbody>
    
    @foreach($Data as $DT)
   
    <tr class="font-style">
    <td>{{ $DT->car_type }}</td>
    <td>{{ $DT->make }}</td>
    <td>{{ $DT->model }}</td>
    <td>{{ $DT->variant }}</td>
    <td>{{ $DT->reg_no }}</td>
    <td>AC:{{ $DT->ac }} | Audio:{{ $DT->Audio }} | GPS:{{ $DT->gps }} </td>
    
    <td class="Action">
        <span>

    <div class="action-btn bg-primary ms-2">
            <a href="{{ URL('vehicle') }}/{{ $DT->id }}/edit" class="mx-3 btn btn-sm align-items-center" data-url="{{ URL('vehicle') }}/{{ $DT->id }}/edit" data-ajax-popup="true" data-title="Edit Coupon" data-bs-toggle="tooltip"  title="Edit" data-original-title="Edit">
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