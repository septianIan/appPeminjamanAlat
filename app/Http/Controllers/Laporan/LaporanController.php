<?php

namespace App\Http\Controllers\Laporan;

use App\Borrowing;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LaporanController extends Controller
{
    public function index()
    {
        return \view('laporan.index');
    }

    public function laporanBetween(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $dari = Carbon::parse($from)->format('d-m-Y');
        $sampai = Carbon::parse($to)->format('d-m-Y');

        $peminjam = Borrowing::whereBetween('date', [$from, $to])->get();
        return view('laporan.cetak', \compact('peminjam', 'dari', 'sampai'));
    }
}
