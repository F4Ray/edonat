@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="row">
                @if ($message = Session::get('error'))
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {!! $message !!}
                    </div>
                </div>
                @endif
            </div>
            <div class="row">
                @if(count($errors) > 0 )
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">

                        {{$errors->first()}}
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
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif

                            @if(Auth::user()->role->name == 'donatur')
                            Halo {{ Auth::user()->donatur->nama }}, Silahkan isi data dengan sebenar-benarnya.
                            @else

                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <form action="{{route('donatur.update', $donatur->id)}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @if(Auth::user()->role->name == 'donatur')
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Donatur</label>
                                    <input type="text" class="form-control" name="nama" aria-describedby="emailHelp"
                                        value="{{$donatur->nama}}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Alamat</label>
                                    <textarea class="form-control" name="alamat">{{$donatur->alamat}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin">
                                        <option value="" @if($donatur->jenis_kelamin == null) selected
                                            @endif hidden> Pilih Jenis Kelamin</option>
                                        <option value="laki-laki" @if($donatur->jenis_kelamin == 'laki-laki') selected
                                            @endif>Laki-Laki</option>
                                        <option value="perempuan" @if($donatur->jenis_kelamin == 'perempuan') selected
                                            @endif>Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" name="telepon" aria-describedby="emailHelp"
                                        value="{{$donatur->telepon}}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password"
                                        aria-describedby="emailHelp" value="">
                                    <small>Kosongkan untuk tidak mengubah password.</small>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Password Lama</label>
                                    <input type="password" class="form-control" name="old_password"
                                        aria-describedby="emailHelp" value="">
                                    <small>Masukkan password untuk mengubah data.</small>
                                </div>
                                @else
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password"
                                        aria-describedby="emailHelp" value="">
                                </div>
                                @endif
                                <a class="btn btn-warning " href="{{url()->previous()}}" role="button">Kembali</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('internalJS')
<script>
function preview() {
    frame.src = URL.createObjectURL(event.target.files[0]);
}

function clearImage() {
    document.getElementById('formFile').value = null;
    frame.src = "";
}
</script>
@endsection