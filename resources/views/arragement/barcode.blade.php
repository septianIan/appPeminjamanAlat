@extends('template.ui')
@section('title', 'Barcode tool')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item"><a href="/home">Home</a></li>
   <li class="breadcrumb-item active">Barcode tool</li>
</ol>
@endsection

@section('content')
<div class="container">
   <form>
   <div class="row">
      <div class="col-sm-3">
         <button class="btn btn-flat btn-info mb-2 cetak">Cetak</button>
         <div class="form-group row">
            <label class="col-sm-5 col-form-label">Pilih Semua</label>
            <div class="col-sm-7">
               <input type="checkbox" class="form-control" onchange="checkAll(this)" name="chk[]">
            </div>
         </div>
      </div>
   </div>
   <div class="row"> 
      @foreach($tools as $tool)
      <div class="col-md-3">
         <div class="card card-outline card-primary">
            <div class="card-header">
               <h3 class="card-title">{{ $tool->tool->toolName }}</h3>
            </div>
            <div class="card-body align-center" id="checkboxes">
               <center>
                  <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($tool->barcode, 'C128') }}" width="200px" alt="barcode">
                  <p>{{ $tool->barcode }}</p>
                  <input type="checkbox" name="selectBarcode[]" value="{{ $tool->id }}" class="form-control" id="">
               </center>
            </div>
         </div>
      </div>
      @endforeach
   </div>
   </form>
</div>
@endsection
@push('scripts')
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

   <script type="text/javascript">
   function checkAll(ele) {
      var checkboxes = document.getElementsByTagName('input');
      if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == 'checkbox' ) {
                  checkboxes[i].checked = true;
            }
         }
      } else {
         for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == 'checkbox') {
                  checkboxes[i].checked = false;
            }
         }
      }
   }

   $('.cetak').on('click', function(){
      alert('Fitur ini dalam pengembangan');
   })
</script>
@endpush
