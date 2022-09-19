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
                            Halo Admin, disini Anda dapat mengatur data penerima donasi
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Siswa</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Nama Ayah</th>
                                        <th scope="col">Nama Ibu</th>
                                        <th scope="col">Orang Tua yang Almarhum</th>
                                        <th scope="col">Penghasilan</th>
                                        <!-- <th scope="col">Surat Pernyataan</th> -->
                                        <th scope="col">Status</th>
                                        <th scope="col">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach($pengajuans as $pengajuan)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $pengajuan->nama_siswa }}</td>
                                        <td>{{ $pengajuan->kelas }}</td>
                                        <td>{{ $pengajuan->jenis_kelamin }}</td>
                                        <td> {{ $pengajuan->nama_ayah }}</td>
                                        <td> {{ $pengajuan->nama_ibu }}</td>
                                        <td> {{ $pengajuan->orang_tua_tiada }}</td>
                                        <td> {{ $pengajuan->penghasilan }}</td>
                                        <!-- <td> {{ $pengajuan->surat_pernyataan }}</td> -->
                                        <td>
                                            @if($pengajuan->nama_siswa == null || $pengajuan->kelas == null ||
                                            $pengajuan->jenis_kelamin == null || $pengajuan->nama_ayah == null ||
                                            $pengajuan->nama_ibu == null || $pengajuan->orang_tua_tiada == null ||
                                            $pengajuan->penghasilan == null || $pengajuan->surat_pernyataan == null)
                                            <span class="badge bg-danger">Tidak Lulus Seleksi</span>
                                            @else
                                            @if($pengajuan->penghasilan <= 2000000) <span class="badge bg-warning">Lulus
                                                Seleksi Penghasilan </span> @else
                                                <span class="badge bg-danger">Tidak Lulus Seleksi</span> @endif @endif
                                                @if($pengajuan->status != 0) <span class="badge bg-success"> Berhak
                                                    mendapatkan donasi</span> @endif
                                        </td>

                                        <td> <a class="btn btn-info btn-sm"
                                                href="{{ route('pengajuan.show', $pengajuan->id) }}">Lihat Detail</a>
                                        </td>
                                    </tr>
                                    @php $no++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection