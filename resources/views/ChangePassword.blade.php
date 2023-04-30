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
                            <h4 class="m-b-10">Change Password</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body ">
                    
                {!! Form::open(['url' => 'ChangePassword/SavePass', 'enctype' => 'multipart/form-data', 'method' => 'post']) !!}

                    <div class="row">

                    @if($Message != "")
                    <div style="padding:10px; margin-bottom:10px;" class="bg-danger">{{ $Message }}</div>
                @endif

                        <div class="form-group col-6">
                            <label for="subject" class="col-form-label text-dark">Mobile</label>
                            <input class="form-control font-style" required name="mobile" value="{{ $Mobile }}" type="text"  />
                        </div>
                        <div class="form-group col-6">
                            <label for="subject" class="col-form-label text-dark">{{ __("Image") }}</label>
                            <input type="file" class="form-control font-style" name="UserImage">

                            @if($GetData->image != "")
                            <img src="{{ URL('public').'/'.$GetData->image }}" width="200">
                            @endif

                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">Old Password</label>
                            <input class="form-control font-style" required name="OldPassword"  type="password"  />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">New Password</label>
                            <input class="form-control font-style" required name="password"  type="password"  />
                        </div>

                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">Confirm New Password</label>
                            <input class="form-control font-style" required name="password_confirmation"  type="password"  />
                        </div>


                        


                        <div class="modal-footer">
                            <input class="btn btn-xs btn-primary" type="submit" value="Save">
                        </div>
                        {!! Form::close() !!}

                        @if(Session::has('Danger'))
                        <div class="alert alert-danger" role="alert">
                            <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                            <div class="alert-text">{!!Session::get('Danger')!!}</div>
                        </div>
                        @endif

                        @if(Session::has('Success'))
                        <div class="alert alert-success" role="alert">
                            <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                            <div class="alert-text">{!!Session::get('Success')!!}</div>
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