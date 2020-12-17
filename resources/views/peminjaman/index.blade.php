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
               <h3 class="card-title">Data alat</h3>
            </div>
            <div class="card-body">
               @if(session('message'))
                  <div  div id="notif" class="alert alert-success">{{ session('message') }}</div>
               @endif
               <form action="{{ route('checkList.alat') }}" method="get">
               <button type="submit" class="btn btn-success btn-flat mb-2">Pinjam</button>
               <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Check</th>
                        <th>Nama alat</th>
                        <th>Spesifikasi</th>
                        <th>Kondisi baik</th>
                        <th>Kondisi rusak</th>
                        <th>Alat keluar</th>
                        <th>Barcode</th>
                     </tr>
                  </thead>
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

   $(function() {
   //dataTable
   $('#dataTable').DataTable({
      "processing" : true,
      "serverSide" : true,
      "responsive" : true,
      "autoWidth" : true,
      ajax: '{{ route('data.tool') }}',
      columns : [
         {data: 'DT_RowIndex'},
         {data: 'select_tool', name: 'select_tool', orderable: false, searchable: false}, 
         {data: 'tool.toolName'},
         {data: 'tool.specification'},
         {data: 'goodCondition'},
         {data: 'badCondition'},
         {data: 'outTool'},
         {data: 'barcode'},
      ]
   });


      //notif
   $('#notif').fadeTo(2000, 500).slideUp(500, function(){
            $('#notif').slideUp(500);
      })
   });
   </script>
@endpush