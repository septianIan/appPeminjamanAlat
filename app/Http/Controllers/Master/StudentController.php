<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \view('students.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
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
            'nim' => 'required|numeric',
            'name' => 'required',
            'majors' => 'required',
            'class' => 'required'
        ]);

        Student::firstOrCreate($request->except('_token'));
        session()->flash('message', 'Data berhasil disimpan');
        return \redirect(\route('student.index'));
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
    public function edit(Student $student)
    {
        return \view('students.edit', [
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $this->validate($request, [
            'nim' => 'required|numeric',
            'name' => 'required',
            'majors' => 'required',
            'class' => 'required'
        ]);

        $student->update($request->all());
        session()->flash('message', 'Data berhasil diubah');
        return \redirect(\route('student.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return \response()->json(true);
    }

    public function dataTable()
    {
        $students = Student::orderBy('name')->get();
        return datatables()->of($students)
            ->addColumn('action', 'template.components.action.DT-action-master')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
