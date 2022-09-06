<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donaturs = Donatur::where('nama', '!=', 'Admin')->get();
        return view('donatur.index', compact('donaturs'));
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
        $donatur = Donatur::findOrFail($id);

        return view('donatur.show', compact("donatur"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $donatur = Donatur::findOrFail($id);

        return view('donatur.edit', compact("donatur"));
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

        if (Auth::user()->role->name == 'donatur') {
            $this->validate(
                $request,
                [
                    'old_password' => 'required',
                    'password' => 'different:old_password|min:8|nullable',
                ],
                [
                    'old_password.required' => 'Password lama harus diisi'
                ]
            );
            if (Hash::check($request->old_password, Auth::user()->password)) {
                $donatur = Donatur::findOrFail($id);
                $user = User::where('id_role', 2)->where('id_profile', $id)->first();
                if ($request->password != null) {
                    $user->fill([
                        'password' => Hash::make($request->password)
                    ])->save();
                }
                $donatur->nama = $request->nama;
                $donatur->telepon = $request->telepon;
                $donatur->jenis_kelamin = $request->jenis_kelamin;
                $donatur->alamat = $request->alamat;

                $donatur->save();
                $request->session()->flash('success', 'Data berhasil diubah');
                return redirect()->route('donatur.show', $id);
            } else {
                $request->session()->flash('error', 'Password lama salah');
                return redirect()->route('donatur.edit', $id);
            }
        } else {
            $user = User::where('id_role', 2)->where('id_profile', $id)->first();
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();
            $request->session()->flash('success', 'Password berhasil diubah');
            return redirect()->route('donatur.show', $id);
        }
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