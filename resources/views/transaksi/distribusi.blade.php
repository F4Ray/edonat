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
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
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
                                        <td>{{ $transaksinya->penerima->nama_siswa }}</td>
                                        <td>{{ $transaksinya->program->nama }}</td>
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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection