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
                            <h4 class="m-b-10">Add License</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Add License</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body ">
                    
                {!! Form::open(['url' => 'license', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}

                    <div class="row">

                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">License Key</label>
                            <input readonly class="form-control font-style" required name="license_key" type="text" value="<?php echo (string) Str::uuid(); ?>" />
                        </div>

                        <div class="form-group col-md-4">
                            <label for="from" class="col-form-label text-dark">License Status</label>
                            <select class="form-control font-style" name="status" required>
                            <option value="">{{ __("Select") }}</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="suspended">Suspended</option>
                        </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="from" class="col-form-label text-dark">Company</label>
                            <select class="form-control font-style" name="company_id" required>
                            <option value="">{{ __("Select") }}</option>
                            @foreach($AllCompany as $Com)
                            <option value="{{ $Com->id }}">{{ $Com->name }}</option>
                            @endforeach
                        </select>
                        </div>

                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">Contact Person Name</label>
                            <input class="form-control font-style" required name="conact_name" type="text" value="{{ old('conact_name') }}" />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">Phone</label>
                            <input class="form-control font-style" required name="mobile" type="text" value="{{ old('mobile') }}" />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">Email</label>
                            <input class="form-control font-style" required name="email" type="text" value="{{ old('email') }}" />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">License for Product</label>
                            <select name="role" onchange="ShowStaff(this.value)" class="form-control font-style" >
                            @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                            </select>
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">User Type</label>
                            <input type="radio"  name="user_type" id="UserTypeAdmin" onclick="ShowNo(true)" checked value="1"> {{ __("Admin") }}
                            <!-- <input type="radio"  name="user_type" onclick="ShowNo(false)" id="UserTypeStaff" value="2"> {{ __("Staff") }} -->
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">Validay (in days)</label>
                            <input class="form-control font-style" required name="validay" type="number" value="{{ old('validay') }}" />
                        </div>

                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">Total Employees</label>
                            <input class="form-control font-style"  name="total_employee" type="number" value="0" />
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