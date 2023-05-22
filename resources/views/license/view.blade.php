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
<h4 class="m-b-10">View License</h4>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item">
<a href="{{ URL('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item">View License</li>
</ul>
</div>
<div class="col">
<div class="float-end">

<a href="{{ URL('license/create') }}" data-size="lg" data-url="{{ URL('license/create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="Create" data-title="Add New" class="btn btn-sm btn-primary">
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
<table class="table datatable">
<thead>
<tr>
<th>License Key</th>
<th>Product Name</th>
<th>License Expiry</th>
<th>Company</th>
<th>Status</th>
<th>Created By</th>
<th>Creation Date</th>
<th>Updation Date</th>
<th>Action</th>
<!-- <th>Client Name</th> -->
<!-- <th>Mobile</th>
<th>Email</th> -->
</tr>
</thead>

<tbody>
    
    @foreach($Data as $DT)
    <?php
    $productArr=DB::table('products')->where('id',$DT->license_module)->first();
    $company=DB::table('offices')->where('id',$DT->user_id)->first();
    ?>
    <tr class="font-style">
    <td>{{ $DT->license_key }}</td>
    <td>{{ $productArr->name }}</td>
    <td>{{ date('d F Y', strtotime($DT->expiration_date)) }}</td>
    
    @if(is_null($company))
    <td> --- </td>
    @else
    <td>{{ $company->name }}</td>
    @endif  
    
    <td>{{ ucfirst($DT->status) }}</td>
    <td>{{ $DT->created_by }}</td>
    <td>{{ date('d F Y', strtotime($DT->created_at)) }}</td>
    <td>{{ date('d F Y', strtotime($DT->updated_at)) }}</td>
    <td class="Action">
    <!-- <td>{{ $DT->mobile }}</td>
    <td>{{ $DT->email }}</td> -->
    <span>

    <div class="action-btn bg-primary ms-2">
            <a href="{{ URL('license') }}/{{ $DT->id }}/edit" class="mx-3 btn btn-sm align-items-center" data-url="{{ URL('license') }}/{{ $DT->id }}/edit" data-ajax-popup="true" data-title="Edit Coupon" data-bs-toggle="tooltip"  title="Edit" data-original-title="Edit">
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