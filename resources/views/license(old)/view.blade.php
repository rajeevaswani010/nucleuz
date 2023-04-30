@extends("layout.default")

@section("content")
<style>
    .table-responsive{
        width: 109%!important;
    }
</style>

<div class="border-bottom-2 py-32pt position-relative z-1">
    <div class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">{{ __("View License") }}</h2>
            </div>

            <div><a href="{{ URL('license/create') }}"><button class="btn btn-primary">{{ __("Add New") }}</button></a></div>
        </div>
    </div>
</div>

<div class="container-fluid page__container mt-5 mb-5">
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

        <div class="card mt-3">
            <div class="card-body">
                <table class="table mb-0 thead-border-top-0 table-nowrap">
                    <thead>
                        <tr>

                            {{--<th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-name">{{ __("License Code") }}</a></th>--}}

                            <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-name">{{ __("Product Name") }}</a></th>

                            <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-name">{{ __("License Expiry") }}</a></th>


                            <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-name">{{ __("Client Name") }}</a></th>

                            <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-mobile">{{ __("Mobile") }}</a></th>

                            <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-activity">{{ __("Email") }}</a></th>

                            <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-name">{{ __("Status") }}</a></th>

                            <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-name">{{ __("Date") }}</a></th>

                            <th class="pl-0">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list" id="search">
                        @foreach($Data as $DT)
                        <?php
                       $productArr=DB::table('products')->where('id',$DT->license_module)->first();
                        ?>
                       
                        <tr>
                            {{--<td>
                                <div class="d-flex flex-column">
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">
                                        <?php echo substr($DT->license_key,0,10)."..."; ?>
                                    </strong></p>
                                </div>
                            </td>--}}


                            <td>
                                <div class="d-flex flex-column">
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $productArr->name }}</strong></p>
                                </div>
                            </td>

                            <td>
                                <div class="d-flex flex-column">
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">
                                    {{ date('d F Y', strtotime($DT->expiration_date)) }}
                                    </strong></p>
                                </div>
                            </td>

                            <td>
                                <div class="d-flex flex-column">
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->name }}</strong></p>
                                </div>
                            </td>

                            <td class="text-50 js-lists-values-activity small">{{ $DT->mobile }}</td>

                            <td class="text-50 js-lists-values-activity small">{{ $DT->email }}</td>

                            <td class="text-50 js-lists-values-activity small">{{ ucfirst($DT->status) }}</td>
                            <td class="text-50 js-lists-values-activity small">{{ date('d F Y', strtotime($DT->updated_at)) }}</td>
                            <td class="pl-0">
                                <a href="{{ URL('license') }}/{{ $DT->id }}/edit" class="text-50"><i class="material-icons">{{ __("edit") }}</i></a>
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
// function GoDeleteCat(ID){
//     if(confirm("Are you sure to Delete This Record. Once you deleted, no data will be recovered")){
//         return true;
//     }
    
//     return false;
// }
</script>
@endsection