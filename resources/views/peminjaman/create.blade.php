@extends('template.ui')
@section('title', 'Detail alat')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item"><a href="/home">Home</a></li>
   <li class="breadcrumb-item active"><a href="{{ route('peminjaman.index') }}">Data alat</a></li>
</ol>
@endsection

@section('content')
<form action="{{ route('peminjaman.store') }}" method="post" id="myForm">
@csrf
<div class="container">
   <div class="row">
      <div class="col-md-4">
         <div class="card card-success">
            <div class="card-header">
               <h3 class="card-title">Form Peminjaman mahasiswa</h3>
               <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
               </div>
            </div>
            <div class="card-body">
            @if(session('message'))
               <div id="notif" class="alert alert-info">{{ session('message') }}</div>
            @endif
            <div id="notification" style="font-weight:bold;"></div>
               <label for="">Nim</label>
               <input type="number" name="nim" id="nim" value="{{ old('nim') }}" class="form-control @error('nim') is-invalid @enderror" autofocus autocomplete="off">
               @error('nim')
               <div class="invalid-feedback">
                  {{ $message }}
               </div>
               @enderror

               <label for="">Nama</label>
               <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control @error('name') is-invalid @enderror">
               @error('name')
               <div class="invalid-feedback">
                  {{ $message }}
               </div>
               @enderror

               <label for="">Jurusan</label>
               <input type="text" name="majors" value="{{ old('majors') }}" id="majors" class="form-control @error('majors') is-invalid @enderror" required>
               @error('majors')
               <div class="invalid-feedback">
                  {{ $message }}
               </div>
               @enderror

               <label for="">Alamat</label>
               <textarea name="address" id="address" cols="3" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
               @error('address')
               <div class="invalid-feedback">
                  {{ $message }}
               </div>
               @enderror

               <label for="">Tanggal pinjam</label>
               <input type="date" name="date" id="date" value="{{ old('date') }}" class="form-control @error('date') is-invalid @enderror" required>
               @error('date')
               <div class="invalid-feedback">
                  {{ $message }}
               </div>
               @enderror
            </div>
            <div class="card-footer">
               <button type="submit" class="btn btn-block btn-success btn-flat">Simpan</button>
            </div>
         </div>
      </div>

      <div class="col-md-8">
         <div class="card card-success card-tabs">
            <div class="card-header">
               Detail alat
            </div>
            <div class="card-body">
               <table class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>Nama alat</th>
                        <th>Spek</th>
                        <th>Jumlah yang dipinjam</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($selectTools as $tool)
                        <tr>
                           <td>{{ $tool->tool->toolName }}</td>
                           <td>{{ $tool->tool->specification }}</td>
                           <td width="180px">
                              <input type="hidden" name="idToolArragement[]" value="{{ $tool->id }}">

                              <input type="text" name="jumlahPinjam[]" id="" class="form-control" required>
                              <font style="font-size:12px;">Kondisi alat yang dapat dipakai <b>{{ $tool->goodCondition - $tool->outTool }}</b></font>
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
</form>
@endsection

@push('styles')
<!--- Sweet alert -->
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme/bootstrap-4.min.css') }}">
@endpush

@push('scripts')

<!-- Sweet alert -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
   $(document).ready(function(){

      $("#nim").change(function(){
         var nim = $(this).val();
         $.ajax({
            type: "POST",
            url: "{{ route('cari.nim') }}",
            data: {
               "_token": "{{ csrf_token() }}",
               'nim':nim
            },
            beforeSend: function(){
               $("#nim").css("background","#FFF url({{ asset('assets/gif/loading3.gif') }}) no-repeat 200px");
            },
            dataType: 'json',
            success : function(data) {
               if(data.success === true){
                  $('#name').val(data.maha.name);
                  $('#majors').val(data.maha.majors);
                  $('#address').val(data.maha.address)
                  $('#notification').addClass('alert alert-success');
                  $('#notification').html(data.message);
                  $('#nim').css("background","#FFF");
               } else if(data.success === false) {
                  $('#notification').addClass('alert alert-success');
                  $('#notification').html(data.message);
                  getResetNim();
                  $('#nim').css("background","#FFF");
               }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
         });
      });

      function getResetNim()
      {
         $('#nim').val('');
         $('#name').val('');
         $('#majors').val('');
         $('#address').val('');
      }

      //notif
      $('#notif').fadeTo(2000, 500).slideUp(500, function(){
            $('#notif').slideUp(500);
      })

   });
</script>
@endpush