@extends('template.ui')
@section('title', 'Detail peminjaman')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item"><a href="">Home</a></li>
   <li class="breadcrumb-item active"><a href="{{ route('peminjam.data') }}">Data peminjam</a></li>
   <li class="breadcrumb-item active">Detail peminjaman</li>
</ol>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-12">
         <div class="invoice p-3 mb-3">
            <div class="row">
               <div class="col-12">
                  <h4><i class="fa fa-info-circle"></i>&nbsp;Detail Peminjaman</h4>
               </div>
            </div>
            <div class="row invoice-info">
               <div class="col-3 invoice-col">
                  <address>
                     <p>Nim : {{ $peminjam->nim }}</p>
                     <p>Nama : {{ $peminjam->name }}</p>
                     <p>Jurusan : {{ $peminjam->majors }}</p>
                     <p>Address : {{ $peminjam->address }}</p>
                  </address>
               </div>
               <div class="col-3 invoice-col">
                  <address>
                     <p>Tanggal : {{ $peminjam->date }}</p>
                     <p>Jam : {{ $peminjam->time }}</p>
                  </address>
               </div>
            </div>
            {{-- Row table --}}
            <div class="row">
               <div class="col-12 table-responsive">
                  <table id="dataTable" class="table table-stripped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Lemari</th>
                           <th>Rak</th>
                           <th>Nama alat</th>
                           <th>Spesifikasi</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($peminjam->toolArragements as $tool)
                        <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td>{{ $tool->table }}</td>
                           <td>{{ $tool->rak }}</td>
                           <td>{{ $tool->tool->toolName }}</td>
                           <td>{{ $tool->tool->specification }}</td>
                        @endforeach
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>

            <div class="row no-print">
               @if($peminjam->status == 1)

                  <form action="{{ route('pengembalian.alat') }}" method="post">
                  @csrf
                  <input type="hidden" value="{{ $peminjam->id }}" name="id">
                     @foreach($peminjam->details as $detail)
                        <input type="hidden" name="jumlahPinjam[]" value="{{ $detail->jumlah }}">
                     @endforeach

                     @foreach($peminjam->toolArragements as $tool)
                        <input type="hidden" name="idToolArragement[]" value="{{ $tool->id }}">

                        <input type="hidden" name="jumlahTerakhir[]" value="{{ $tool->outTool }}">
                     @endforeach
                     <button class="btn btn-info btn-flat">
                        <i class="fa fa-arrow-left"></i> Kembalikan
                     </button>
                  </form>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@push('styles')
   <!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

<!--- Sweet alert -->
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme/bootstrap-4.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<!-- Sweet alert -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush