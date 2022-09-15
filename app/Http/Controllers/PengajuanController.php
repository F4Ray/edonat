<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajuans = Pengajuan::all();
        return view('pengajuan.see', compact('pengajuans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        return view('pengajuan.show', compact('pengajuan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pengajuan.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'gambar' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|nullable',

        ]);
        if ($request->gambar != null) {
            $name = $request->file('gambar')->getClientOriginalName();
            $image = explode(".", $name);
            $image_extension = array_slice($image, -1, 1);
            $data['image'] = "surat_pernyataan" . "-" . time() . '.' . $image_extension[0];
        }

        $penerima = Pengajuan::findOrFail($id);
        $penerima->nama_siswa = $request->nama_siswa;
        $penerima->kelas = $request->kelas;
        $penerima->jenis_kelamin = $request->jenis_kelamin;
        $penerima->nama_ayah = $request->nama_ayah;
        $penerima->nama_ibu = $request->nama_ibu;
        $penerima->orang_tua_tiada = $request->orang_tua_alm;
        $penerima->penghasilan = $request->penghasilan;
        if ($request->gambar != null) {
            $penerima->surat_pernyataan = $data['image'];
            $request->file('gambar')->storeAs('public/assets/foto_surat_pernyataan', $data['image']);
        }

        $penerima->save();
        return redirect()->route('pengajuan.edit', $id)
            ->with('success', '<strong>Data pengajuan penerima donasi berhasil disimpan !</strong>');
    }

    public function luluskan(Request $request, $id)
    {
        $penerima = Pengajuan::findOrFail($id);
        $penerima->status = 1;

        $penerima->save();
        return redirect()->route('pengajuan.index')
            ->with('success', '<strong>Siswa berhak mendapatkan donasi !</strong>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}