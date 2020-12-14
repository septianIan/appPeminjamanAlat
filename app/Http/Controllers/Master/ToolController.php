<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Student;
use App\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tools.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tools.create');
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
            'toolName' => 'required',
            'specification' => 'required',
            'fund' => 'required',
        ]);

        Tool::firstOrCreate(['toolName' => $request->toolName], $request->all());
        \session()->flash('message' ,'Data berhasil ditambahakan');
        return \redirect(\route('tool.index'));
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
    public function edit(Tool $tool)
    {
        return \view('tools.edit', [
            'tool' => $tool
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tool $tool)
    {
        $this->validate($request, [
            'toolName' => 'required',
            'specification' => 'required',
            'fund' => 'required',
        ]);

        $tool->update($request->all());
        \session()->flash('message', 'Data berhasil diubah');
        return \redirect()->route('tool.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tool $tool)
    {
        $tool->arragement()->delete();
        $tool->delete();
        return \response()->json(true);
    }

    public function dataTable()
    {
        $tools = Tool::orderBy('toolName')->get();
        return datatables()->of($tools)
            ->addColumn('action', 'template.components.action.DT-action-master')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
