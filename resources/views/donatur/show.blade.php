@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                @if ($message = Session::get('success'))
                <div class="col-md-12">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">

                        {!! $message !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
            </div>
            <div class="card">
                <div class="card-header">{{ __('Donatur') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if(Auth::user()->role->name == 'donatur')
                            <h1>Profile</h1>
                            @else
                            <h1>Data Donatur</h1>
                            @endif
                            <div class="row">
                                <div class="col-md-4 float-md-left float-lg-left">
                                    <p>Nama Donatur : {{ $donatur->nama }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Jenis Kelamin : {{ $donatur->jenis_kelamin ? $donatur->jenis_kelamin : '-' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Nomor Telepon : {{ $donatur->telepon ? $donatur->telepon : '-' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Alamat : {{ $donatur->alamat ? $donatur->alamat : '-' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Alamat Email : {{ $donatur->user->email ? $donatur->user->email : '-' }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @if(Auth::user()->role->name == 'donatur')
                                    <a class="btn btn-primary " href="{{ route('donatur.edit', $donatur->id) }}"
                                        role="button">Edit Data</a>
                                    @else
                                    <a class="btn btn-warning " href="{{url()->previous()}}" role="button">Kembali</a>
                                    <a class="btn btn-primary " href="{{ route('donatur.edit', $donatur->id) }}"
                                        role="button">Ganti
                                        Password</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection