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
                            <h4 class="m-b-10">Invite Customer</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Invite Customer</li>
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
                            <label for="subject" class="col-form-label text-dark">Name</label>
                            <input class="form-control font-style" required name="name" type="text" value="{{ old('name') }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="from" class="col-form-label text-dark">Email</label>
                            <input class="form-control font-style"  name="email" type="text" value="{{ old('email') }}" required />
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

<section id="loading">
    <div id="loading-content"></div>
</section>
<script>
// let form = document.querySelector('#form');
// let loader = document.querySelector('#loader')

// form.addEventListener('submit', function (event) {
//     event.preventDefault();
  
//     // using non css framework method with Style
//     loader.style.display = 'block';
  
//     // using a css framework such as TailwindCSS
//     loader.classList.remove('hidden');

//     // pretend the form has been sumitted and returned
//     setTimeout(() => loader.style.display = 'none', 1000);
// });

function showLoading() {
  document.querySelector('#loading').classList.add('loading');
  document.querySelector('#loading-content').classList.add('loading-content');
}

function hideLoading() {
  document.querySelector('#loading').classList.remove('loading');
  document.querySelector('#loading-content').classList.remove('loading-content');
}

showLoading();

</script>
@endsection