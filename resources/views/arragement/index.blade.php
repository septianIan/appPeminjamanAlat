@extends('template.ui')
@section('title', 'Data tool arragement')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item"><a href="/home">Home</a></li>
   <li class="breadcrumb-item active">Data tool arragement</li>
</ol>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="card card-primary">
            <div class="card-header">
               <h3 class="card-title">Data tool arragement</h3>
            </div>
            <div class="card-body">
               <a href="{{ route('arragement.create') }}" class="btn btn-primary btn-flat mb-1">Create Data</a>
               @if(session('message'))
                  <div  div id="notif" class="alert alert-info">{{ session('message') }}</div>
               @endif
               <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Lemari</th>
                        <th>Rak</th>
                        <th>Nama alat</th>
                        <th>Spesifikasi</th>
                        <th>Dana</th>
                        <th>Kondisi baik</th>
                        <th>Kondisi rusak</th>
                        <th>alat keluar</th>
                        <th>Barcode</th>
                        <th>Action</th>
                     </tr>
                  </thead>
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

   $(function() {
   //dataTable
   $('#dataTable').DataTable({
      "processing" : true,
      "serverSide" : true,
      "responsive" : true,
      "autoWidth" : true,
      ajax: '{{ route('data.toolArragement') }}',
      columns : [
         {data: 'DT_RowIndex'},
         {data: 'table'},
         {data: 'rak'},
         {data: 'tool.toolName'},
         {data: 'tool.specification'},
         {data: 'tool.fund'},
         {data: 'goodCondition'},
         {data: 'badCondition'},
         {data: 'outTool'},
         {data: 'barcode'},
         {data: 'action'},
      ]
   });
      //sweet alert
   $('#dataTable').on('click', 'button#delete', function(e){
      e.preventDefault();
      var id = $(this).data('id'); //ambil dari data-id

      Swal.fire({
         title: 'Yakin menghapus data?',
         text: "",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!',
         cancelButtonText: 'Cancel!',
      }).then((result) => {
         if (result.value) {
            $.ajax({
               type: "DELETE",
               url: "arragement/"+id,
               data: {
                  "id": id,
                  "_token": "{{ csrf_token() }}"
               },

               //setelah berhasil di hapus
               success: function(data){
                  Swal.fire(
                  'Hapus data!',
                  'Data telah di hapus.',
                  'success'
                  )
                  //setelah alert succes, maka reload halaman
                  location.reload(true);
               }
            })
         }
      })
   });
      //notif
   $('#notif').fadeTo(2000, 500).slideUp(500, function(){
            $('#notif').slideUp(500);
      })
   });
   </script>
@endpush