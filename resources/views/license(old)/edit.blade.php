@extends("layout.default")

@section("content")

<?php //echo '<pre>'; print_r();echo '</pre>'; ?>

<div class="border-bottom-2 py-32pt position-relative z-1">
    <div class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">{{ __("Edit License") }}</h2>
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


    <?php
    $admininfo=DB::table('admin')->where('admin_id',$Data->user_id)->first();
    ?>

    <div class="card"> 
        <div class="card-body"> 
            {!! Form::open(['url' => 'license/'.$Data->id, 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}
            <div class="row">


            <div class="col-lg-6 mb-4">
                <label>{{ __("License Key") }} <span class="text-danger">*</span></label>
                <input type="text" readonly class="form-control" name="license_key" required value="{{ $Data->license_key }}">
            </div>

            <div class="col-lg-6 mb-4">
                <label>{{ __("License Status") }} <span class="text-danger">*</span></label>
                <select class="form-control" name="status" required>

                    <option value="">{{ __("Select") }}</option>
                    <option @if($Data->status=="active") selected="selected" @endif value="active">Active</option>
                    <option @if($Data->status=="inactive") selected="selected" @endif value="inactive">Inactive</option>

                    <option @if($Data->status=="suspended") selected="selected" @endif value="suspended">Suspended</option>

                </select>
            </div>

                <div class="col-lg-6 mb-4">
                    <label>{{ __("Company") }}<span class="text-danger">*</span></label>
                    <select class="form-control" name="company_id" required>
                        <option value="">{{ __("Select") }}</option>
                        @foreach($AllCompany as $Com)
                        <option @if($admininfo->company_id == $Com->id) selected @endif value="{{ $Com->id }}">{{ $Com->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-6 mb-4">
                    <label>{{ __("Contact Person Name") }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="conact_name" required value="{{ $admininfo->name }}">
                </div>

                <div class="col-lg-6 mb-4">
                    <label>{{ __("Phone") }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="mobile" required value="{{ $admininfo->mobile }}">
                </div>

                <div class="col-lg-6 mb-4">
                    <label>{{ __("Email") }} <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" disabled required value="{{ $admininfo->email }}">
                </div>

                <div class="col-lg-6 mb-4">
                    <label>{{ __("License for Product") }} <span class="text-danger">*</span></label><br>
                    
                    <select name="role" onchange="ShowStaff(this.value)" class="form-control" >
                    @foreach($products as $product)
                    <option @if($Data->license_module == $product->id) selected @endif value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                   </select>

                    
                    {{--<input type="radio" name="role" @if($admininfo->role == "1") checked @endif onclick="ShowStaff(true)" value="1"> {{ __("Car Rental") }} &nbsp;&nbsp;
                    <input type="radio" name="role" @if($admininfo->role == "2") checked @endif onclick="ShowStaff(false)" value="2"> {{ __("Visitor Management") }}--}}


                </div>

                <div class="col-lg-6 mb-4">
                    <label>{{ __("User Type") }} <span class="text-danger">*</span></label><br>
                    <input type="radio" name="user_type" @if($admininfo->user_type == "1") checked @endif id="UserTypeAdmin" onclick="ShowNo(true)" checked value="1"> {{ __("Admin") }} &nbsp;&nbsp;
                    <div id="UserTypeStaffDiv"><input @if($admininfo->user_type == "2") checked @endif type="radio" name="user_type" onclick="ShowNo(false)" id="UserTypeStaff" value="2"> {{ __("Staff") }}</div>
                </div>

               {{-- @if($admininfo->role == 2)--}}
                <div class="col-lg-6" id="ShowEmpoyeCount">
                    <label>{{ __("Total Employees") }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="total_employee" required value="{{ $Data->total_employee }}">
                </div>
                {{--@endif--}}
                
            </div>

            <button class="btn btn-success mt-4">{{ __("Save") }}</button>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-body">
            <h2>{{ __("Subscription History") }}</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __("Start Date") }}</th>
                        <th>{{ __("End Date") }}</th>
                        <th>{{ __("Validity") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Subscription as $Sub)
                    <tr>
                        <td>{{ $Sub->start_date }}</td>
                        <td>{{ $Sub->end_date }}</td>
                        <td>{{ $Sub->validity }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="card mt-5"> 
        <div class="card-body"> 
            <h2>{{ __("Update Subscription") }}</h2>
            {!! Form::open(['url' => 'UpdateSubscription', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
            <input type="hidden" name="OfficeID" value="{{ $Data->id }}">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <label>{{ __("Start Date") }} <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="start_date" required min="{{ date('Y-m-d') }}">
                </div>

                <div class="col-lg-6 mb-4">
                    <label>{{ __("Validity") }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="validity" required>
                </div>
            </div>

            <button class="btn btn-success mt-4">{{ __("Save") }}</button>
            {!! Form::close() !!}
        </div>
    </div>
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