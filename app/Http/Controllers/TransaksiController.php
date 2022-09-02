<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        if (Auth::user()->role->name == 'donatur') {
            $transaksi = Transaction::where('id_donatur', Auth::user()->donatur->id)->get();
        } else {
            $transaksi = Transaction::all();
        }
        return view('transaksi.index', compact('transaksi'));
    }
}