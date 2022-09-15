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
                                    <p>Nama Siswa : {{ $pengajuan->nama_siswa }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Kelas : {{ $pengajuan->kelas ? $pengajuan->kelas : '-' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Jenis Kelamin : {{ $pengajuan->jenis_kelamin ? $pengajuan->jenis_kelamin : '-' }}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p>Nama Ayah : {{ $pengajuan->nama_ayah ? $pengajuan->nama_ayah : '-' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Nama Ibu : {{ $pengajuan->nama_ibu ? $pengajuan->nama_ibu : '-' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Orang Tua yang Almarhum :
                                        {{ $pengajuan->orang_tua_tiada ? $pengajuan->orang_tua_tiada : '-' }}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p>Penghasilan : {{ $pengajuan->penghasilan ? $pengajuan->penghasilan : '-' }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @if($pengajuan->nama_siswa == null || $pengajuan->kelas == null ||
                                    $pengajuan->jenis_kelamin == null || $pengajuan->nama_ayah == null ||
                                    $pengajuan->nama_ibu == null || $pengajuan->orang_tua_tiada == null ||
                                    $pengajuan->penghasilan == null || $pengajuan->surat_pernyataan == null)
                                    <p class="text-danger">Tidak dapat meluluskan siswa yang tidak mengisi semua data.
                                    </p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('pengajuan.luluskan', $pengajuan->id) }}" method="POST">
                                        <a class="btn btn-warning " href="{{url()->previous()}}"
                                            role="button">Kembali</a>
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-success " role="button">Luluskan</button>
                                    </form>
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