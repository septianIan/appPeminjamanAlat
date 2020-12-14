<?php

namespace App\Http\Controllers\Peminjaman;

use App\Borrowing;
use App\DetailBorrowing;
use App\Http\Controllers\Controller;
use App\Tool;
use App\ToolArragement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('peminjaman.index');
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
        $toolArragements = ToolArragement::find($request->idToolArragement);
        $borrowing = Borrowing::create(\array_merge($request->only('nim','name', 'majors', 'address', 'date'), [
            'time' => Carbon::now()->format('H:i')
        ]));

        if (count($request->idToolArragement)) {
            foreach($request->idToolArragement as $tool => $v){
                $data = [
                    'borrowing_id' => $borrowing->id,
                    'jumlah' => $request->jumlahPinjam[$tool],
                ];
                DetailBorrowing::create($data);
            }
        }

        for ($i=0; $i < \count($request->idToolArragement) ; $i++) { \
            DB::table('tool_arragements')->where('id', $request->idToolArragement[$i])
            ->update([
                'outTool' => $request->jumlahPinjam[$i]
            ]);
        }

        $borrowing->toolArragements()->attach($toolArragements);
        \session()->flash('message', 'Data berhasil disimpan');
        return \redirect(\route('peminjaman.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $peminjam = Borrowing::find($id);
        $peminjam->details()->delete();
        $peminjam->toolArragements()->detach();
        $peminjam->delete();

        return \response()->json(true);
    }

    public function dataTable()
    {
        $toolArragement = ToolArragement::with('tool')->latest()->get();
        return datatables()->of($toolArragement)
            ->editColumn('select_tool',static function($toolArragement){
                $checkBox = '<input type="checkbox" name="alat[]" id="'.$toolArragement->id.'" value="'.$toolArragement->id.'" class="form-control">';
                return $checkBox;
            })
            ->addIndexColumn()
            ->rawColumns(['select_tool'])
            ->toJson();
    }

    public function cariNim(Request $request)
    {
        $nim = DB::table('students')->where('nim', $request->nim)->first();
        if (!empty($nim)) {
            $success = true;
            $message = 'Nim sudah terdaftar';
            $data = $nim;
        } else {
            $success = \false;
            $message = 'Nim belum terdaftar';
            $data = '';
        }
        return \response()->json([
            'success' => $success,
            'message' => $message,
            'maha' => $data,
        ]);
    }

    public function pinjamAlat(Request $request)
    {
        if ($request->alat == '') {
            return \redirect()->back()->with('message', 'Alat belum di pilih');
        }
        $selectTools = ToolArragement::find($request->alat);
        return view('peminjaman.create', \compact('selectTools'));
    }

    public function dataPeminjam()
    {
        $peminjam = Borrowing::where('status', 1)->with('details')->latest()->get();
        return \view('peminjaman.dataPeminjam', \compact('peminjam'));
    }

    public function peminjamEdit($id)
    {
        $peminjam = Borrowing::findOrFail($id);
        return \view('peminjaman.editPeminjam', \compact('peminjam'));
    }

    public function detailPeminjam($id)
    {
        $peminjam = Borrowing::findOrFail($id);
        return \view('peminjaman.detailPeminjam', \compact('peminjam'));
    }

    public function pengembalianTunggal(Request $request, $id)
    {
        $tool = ToolArragement::findOrFail($id);
        $result = $tool->outTool - \implode($request->jumlahPinjam);
        if($result <= 0){
            $tool->borrowing()->detach();
            $tool->update([
                'outTool' => 0
            ]);
        } else {
            $tool->update([
                'outTool' => $result
            ]);
        }

        return \redirect()->back();
    }

    public function deleteAlat($id)
    {
        DB::table('tool_borrowing')->where('tool_arragement_id', $id)
        ->delete();

        return \redirect()->back();
    }

    public function pengembalian($id)
    {
        $peminjam = Borrowing::find($id);
        $peminjam->update(['status' => '0']);
        $peminjam->toolArragements()->update(['outTool' => 0]);

        return \response()->json(true);
    }

    public function riwayat()
    {
        $peminjam = Borrowing::where('status', 0)->orderBy('name')->get();
        return view('riwayat.index', \compact('peminjam'));
    }
}