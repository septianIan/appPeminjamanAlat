<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cetak laporan peminjam mahasiswa</title>
   @include('template.components.style')
</head>
<body>
   <div class="wrapper">
      <section class="invoice">
         <div class="row">
         <div class="col-12">
         <h2 class="page-header">
            <i class="fas fa-globe"></i> Teknik Mekatronika Poltekom.
            <small class="float-right">Tanggal: {{ date('d-m-Y') }}</small>
         </h2>
         </div>
         <!-- /.col -->
      </div>
         <div class="row">
            <div class="col-12">
               <div class="invoice p-3 mb-3">
                  <div class="row">
                     <div class="col-12">
                        Laporan Peminjaman {{ $dari }} - {{ $sampai }}
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12 table-responsive">
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
                                    <td>{{ $v->getFormatTgl() }} | {{ $v->time }}</td>
                                 </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
   @include('template.components.script')
</body>
<script>
   window.addEventListener("load", window.print());
</script>
</html>