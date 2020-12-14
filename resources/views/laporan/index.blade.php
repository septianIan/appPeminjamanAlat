@extends('template.ui')
@section('title', 'Laporan peminjaman')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item"><a href="/home">Home</a></li>
   <li class="breadcrumb-item active">Laporan peminjaman</li>
</ol>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-4">
         <div class="card card-outline card-info">
            <div class="card-header">
               <h3 class="card-title">Laporan peminjaman</h3>
            </div>
            <div class="card-body">
               <form action="{{ route('laporan.between') }}" method="post">
               @csrf
                  <label for="">Dari Tanggal</label>
                  <input type="date" name="from" class="form-control" id="">
                  <label for="">Sampai Tanggal</label>
                  <input type="date" name="to" class="form-control" id="">
                  <button class="btn btn-info btn-flat mt-2" formtarget="_blank">Cek</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection