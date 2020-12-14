<?php

namespace App\Http\Controllers\Arragement;

use App\Http\Controllers\Controller;
use App\Tool;
use App\ToolArragement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ToolArragementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('arragement.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('arragement.create', [
            'tools' => Tool::orderBy('toolName')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'table' => 'required',
            'tool_id' => 'required',
            'qty' => 'required',
            'barcode' => 'required|numeric'
        ]);

        ToolArragement::firstOrCreate(['tool_id' => $request->tool_id], $request->except('_token'));
        \session()->flash('message', 'Data berhasil disimpan');
        
        return \redirect()->route('arragement.index');
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
        return view('arragement.edit', [
            'toolArragement' => ToolArragement::find($id),
            'tools' => Tool::get()
        ]);
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
        $this->validate($request, [
            'table' => 'required',
            'tool_id' => 'required',
            'qty' => 'required',
            'barcode' => 'required|numeric'
        ]);
        $toolArragement = ToolArragement::findOrFail($id);
        $toolArragement->update($request->except('_token'));
        \session()->flash('message', 'Data berhasil diubah');
        return \redirect()->route('arragement.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $toolArragement = ToolArragement::findOrFail($id);
        $toolArragement->delete();
        return \response()->json(true);
    }

    public function dataTable()
    {
        $toolArragement = ToolArragement::with('tool')->latest()->get();
        return datatables()->of($toolArragement)
            ->addColumn('action', 'template.components.action.DT-action-toolArragement')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function barcode()
    {
        return view('arragement.barcode',[
            'tools' => ToolArragement::get()
        ]);
    }

    public function cetakBarcode(Request $request)
    {
        // \dd($request->all());
        $tools = ToolArragement::findOrFail($request->selectBarcode);
        \dd($tools);
    }
}
