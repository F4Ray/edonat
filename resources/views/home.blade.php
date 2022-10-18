@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color:white">
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(Auth::user()->role->name == 'donatur')
                    Halo {{ Auth::user()->donatur->nama }}, Selamat datang di aplikasi donatur
                    @elseif(Auth::user()->role->name == 'penerima donasi')
                    Halo {{ Auth::user()->penerima->nama_siswa }}, Kamu adalah penerima donatur
                    @else
                    Halo Admin, Selamat datang di aplikasi donatur
                    @endif
                </div>
            </div>
        </div>
    </div> -->
    <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="{{ asset('storage/ladun/5299.jpg') }}" class="d-block mx-lg-auto img-fluid"
                    alt="Bootstrap Themes" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3">Selamat Datang di aplikasi E-Donate</h1>
                <p class="lead">Mari bantu sesama melalui berdonasi. Sedikit bagi kita, banyak artinya bagi mereka.</p>
            </div>
        </div>
    </div>
</div>
@endsection