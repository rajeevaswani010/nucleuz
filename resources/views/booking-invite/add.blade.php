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
                            <h4 class="m-b-10">{{ __("Invite Customer") }}</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">{{ __("Dashboard") }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __("Invite Customer") }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body ">

                {!! Form::open(['url' => 'booking-invite', 'enctype' => 'multipart/form-data', 'method' => 'POST', 'id' => 'form']) !!}

                    <div class="row">

                        <div class="form-group col-6">
                            <label for="subject" class="col-form-label text-dark">{{ __("Name") }}</label>
                            <input class="form-control font-style" required name="name" id="name" type="text" value="{{ old('name') }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="from" class="col-form-label text-dark">{{ __("Email") }}</label>
                            <input class="form-control font-style"  name="email" type="text" id="email" value="{{ old('email') }}" required />
                        </div>

                        <div class="modal-footer">
                            <input class="btn btn-xs btn-primary" type="submit"  value="Save">
                        </div>
                {!! Form::close() !!}

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
    </div>

    <!-- [ Main Content ] end -->
    </div>
</div>
<script>
$(document).ready(function () {
  $("#form").submit(function (event) {

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
            alert("success");
            // redirect("{{ URL('booking-invite') }}");
        },
        error: function( jqXHR, textStatus, errorThrown ) {
            hideloading();
            alert("error");
        }
    }).done(function (data) {
        console.log(data);
    });
    event.preventDefault();
  });
});
</script>
@endsection
