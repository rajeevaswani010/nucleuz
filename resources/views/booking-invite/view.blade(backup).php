@extends("layout.default")

@section("content")

<div class="border-bottom-2 py-32pt position-relative z-1">
    <div class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">{{ __("Invite Customer") }}</h2>
            </div>

            <div><a href="{{ URL('booking-invite/create') }}"><button class="btn btn-primary">{{ __("Add New") }}</button></a></div>
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

        <div class="card mt-4">
            <div class="card-body">
                <table class="table mb-0 thead-border-top-0 table-nowrap">
                    <thead>
                        <tr>
                            <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-name">{{ __("Name") }}</a></th>
                            <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-name">{{ __("Email") }}</a></th>
                            <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-name">{{ __("Status") }}</a></th>
                            <th class="pl-0">{{ __("Action") }}</th>
                        </tr>
                    </thead>
                    <tbody class="list" id="search">
                        @foreach($Data as $DT)
                        <tr>
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
                            <td class="pl-0">
                                @if($DT->status == 1)
                                    <a href="{{ URL('booking') }}/{{ $DT->customer_id }}/edit"><button class="btn btn-success">{{ __("Make Booking") }}</button></a>
                                @endif
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