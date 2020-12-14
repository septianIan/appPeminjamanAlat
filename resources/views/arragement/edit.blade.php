@extends('template.ui')
@section('title', 'Edit data tool arragement')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active"><a href="/home">Home</a></li>
   <li class="breadcrumb-item active"><a href="{{ route('tool.index') }}">Data tool arragement</a></li>
   <li class="breadcrumb-item">Edit data tool arragement</li>
</ol>
@endsection
@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Edit tool arragement</h3>
               </div>
               <div class="card-body">
                  <form action="{{ route('arragement.update', $toolArragement->id) }}" method="post">
                  @csrf
                  @method('put')
                     <label for="">Lemari</label>
                     <select name="table" class="form-control @error('table') is-invalid @enderror" id="">
                        <option value="{{ $toolArragement->table }}">{{ $toolArragement->table }}</option>
                        <option value=""></option>
                        @for($i = 1; $i < 11; $i++)
                           <option value="lemari {{ $i }}">Lemari {{ $i }}</option>
                        @endfor
                           <option value="lemari 3(kotak box)">lemari 3(kotak box)</option>
                           <option value="ruang teknisi">ruang teknisi</option>
                     </select>
                     @error('table')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">Rak</label>
                     <input type="number" name="rak" value="{{ $toolArragement->rak }}" class="form-control @error('rak') is-invalid @enderror">
                     @error('rak')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">Alat</label>
                     <select name="tool_id" class="form-control @error('tool_id') is-invalid @enderror" id="">
                        <option value="{{ $toolArragement->tool->id }}">{{ $toolArragement->tool->toolName }}</option>
                        <option value=""></option>
                        @foreach($tools as $tool)
                           <option value="{{ $tool->id }}">{{ $tool->toolName }}</option>
                        @endforeach
                     </select>
                     @error('tool_id')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">Qty</label>
                     <input type="number" name="qty" value="{{ $toolArragement->qty }}" class="form-control @error('qty') is-invalid @enderror">
                     @error('qty')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">Kondisi Baik</label>
                     <input type="number" name="goodCondition" class="form-control @error('goodCondition') is-invalid @enderror" value="{{ $toolArragement->goodCondition }}">
                     @error('goodCondition')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">Kondisi Rusak</label>
                     <input type="number" name="badCondition" class="form-control @error('badCondition') is-invalid @enderror" value="{{ $toolArragement->badCondition }}">
                     @error('badCondition')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror


                     <label for="">Barcode</label>
                     <input type="number" name="barcode" value="{{ $toolArragement->barcode }}" class="form-control @error('barcode') is-invalid @enderror">
                     @error('barcode')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <button class="btn btn-primary btn-flat mt-3">
                        Submit
                     </button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection