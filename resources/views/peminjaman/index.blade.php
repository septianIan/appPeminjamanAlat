@extends('template.ui')
@section('title', 'Data alat')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item"><a href="/home">Home</a></li>
   <li class="breadcrumb-item active">Data alat</li>
</ol>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="card card-success">
            <div class="card-header">
               <h3 class="card-title">Data Mahasiswa</h3>
            </div>
            <div class="card-body">
               @if(session('message'))
                  <div  div id="notif" class="alert alert-success">{{ session('message') }}</div>
               @endif
               <form action="{{ route('checkList.alat') }}" method="post">
               @csrf
               <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Nim</th>
                        <th>Nama</th>
                        <th>Pilih alat</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($students as $student)
                        <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td>{{ $student->nim }}</td>
                           <td>{{ $student->name }}</td>
                           <td>
                              <select name="alat[]" class="form-control multiSelect" id="" multiple>
                                 <option value="">Pilih</option>
                                 <option value=""></option>
                                 @foreach($tools as $tool)
                                    <option value="{{ $tool->id }}">{{ $tool->tool->toolName }} | {{ $tool->barcode }}</option>
                                 @endforeach
                              </select>
                           </td>
                           <td>
                              <input type="hidden" name="student" value="{{ $student->id }}">
                              <button class="btn btn-success btn-flat">
                              Pinjam
                              </button>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
               </form>
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

<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts')
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
   $(function(){
      $('.multiSelect').select2({
            theme: 'bootstrap4'
      })
   })

   $(function() {

      $("#dataTable").DataTable({
         "responsive": true,
         "autoWidth": false,
      });
      //notif
      $('#notif').fadeTo(2000, 500).slideUp(500, function(){
               $('#notif').slideUp(500);
      })
   });
</script>
@endpush