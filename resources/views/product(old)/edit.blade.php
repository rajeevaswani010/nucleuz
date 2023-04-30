@extends("layout.default")

@section("content")


<div class="border-bottom-2 py-32pt position-relative z-1">
    <div class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">{{ __("Edit Product") }}</h2>
            </div>

            <div><a href="{{ URL('product') }}"><button class="btn btn-primary">{{ __("Go Back") }}</button></a></div>
        </div>
    </div>
</div>

<div class="container-fluid page__container mt-5 mb-5">
    @if(Session::has('Danger'))
    <div class="alert alert-danger" role="alert">
        <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
        <div class="alert-text">{!!Session::get('Danger')!!}</div>
    </div>
    @endif

    {!! Form::open(['url' => 'product/'.$Data->id, 'method' => 'PUT']) !!}
    <div class="row">
        <div class="col-lg-6 mb-4">
            <label>{{ __("Name") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" value="{{ $Data->name }}" required>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Status") }} <span class="text-danger">*</span></label>
           
            <select class="form-control" name="status">
                <option <?php if($Data->status=="deactive"){ echo 'selected="selected"'; }  ?> value="deactive">Deactive</option>
                <option <?php if($Data->status=="active"){ echo 'selected="selected"'; }  ?> value="active">Active</option>
            </select>
        </div>

        <div class="col-lg-12 mb-4">
            <label>{{ __("Description") }} <span class="text-danger">*</span></label>
            <textarea class="form-control" name="description" required>{{ $Data->description }}</textarea>
        </div>

        

    </div>

    <button class="btn btn-success mt-4">{{ __("Save") }}</button>
    {!! Form::close() !!}
</div>
@endsection