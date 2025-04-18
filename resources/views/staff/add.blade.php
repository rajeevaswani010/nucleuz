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
                            <h4 class="m-b-10">{{ __("Add Staff") }}</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">{{ __("Dashboard") }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __("Add Staff") }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body ">
                    
                {!! Form::open(['url' => 'staff', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}

                    <div class="row">

                        <div class="form-group col-12">
                            <label for="subject" class="col-form-label text-dark">{{ __("Name") }}</label>
                            <input class="form-control font-style" required name="name" type="text" value="{{ old('name') }}" />
                        </div>
                        <div class="form-group col-6">
                            <label for="subject" class="col-form-label text-dark">{{ __("Phone") }}</label>
                            <input class="form-control font-style" required name="mobile" type="text" value="{{ old('mobile') }}" />
                        </div>
                        <div class="form-group col-6">
                            <label for="subject" class="col-form-label text-dark">{{ __("Email") }}</label>
                            <input class="form-control font-style" required name="email" type="text" value="{{ old('email') }}" />
                        </div>
                        
                        <div class="modal-footer">
                            <input class="btn btn-xs btn-primary" type="submit" value='{{ __("Save") }}'>
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


@endsection