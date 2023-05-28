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
                            <h4 class="m-b-10">Edit Pricing</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Pricing</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body ">
                    
                {!! Form::open(['url' => 'pricing/'.$Data->id, 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}

                    <div class="row">

                        

                    <div class="form-group col-6">
            <label for="subject" class="col-form-label text-dark">Car Type</label>
            <select class="form-control font-style" name="car_type" required>
                <option value="">Select</option>
                <option @if($Data->car_type == "Hatchback") selected @endif value="Hatchback">Hatchback</option>
                <option @if($Data->car_type == "Sedan") selected @endif value="Sedan">Sedan</option>
                <option @if($Data->car_type == "SUV") selected @endif value="SUV">SUV</option>
                <option @if($Data->car_type == "MUV") selected @endif value="MUV">MUV</option>
                <option @if($Data->car_type == "Coupe") selected @endif value="Coupe">Coupe</option>
                <option @if($Data->car_type == "Convertibles") selected @endif value="Convertibles">Convertibles</option>
                
                <option @if($Data->car_type == "Pickup Trucks") selected @endif value="Pickup Trucks">Pickup Trucks</option>
                
            </select>
        </div>


                       

                        <div class="form-group col-6">
                            <label for="subject" class="col-form-label text-dark">Daily Pricing</label>
                            <input class="form-control font-style" required name="daily_pricing" value="{{ $Data->daily_pricing }}" type="text"  />
                        </div>


                        <div class="form-group col-6">
                            <label for="subject" class="col-form-label text-dark">Weekly Pricing</label>
                            <input class="form-control font-style" required name="weekly_pricing" value="{{ $Data->weekly_pricing }}" type="text"  />
                        </div>


                        <div class="form-group col-6">
                            <label for="subject" class="col-form-label text-dark">Monthly Pricing</label>
                            <input class="form-control font-style"  name="monthly_pricing" value="{{ $Data->monthly_pricing }}" type="text"  />
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
                        
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- [ Main Content ] end -->
    </div>
</div>


@endsection