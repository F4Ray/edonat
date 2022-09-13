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
                <div class="card-header">{{ __('Form Pengajuan Penerima Donasi') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif

                            @if(Auth::user()->role->name == 'penerima donasi')
                            Halo {{ Auth::user()->penerima->nama_siswa }}, Silahkan mengisi form pengajuan penerima
                            donasi dibawah ini.
                            @else
                            Halo Admin, disini Anda dapat menambah data program donasi
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <form action="{{route('pengajuan.update', Auth::user()->penerima->id )}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control" name="nama_siswa"
                                        value="{{Auth::user()->penerima->nama_siswa}}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Kelas</label>
                                    <input type="text" class="form-control" name="kelas"
                                        value="{{Auth::user()->penerima->kelas}}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin">
                                        <option value="" hidden> Pilih Jenis Kelamin</option>
                                        <option value="laki-laki" @if(Auth::user()->penerima->jenis_kelamin ==
                                            'laki-laki') selected
                                            @endif>Laki-Laki</option>
                                        <option value="perempuan" @if(Auth::user()->penerima->jenis_kelamin ==
                                            'perempuan') selected
                                            @endif>Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Nama Ayah</label>
                                    <input type="text" class="form-control" name="nama_ayah"
                                        value="{{Auth::user()->penerima->nama_ayah}}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Nama Ibu</label>
                                    <input type="text" class="form-control" name="nama_ibu"
                                        value="{{Auth::user()->penerima->nama_ibu}}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Orang Tua yang
                                        Almarhum </label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="orang_tua_alm" type="checkbox"
                                                id="ayah" value="ayah" @if(Auth::user()->penerima->orang_tua_tiada ==
                                            'ayah') checked @endif>
                                            <label class="form-check-label" for="ayah">Ayah</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="orang_tua_alm" type="checkbox"
                                                id="ibu" value="ibu" @if(Auth::user()->penerima->orang_tua_tiada ==
                                            'ibu') checked @endif>
                                            <label class="form-check-label" for="ibu">Ibu</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Penghasilan</label>
                                    <input type="text" class="form-control" name="penghasilan"
                                        value="{{Auth::user()->penerima->penghasilan}}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Surat Pernyataan</label>
                                    <input class="form-control" type="file" name="gambar" id="formFile"
                                        onchange="preview()">
                                    <small>Kosongkan jika tidak ingin mengubah data</small>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <img id="frame"
                                            src="{{asset('storage/assets/foto_surat_pernyataan/'.Auth::user()->penerima->surat_pernyataan)}}"
                                            class="img-fluid" />
                                    </div>
                                </div>
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