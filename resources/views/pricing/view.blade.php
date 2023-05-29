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
<h4 class="m-b-10">Pricing Master</h4>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item">
<a href="{{ URL('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item">Pricing Master</li>
</ul>
</div>
<div class="col">
<div class="float-end">

<a href="{{ URL('pricing/create') }}" data-size="lg" data-url="{{ URL('pricing/create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="Create" data-title="Add New" class="btn btn-sm btn-primary">
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
            {!! Form::open(['url' => 'UploadPricing', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
            <div class="row">
                <div class="col-lg-4"><input type="file" name="ExcelFile" required class="form-control"></div>
                <div class="col-lg-4"><button class="btn btn-primary">Upload</button></div>
                <div class="col-lg-4"><a href="{{ URL('public/pricing sample.xlsx') }}" class="btn btn-primary" style="float: right;">{{ __("Download Sample") }}</a></div>
            </div>
            {!! Form::close() !!}
        </div>
</div>

<div class="card">
<div class="card-body table-border-style">
<div class="table-responsive">
<table class="table datatable">
<thead>
<tr>
<th>Car Detail</th>
<th>Daily</th>
<th>Weekly</th>
<th>Monthly</th>
<th>Action</th>
</tr>
</thead>

<tbody>
    
    @foreach($Data as $DT)
   
    <tr class="font-style">
    <td>{{ $DT->car_type }}</td>
    <td>{{ $DT->daily_pricing }}</td>
    <td>{{ $DT->weekly_pricing }}</td>
    <td>{{ $DT->monthly_pricing }}</td>
    
    <td class="Action">
        <span>

    <div class="action-btn bg-primary ms-2">
            <a href="{{ URL('pricing') }}/{{ $DT->id }}/edit" class="mx-3 btn btn-sm align-items-center" data-url="{{ URL('pricing') }}/{{ $DT->id }}/edit" data-ajax-popup="true" data-title="Edit Coupon" data-bs-toggle="tooltip"  title="Edit" data-original-title="Edit">
            <i class="ti ti-pencil text-white"></i>
        </a>


        {{--<div class="action-btn bg-danger ms-2">
        {!! Form::open(['method' => 'Delete', 'route' => ['pricing.destroy', $DT->id]]) !!}
        <button onClick="return GoDeleteCat()" type="submit" style="border: none; background: none">
        <i class="ti ti-trash text-white"></i></button>
        {!! Form::close() !!}
        </div>--}}




        <div class="action-btn bg-danger ms-2" style="margin-right: -36px;">
           
        {!! Form::open(['method' => 'Delete', 'id'=>'delete-form-pricing','route' => ['pricing.destroy', $DT->id]]) !!}
            <button type="submit" onClick="return GoDeleteCat()" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="" data-original-title="Delete"><i class="ti ti-trash text-white"></i></button>
        {!! Form::close() !!}
        </div>


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

<script type="text/javascript">
function GoDeleteCat(ID){
    if(confirm("Are you sure to Delete This Record. Once you deleted, no data will be recovered")){
        return true;
    }
    
    return false;
}
</script>

@endsection