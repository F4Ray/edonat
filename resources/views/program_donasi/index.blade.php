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
                <div class="card-header">{{ __('Program Donasi') }}</div>

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
                            Halo Admin, disini Anda dapat mengatur data program donasi
                            @endif
                        </div>
                    </div>
                    @if(Auth::user()->role->name != 'donatur')
                    <div class="row">
                        <div class="col-md-12">

                            <a class="btn btn-primary float-end" href="{{ route('program_donasi.create') }}"
                                role="button">Tambah Data</a>

                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Program</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Dana Terkumpul</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach($programDonasi as $donasi)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $donasi->nama }}</td>
                                        <td>{{ $donasi->keterangan }}</td>
                                        <td>Rp {{ $donasi->dana_terkumpul }}</td>
                                        @if(Auth::user()->role->name == 'donatur')
                                        <td><a class="btn btn-primary btn-sm"
                                                href="{{ route('program_donasi.create') }}">Donasi
                                                Sekarang</a></td>
                                        @else
                                        <td>
                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('program_donasi.show', $donasi->id) }}">Lihat Detail</a>
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
                    <div class="row mt-3">
                        @foreach($programDonasi as $donasi)
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img src="{{  asset('storage/assets/foto_donasi/'.$donasi->gambar) }}" height="286px"
                                    width="286px" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $donasi->nama }}</h5>
                                    <p class="card-text">{{ $donasi->keterangan }}</p>
                                    <p class="card-text mt-1">Rp {{ $donasi->dana_terkumpul }}</p>
                                    <a href="{{route('program_donasi.donasi_donatur', $donasi->id)}}"
                                        class="btn btn-primary">Donasi
                                        Sekarang</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection