<?php

namespace App\Http\Controllers;

use App\Borrowing;
use App\Student;
use App\Tool;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        return view('home', [
            'students' => Student::get(),
            'tools' => Tool::get(),
            'peminjam' => Borrowing::where('status' , 1)->get(),
            'riwayatPeminjaman' => Borrowing::where('status' , 0)->get()
        ]);
    }
}
