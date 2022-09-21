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
                            @elseif(Auth::user()->role->name == 'penerima donasi')
                            @if(Auth::user()->penerima->status == 0)
                            Halo {{ Auth::user()->penerima->nama_siswa }}, Sayang sekali kamu tidak lulus seleksi
                            penerima donasi.
                            @else
                            Halo {{ Auth::user()->penerima->nama_siswa }}, Saldo kamu adalah Rp.
                            {{Auth::user()->penerima->saldo}}
                            @endif
                            @else
                            Halo Admin, disini Anda dapat mengatur data program donasi
                            @endif
                        </div>
                    </div>
                    @if(Auth::user()->id_role == 1 OR (Auth::user()->id_role == 3 AND Auth::user()->penerima->status !=
                    0))
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        @if(Auth::user()->id_role == 3 AND Auth::user()->penerima->status != 0)
                                        <th>Jenis Transaksi</th>
                                        @endif
                                        <th scope="col">Nama Penerima</th>
                                        <th scope="col">Program Donasi</th>
                                        <th scope="col">Nominal</th>
                                        <th scope="col">Waktu Distribusi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach($transaksi as $transaksinya)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        @if(Auth::user()->id_role == 3 AND Auth::user()->penerima->status != 0)
                                        @if($transaksinya->id_program_donasi == 9999)
                                        <td>Keluar</td>
                                        @else
                                        <td>Masuk</td>
                                        @endif
                                        @endif
                                        <td>{{ $transaksinya->penerima->nama_siswa }}</td>
                                        @if($transaksinya->id_program_donasi != 9999)
                                        <td>{{ $transaksinya->program->nama }}</td>
                                        @else
                                        <td>Transfer SPP</td>
                                        @endif
                                        <td>Rp {{ $transaksinya->nominal }}</td>
                                        <td>{{\Carbon\Carbon::parse($transaksinya->waktu) }} (
                                            {{ \Carbon\Carbon::parse($transaksinya->waktu)->diffForHumans() }})
                                        </td>
                                    </tr>
                                    @php $no++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if(Auth::user()->role->name == 'penerima donasi')
                            <form action="{{route('pengajuan.store')}}" method="post">
                                @csrf
                                @if(Auth::user()->penerima->saldo != 0)
                                <button type="submit" class="btn btn-primary">Transfer Ke Uang Sekolah</button>
                                @else
                                <button type="submit" class="btn btn-primary" disabled>Transfer Ke Uang Sekolah</button>
                                @endif
                            </form>
                            @endif
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection