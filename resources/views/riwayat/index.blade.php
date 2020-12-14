@extends('template.ui')
@section('title', 'Data riwayat peminjam')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item"><a href="/home">Home</a></li>
   <li class="breadcrumb-item active">Data riwayat peminjam</li>
</ol>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="card card-outline card-success">
            <div class="card-header">
               <h3 class="card-title">Data riwayat peminjam</h3>
            </div>
            <div class="card-body">
               <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Nim</th>
                        <th>Nama mahasiswa</th>
                        <th>Jurusan</th>
                        <th>Alamat</th>
                        <th>Nama alat</th>
                        <th>Jumlah</th>
                        <th>Waktu pinjam</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($peminjam as $v)
                        <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td>{{ $v->nim }}</td>
                           <td>{{ $v->name }}</td>
                           <td>{{ $v->majors }}</td>
                           <td>{{ $v->address }}</td>
                           <td>
                              <ul>
                                 @foreach($v->toolArragements as $tool)
                                    <li>{{ $tool->tool->toolName }}</li>
                                 @endforeach
                              </ul>
                           </td>
                           <td>
                              <ul>
                                 @foreach($v->details as $detail)
                                    <li>{{ $detail->jumlah }}</li>
                                 @endforeach
                              </ul>
                           </td>
                           <td>{{ $v->date }} | {{ $v->time }}</td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
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
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<!-- Sweet alert -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
   $("#dataTable").DataTable({
      "responsive": true,
      "autoWidth": false,
   });
   </script>
@endpush