@extends("layout.default")

@section("content")
<script>
    //get parameters
    const urlParams = new URLSearchParams(window.location.search);
</script>

<!-- [ Main Content ] start -->
<div class="dash-container">
    <div class="dash-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="page-header-title">
                            <h4 class="m-b-10">{{ __("Invite Customer") }}</h4>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ URL('dashboard') }}">{{ __("Dashboard") }}</a></li>
                            <li class="breadcrumb-item">{{ __("Invite Customer") }}</li>
                        </ul>
                    </div>
                    <div class="col">
                        <div class="float-end">

                            <!-- <a href="{{ URL('booking-invite/create') }}" data-size="lg"
                                data-url="{{ URL('booking-invite/create') }}" data-ajax-popup="true"
                                data-bs-toggle="tooltip" title="Create" data-title="Add New"
                                class="btn btn-sm btn-primary">
                                <i class="ti ti-plus"></i>
                            </a> -->
                            <button type="button" title="Send a Invite" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#inviteCustomerModal">
                            <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form>
            <div class="card">
                <div class="row align-items-end  mt-1 mb-1">
                    <div class="col-lg-2">
                        <label>{{ __("Status") }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">{{ __("All") }}</option>
                            <option value=0>{{ __("Pending") }}</option>
                            <option value=1>{{ __("Registered") }}</option>
                            <option value=2>{{ __("Finish") }}</option>
                        </select>
                        <script>
                            $('#status').val(urlParams.get('status'));
                        </script>
                    </div>

                    <div class="col-lg-2">
                        <label>{{ __("Created From") }}</label>
                        <input type="date" class="form-control" id="from_date" name="from_date"
                            onchange="validateDateRange()">
                    </div>

                    <div class="col-lg-2">
                        <label>{{ __("Created To") }}</label>
                        <input type="date" class="form-control" id="to_date" name="to_date"
                            onchange="validateDateRange()">
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-4"><button title="search" class="btn btn-primary"
                            role="button">{{ __("Search") }}</i></button></div>
                </div>
            </div>
            <script>
                $('#from_date').val(urlParams.get('from_date'));
                $('#to_date').val(urlParams.get('to_date'));
            </script>

        </form>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <?php //echo '<pre>';print_r($Data); die; ?>
                            <table class="table datatable table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __("Name") }}</th>
                                        <th>{{ __("Email") }}</th>
                                        <th>{{ __("Created On") }}</th>
                                        <th>{{ __("Updated On") }}</th>
                                        <th>{{ __("Status") }}</th>
                                        <th>{{ __("Action") }}</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($Data as $DT)
                                        <tr class="font-style" id="inviteId-{{$DT->id}}" >
                                            <td>{{ $DT->name }}</td>
                                            <td>{{ $DT->email }}</td>
                                            <td>{{ $DT->created_at }}</td>
                                            <td>{{ $DT->updated_at }}</td>
                                            <td>
                                                @if($DT->status == 0)
                                                    {{ __("Pending") }}
                                                    <span class="indicator-line rounded bg-warning"></span>
                                                @endif

                                                @if($DT->status == 1)
                                                    {{ __("Registered") }}
                                                    <span class="indicator-line rounded bg-primary"></span>
                                                @endif

                                                @if($DT->status == 2)
                                                    {{ __("Finish") }}
                                                    <span class="indicator-line rounded bg-success"></span>
                                                @endif
                                            </td>
                                            <td class="Action">
                                                <span>

                                                    @if($DT->status == 0)
                                                        <div class="action-btn bg-primary ms-2" style="opacity: 0.5;">
                                                            <a href="{{ URL('booking') }}/create?inviteId={{ @$DT->id }}"
                                                                class="disabled mx-3 btn btn-sm align-items-center"
                                                                data-url="{{ URL('booking-invite') }}/destroy"
                                                                data-ajax-popup="true" data-title="Edit Coupon"
                                                                data-bs-toggle="tooltip" title="Edit"
                                                                data-original-title="Edit">
                                                                <i class="fa fa-pencil-alt text-white"></i>
                                                            </a>
                                                        </div>
                                                    @elseif($DT->status == 1)
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
                                                    @endif
                                                    <div class="action-btn bg-danger ms-2">
                                                            <a href="#" onclick="deleteInvite({{ @$DT->id }})"
                                                                class="mx-3 btn btn-sm align-items-center"
                                                                data-url="{{ URL('booking-invite') }}/destroy"
                                                                data-ajax-popup="true" data-title="Edit Coupon"
                                                                data-bs-toggle="tooltip" title="Delete"
                                                                data-original-title="Edit">
                                                                <i class="fa fa-trash-alt text-white"> </i>
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
<script>
    function validateDateRange() {
        $from = $("#from_date").val();
        $to = $("#to_date").val();

        $("#to_date").attr("min", $from);
        $("#from_date").attr("max", $to);
    }
</script>

<!-- Modal send invite -->
<div class="modal" id="inviteCustomerModal" tabindex="-1" role="dialog" aria-labelledby="inviteCustomerModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __("Invite Customer") }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        {!! Form::open(['url' => 'booking-invite', 'enctype' => 'multipart/form-data', 'method'
                        => 'POST', 'id' => 'inviteform']) !!}

                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="from" class="col-form-label text-dark">{{ __("Email") }}</label>
                                <input class="form-control font-style" name="email" type="text" id="email"
                                    value="{{ old('email') }}" required />
                            </div>

                            <div class="form-group col-6">
                                <label for="subject" class="col-form-label text-dark">{{ __("Name") }}</label>
                                <input class="form-control font-style" required name="name" id="name" type="text"
                                    value="{{ old('name') }}" />
                            </div>
                            @if(Session::has('Danger'))
                                <div class="alert alert-danger" role="alert">
                                    <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                                    <div class="alert-text">{!!Session::get('Danger')!!}</div>
                                </div>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __("Close") }}</button>
                <input class="btn btn-xs btn-primary" type="submit" value='{{ __("Send") }}'>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script>
$("#inviteform").submit(function (event) {

    var formData = {
    name: $("#name").val(),
    email: $("#email").val(),
    };
    showloading();
    $.ajax({
        url: "{{ URL('booking-invite/add') }}",
        method: "POST",
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        data: formData,
        dataType: "json",
        encode: true,
        success: function( data, textStatus, jqXHR ) {
            hideloading();
            $('#inviteCustomerModal').modal("hide");
            window.location.reload();
        },
        error: function( jqXHR, textStatus, errorThrown ) {
            hideloading();
            alert("error");
        }
    })
    event.preventDefault();
});

function deleteInvite(id){
    console.log("delete invite id - " + id);
    $.ajax({
          url: "{{ URL('booking-invite/delete') }}",
          method: "POST",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            id: id
          },
          success: function( data, textStatus, jqXHR ) {
            var row = $("tr#inviteId-"+id); // Get the  row

            row.animate({
                opacity: 0
            }, 400, function () {
                row.remove();
            });

            toastr["success"]("Invite deleted successfully")
          },
          error: function( jqXHR, textStatus, errorThrown ) {
            toastr["error"]("Failed to delete Invite")
          }
    });
    
}
</script>
@endsection