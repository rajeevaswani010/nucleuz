@extends("layout.default")

@section("content")

<div class="border-bottom-2 py-32pt position-relative z-1">
    <div class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">{{ __("Change Password") }}</h2>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid page__container">
    <div class="page-section">
        
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

        {!! Form::open(['url' => 'ChangePassword/SavePass', 'enctype' => 'multipart/form-data', 'method' => 'post']) !!}
        <div class="card-body">
            <div class="body">
                <div class="row clearfix">
                @if($Message != "")
                    <div style="padding:10px; margin-bottom:10px;" class="bg-danger">{{ $Message }}</div>
                @endif

                <div class="col-sm-12">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">{{ __("Mobile") }}</label>
                                <input type="text" class="form-control" name="mobile" required value="{{ $Mobile }}">
                                
                            </div>
                        </div>
                    </div>
                
                    <div class="col-sm-12">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">{{ __("Old Password") }}</label>
                                <input type="password" class="form-control" name="OldPassword" value="{{ old('OldPassword') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">{{ __("New Password") }}</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">{{ __("Confirm New Password") }}</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">{{ __("Image") }}</label>
                                <input type="file" class="form-control" name="UserImage">
                            </div>
                        </div>
                        @if($GetData->image != "")
                        <img src="{{ URL('public').'/'.$GetData->image }}" width="200">
                        @endif
                    </div>
                    
                    <div class="col-sm-12">
                        <input type="submit" class="btn btn-primary waves-effect" value="{{ __('Save') }}">
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}   
    </div>
</div>


@endsection