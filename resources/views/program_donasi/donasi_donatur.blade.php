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
                                    <img id="frame" src="{{  asset('storage/assets/foto_donasi/'.$donasi->gambar) }}"
                                        class="img-fluid mx-auto d-block" style="max-height: 300px;" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('program_donasi.store_donasi_donatur', $donasi->id)}}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Nominal</label>
                                            <input type="text" class="form-control" name="nominal">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Donasi</label>
                                            <input type="text" class="form-control" name="tanggal"
                                                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Metode Pembayaran</label>
                                            <select class="form-control" name="metode_pembayaran">
                                                <option value="Rekening Bank">Rekening Bank</option>
                                                <option value="Dana">Dana</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Titip Doa</label>
                                            <textarea class="form-control" name="titip_doa"></textarea>
                                        </div>
                                        <a class="btn btn-warning " href="{{url()->previous()}}"
                                            role="button">Kembali</a>
                                        <button type="submit" class="btn btn-primary">Submit</button>
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