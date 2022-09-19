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
                            <h1>Donasi untuk {{ $donasi->nama }}</h1>
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <img id="frame" src="{{  asset('storage/assets/foto_donasi/'.$donasi->gambar) }}"
                                        class="img-fluid mx-auto d-block" style="max-height: 300px;" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    Dana Terkumpul : {{$donasi->dana_terkumpul}} <br />
                                    Daftar Pendonasi
                                    <table class="table table-bordered mt-1">
                                        <thead>
                                            <tr>
                                                <!-- <th scope="col">#</th> -->
                                                <th scope="col">Nama</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no=1; @endphp
                                            @foreach($donasi->donatur as $donatur)
                                            <tr>
                                                <!-- <td>{{ $no }}</td> -->
                                                <td>{{ $donatur->nama }}</td>
                                            </tr>
                                            @php $no++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    @if($donasi->is_active==1)
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Distribusikan Donasi
                                    </button>
                                    @else
                                    Program donasi ini sudah tidak aktif, karena dana telah di distribusikan kepada
                                    penerima.
                                    Daftar penerima donasi :
                                    <ol>
                                        @foreach($terima as $distri)
                                        <li>{{ $distri->penerima->nama_siswa }}</li>
                                        @endforeach
                                    </ol>
                                    Setiap penerima mendapatkan {{$donasi->dana_terkumpul}} / {{ count($terima) }} =
                                    Rp. {{ $donasi->dana_terkumpul/count($terima) }} <br />
                                    <a class="btn btn-warning mt-2" href="{{url()->previous()}}"
                                        role="button">Kembali</a>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Distribusi Dana Donasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Donasi akan di distribusikan kepada {{ count($penerimas) }} penerima donasi yang lulus seleksi.
                Daftar penerima donasi :
                <ol>
                    @foreach($penerimas as $penerima)
                    <li>{{ $penerima->nama_siswa }}</li>
                    @endforeach
                </ol>
                Setiap penerima mendapatkan {{$donasi->dana_terkumpul}} / {{ count($penerimas) }} =
                Rp. {{ $donasi->dana_terkumpul/count($penerimas) }} <br />
            </div>
            <div class="modal-footer">
                <form action="{{route('program_donasi.distribusi', $donasi->id)}}" method="post">
                    @csrf
                    @method('put')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Distribusi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection