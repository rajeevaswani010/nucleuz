@extends("layout.default")

@section("content")

<div class="border-bottom-2 py-32pt position-relative z-1">
    <div class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">{{ __("Add License") }}</h2>
            </div>

            <div><a href="{{ URL('license') }}"><button class="btn btn-primary">{{ __("Go Back") }}</button></a></div>
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

    {!! Form::open(['url' => 'license', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
    <div class="row">


        <div class="col-lg-6 mb-4">
            <label>{{ __("License Key") }} <span class="text-danger">*</span></label>
            <input type="text" readonly class="form-control" name="license_key" required value="<?php echo (string) Str::uuid(); ?>">
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("License Status") }} <span class="text-danger">*</span></label>
            <select class="form-control" name="status" required>

                <option value="">{{ __("Select") }}</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="suspended">Suspended</option>

            </select>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Company") }} <span class="text-danger">*</span></label>
            <select class="form-control" name="company_id" required>
                <option value="">{{ __("Select") }}</option>
                @foreach($AllCompany as $Com)
                <option value="{{ $Com->id }}">{{ $Com->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Contact Person Name") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="conact_name" required value="{{ old('conact_name') }}">
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Phone") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="mobile" required value="{{ old('mobile') }}">
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Email") }} <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" required value="{{ old('email') }}">
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("License for Product") }} <span class="text-danger">*</span></label><br>

            <select name="role" onchange="ShowStaff(this.value)" class="form-control" >
            @foreach($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach

          </select>

            {{--<input type="radio" name="role" onclick="ShowStaff(true)" checked value="1"> {{ __("Car Rental") }} &nbsp;&nbsp;
            <input type="radio" name="role" onclick="ShowStaff(false)" value="2"> {{ __("Visitor Management") }}--}}

        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("User Type") }} <span class="text-danger">*</span></label><br>
            <input type="radio" name="user_type" id="UserTypeAdmin" onclick="ShowNo(true)" checked value="1"> {{ __("Admin") }} &nbsp;&nbsp;
            <div id="UserTypeStaffDiv"><input type="radio" name="user_type" onclick="ShowNo(false)" id="UserTypeStaff" value="2"> {{ __("Staff") }}</div>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Validay (in days)") }} <span class="text-danger">*</span></label>
            <input type="number" min="1" class="form-control" name="validay" required value="{{ old('validay') }}">
        </div>

        <div class="col-lg-6" id="ShowEmpoyeCount">
            <label>{{ __("Total Employees") }} <span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="total_employee" required value="0">
        </div>
    </div>

    <button class="btn btn-success mt-4">{{ __("Save") }}</button>
    {!! Form::close() !!}
</div>


<script type="text/javascript">
    function ShowStaff(type){
        if(type==1){
            type=true;
        }
        else{
            type=false;
        }
        if(type){
            $("#UserTypeStaffDiv").css("display", "block");
            ShowNo(false);
        }else{
            $("#UserTypeAdmin").prop("checked", true);
            ShowNo(true);
            $("#UserTypeStaffDiv").css("display", "none");
        }
    }

    function ShowNo(type){
        if(type){
            $("#ShowEmpoyeCount").css("display", "block");
        }else{
            $("#ShowEmpoyeCount").css("display", "none");
        }
    }
</script>
@endsection