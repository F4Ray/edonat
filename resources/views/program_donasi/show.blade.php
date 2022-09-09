@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Program Donasi') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Donasi untuk {{ $donasi->nama }}</h1>
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <img id="frame" src="{{  asset('storage/assets/foto_donasi/'.$donasi->gambar) }}" class="img-fluid mx-auto d-block" style="max-height: 300px;" />
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection