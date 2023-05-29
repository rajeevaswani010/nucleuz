@extends("layout.default")

@section("content")

<div class="border-bottom-2 py-32pt position-relative z-1">
    <div class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">{{ __("View Vehicle") }}</h2>
            </div>

            <div class="mr-5"><a href="{{ URL('vehicle/create') }}"><button class="btn btn-primary">{{ __("Add New") }}</button></a></div>
            <div><a href="{{ URL('vehicle/Exports') }}"><button class="btn btn-danger">{{ __("Export") }}</button></a></div>
        </div>
    </div>
</div>

<div class="container-fluid page__container mb-5">
    <div class="card mt-5">
        <div class="card-body">
            {!! Form::open(['url' => 'UplaodVehicle', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
            <div class="row">
                <div class="col-lg-4"><input type="file" name="ExcelFile" required class="form-control"></div>
                <div class="col-lg-4"><button class="btn btn-">Upload</button></div>
                <div class="col-lg-4"><a href="{{ URL('public/Vehicle Sample.xlsx') }}">{{ __("Download Sample") }}</a></div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="table-responsive"
         data-toggle="lists"
         data-lists-sort-by="js-lists-values-employee-name"
         data-lists-values='["js-lists-values-employee-name", "js-lists-values-employer-name", "js-lists-values-projects", "js-lists-values-activity", "js-lists-values-earnings"]'>

        <div class="card-header">
            <div class="search-form">
                <input type="text" class="form-control search" placeholder="Search ...">
                <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-body">
                <table class="table mb-0 thead-border-top-0 table-nowrap">
                    <thead>
                        <tr>
                            <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-name">{{ __("Car Detail") }}</a></th>
                            <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-name">{{ __("Chasis") }}</a></th>
                            <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-name">{{ __("Reg. No") }}</a></th>
                            <th class="pl-0">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list" id="search">
                        @foreach($Data as $DT)
                        <tr>
                            <td>
                                <div class="d-flex flex-column">
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->car_type }}</strong></p>
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->make }}</strong></p>
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->model }}</strong></p>
                                </div>
                            </td>
                            <td>{{ $DT->chasis_no }}</td>
                            <td>{{ $DT->reg_no }}</td>
                            <td class="text-right pl-0">
                                <a href="{{ URL('vehicle') }}/{{ $DT->id }}/edit" class="text-50"><i class="material-icons">edit</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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