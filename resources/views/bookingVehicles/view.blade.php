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
                            <h4 class="m-b-10">{{ __("Booking Vehicles") }}</h4>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ URL('dashboard') }}">{{ __("Dashboard") }}</a></li>
                            <li class="breadcrumb-item">{{ __("Booking Vehicles") }}</li>
                        </ul>
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
                            <table class="table datatable table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __("Booking Id") }}</th>
                                        <th>{{ __("Car Type") }}</th>
                                        <th>{{ __("Make") }}</th>
                                        <th>{{ __("Model") }}</th>
                                        <th>{{ __("Variant") }}</th>
                                        <th>{{ __("Reg. Number") }}</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($Data as $DT)
                                        <tr class="font-style" id="inviteId-{{$DT->id}}" >
                                            <td>{{ $DT->booking_id }}</td>
                                            <td>{{ $DT->car_type }}</td>
                                            <td>{{ $DT->make }}</td>
                                            <td>{{ $DT->model }}</td>
                                            <td>{{ $DT->variant }}</td>
                                            <td>{{ $DT->reg_no }}</td>
                                            <td class="Action">
                                                <span>

                                                        <div class="action-btn bg-primary ms-2">
                                                            <a href="{{ URL('booking') }}/create?inviteId={{ @$DT->id }}"
                                                                class="mx-3 btn btn-sm align-items-center"
                                                                data-url="{{ URL('booking') }}/create"
                                                                data-ajax-popup="true" data-title="Edit Coupon"
                                                                data-bs-toggle="tooltip" title="Delete"
                                                                data-original-title="Edit">
                                                                <i class="fa fa-pencil-alt text-white"></i>
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