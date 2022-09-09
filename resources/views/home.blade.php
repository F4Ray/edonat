@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
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
                    Halo {{ Auth::user()->donatur->nama }}, Kamu adalah penerima donatur
                    @else
                    Halo Admin, Selamat datang di aplikasi donatur
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection