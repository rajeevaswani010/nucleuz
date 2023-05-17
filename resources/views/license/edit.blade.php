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
                            <h4 class="m-b-10">Edit License</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit License</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body ">
                <?php
                $admininfo=DB::table('admin')->where('admin_id',$Data->user_id)->first();
                ?>
                    
                    {!! Form::open(['url' => 'license/'.$Data->id, 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}

                    <div class="row">

                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">License Key</label>
                            <input readonly class="form-control font-style" required name="license_key" type="text" value="{{ $Data->license_key }}" />
                        </div>

                        <div class="form-group col-md-4">
                            <label for="from" class="col-form-label text-dark">License Status</label>
                            <select class="form-control font-style" name="status" required>
                            <option value="">{{ __("Select") }}</option>
                            <option @if($Data->status=="active") selected="selected" @endif value="active">Active</option>
                            <option @if($Data->status=="inactive") selected="selected" @endif value="inactive">Inactive</option>

                            <option @if($Data->status=="suspended") selected="selected" @endif value="suspended">Suspended</option>
                        </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="from" class="col-form-label text-dark">Company</label>
                            <select class="form-control font-style" name="company_id" required>
                            @foreach($AllCompany as $Com)
                            <option @if($admininfo->company_id == $Com->id) selected @endif value="{{ $Com->id }}">{{ $Com->name }}</option>
                            @endforeach
                        </select>
                        </div>

                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">Contact Person Name</label>
                            <input class="form-control font-style" required name="conact_name" type="text" value="{{ $admininfo->name }}" />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">Phone</label>
                            <input class="form-control font-style" required name="mobile" type="text" value="{{ $admininfo->mobile }}" />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">Email</label>
                            <input class="form-control font-style" required name="email" type="text" value="{{ $admininfo->email }}" />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">License for Product</label>
                            <select name="role" onchange="ShowStaff(this.value)" class="form-control font-style" >
                            @foreach($products as $product)
                            <option @if($Data->license_module == $product->id) selected @endif value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                   </select>
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">User Type</label>
                            
                            <input type="radio" name="user_type" @if($admininfo->user_type == "1") checked @endif id="UserTypeAdmin" onclick="ShowNo(true)" checked value="1"> {{ __("Admin") }} &nbsp;&nbsp;

                            <!-- <div id="UserTypeStaffDiv">
                                <input @if($admininfo->user_type == "2") checked @endif type="radio" name="user_type" onclick="ShowNo(false)" id="UserTypeStaff" value="2"> {{ __("Staff") }}
                            </div> -->



                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">Validay (in days)</label>
                            <input class="form-control font-style" required name="validay" type="number" value="{{ $Data->validay }}" />
                        </div>

                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">Total Employees</label>
                            <input class="form-control font-style"  name="total_employee" type="number" value="{{ $Data->total_employee }}" />
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