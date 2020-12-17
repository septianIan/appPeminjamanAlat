@extends('template.ui')
@section('title', 'Data peminjam')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item"><a href="/home">Home</a></li>
   <li class="breadcrumb-item active">Data peminjam</li>
</ol>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="card card-success">
            <div class="card-header">
               <h3 class="card-title">Data peminjam</h3>
            </div>
            <div class="card-body">
               @if(session('message'))
                  <div  div id="notif" class="alert alert-success">{{ session('message') }}</div>
               @endif
               <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Nim</th>
                        <th>Nama mahasiswa</th>
                        <th>Nama alat</th>
                        <th>Waktu pinjam</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($peminjam as $v)
                        <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td>{{ $v->nim }}</td>
                           <td>{{ $v->name }}</td>
                           <td>
                              <ul>
                                 @foreach($v->toolArragements as $tool)
                                    @foreach($v->details as $detail)
                                       <li>{{ $tool->tool->toolName }} | jumlah {{ $detail->jumlah }}</li>
                                    @endforeach
                                 @endforeach
                              </ul>
                           </td>
                           <td>{{ $v->date }} | {{ $v->time }}</td>
                           <td>
                              <div class="btn-group">
                                 <a href="{{ route('peminjam.edit', $v->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                 <button class="btn btn-danger" data-id="{{ $v->id }}" id="delete"><i class="fa fa-trash"></i></button>
                                 <a href="{{ route('peminjam.detail',$v->id) }}" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                              </div>
                           </td>
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
               url: "/peminjaman/"+id,
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
   });
   </script>
@endpush