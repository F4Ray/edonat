@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if ($message = Session::get('success'))
            <div class="col-md-12">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {!! $message !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Donatur') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif

                            @if(Auth::user()->role->name == 'donatur')
                            Halo {{ Auth::user()->donatur->nama }}, disini anda dapat memilih berdonasi di program yang
                            telah disediakan.
                            @else
                            Halo Admin, disini Anda dapat mengatur data donatur
                            @endif
                        </div>
                    </div>
                    @if(Auth::user()->role->name != 'donatur')
                    <!-- <div class="row">
                        <div class="col-md-12">

                            <a class="btn btn-primary float-end" href="{{ route('program_donasi.create') }}"
                                role="button">Tambah Data</a>

                        </div>
                    </div> -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Donatur</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" colspan="2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach($donaturs as $donatur)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $donatur->nama }}</td>
                                        <td>{{ $donatur->user->email }}</td>
                                        @if(Auth::user()->role->name == 'donatur')
                                        <td><a class="btn btn-primary btn-sm"
                                                href="{{ route('program_donasi.create') }}">Donasi
                                                Sekarang</a></td>
                                        @else
                                        <td>
                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('donatur.show', $donatur->id) }}">Lihat Detail</a>
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('donatur.edit', $donatur->id) }}">Ganti Password</a>
                                        </td>
                                        @endif
                                    </tr>
                                    @php $no++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection