<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use App\Models\Donatur;
use App\Models\Pengajuan;
use App\Models\ProgramDonasi;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProgramDonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->id_role == 1) {
            $programDonasi = ProgramDonasi::all();
        } else {
            $programDonasi = ProgramDonasi::where('is_active', 1)->get();
        }
        // foreach ($programDonasi as $donasi) {
        //     echo $donasi->nama;
        //     // if (in_array(4, $donasi->donatur)) {
        //     //     echo "ada dong";
        //     // }

        //     foreach ($donasi->donatur as $donaturnya) {
        //         var_dump($donaturnya->id);
        //     }
        // }
        // dd($programDonasi);
        return view('program_donasi.index', compact('programDonasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('program_donasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);
        $name = $request->file('gambar')->getClientOriginalName();
        $image = explode(".", $name);
        $image_extension = array_slice($image, -1, 1);
        $data['image'] = "donasi" . "-" . time() . '.' . $image_extension[0];

        $programDonasi = new ProgramDonasi;
        $programDonasi->nama = $request->nama_program;
        $programDonasi->keterangan = $request->keterangan;
        $programDonasi->dana_terkumpul = 0;
        $programDonasi->gambar = $data['image'];
        $request->file('gambar')->storeAs('public/assets/foto_donasi', $data['image']);
        $programDonasi->save();

        return redirect()->route('program_donasi.index')
            ->with('success', '<strong>Data program donasi berhasil disimpan !</strong>');
    }

    public function distribusi(Request $request, $id)
    {
        $donasi = ProgramDonasi::findOrFail($id);
        $donasi->is_active = 0;
        $donasi->save();

        $penerimanya = Pengajuan::where('status', 1)->get();

        $perorang = $donasi->dana_terkumpul / count($penerimanya);
        foreach ($penerimanya as $penerima) {
            $penerima->saldo += $perorang;
            $distri = new Distribution;
            $distri->id_program_donasi = $id;
            $distri->id_penerima = $penerima->id;
            $distri->nominal = $perorang;
            $distri->waktu = Carbon::now();
            $distri->dilakukan_oleh = Auth::user()->id;
            $distri->save();
            $penerima->save();
        }
        return redirect()->route('program_donasi.show', $id)
            ->with('success', '<strong>Donasi berhasil di distribusikan!</strong>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donasi = ProgramDonasi::findOrFail($id);
        $penerimas = Pengajuan::where('status', '1')->get();
        $terima = Distribution::where('id_program_donasi', $id)->get();

        return view('program_donasi.show', compact("donasi", "penerimas", "terima"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function donasi_donatur($id)
    {
        $donasi = ProgramDonasi::findOrFail($id);
        return view('program_donasi.donasi_donatur', compact("donasi"));
    }

    public function store_donasi_donatur(Request $request, $id)
    {

        // var_dump($id);
        // dd($request->all());

        $program_donasi = ProgramDonasi::findOrFail($id);
        $program_donasi->dana_terkumpul += $request->nominal;

        $transaksi = new Transaction;
        $transaksi->id_donatur = Auth::user()->donatur->id;
        $transaksi->id_program_donasi = $id;
        $transaksi->nominal = $request->nominal;
        $transaksi->metode_pembayaran = $request->metode_pembayaran;
        $transaksi->tanggal_donasi = $request->tanggal;
        $transaksi->titip_doa = $request->titip_doa;

        $program_donasi->save();
        $transaksi->save();

        DB::table('program_donasi_donatur')->insert([
            'id_program_donasi' => $id,
            'id_donatur' => Auth::user()->donatur->id
        ]);
        return redirect()->route('program_donasi.index')
            ->with('success', "<strong>Terimakasih telah berdonasi di program $program_donasi->nama </strong>");
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
        //
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