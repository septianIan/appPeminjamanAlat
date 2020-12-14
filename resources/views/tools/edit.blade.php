@extends('template.ui')
@section('title', 'Edit data tool')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active"><a href="/home">Home</a></li>
   <li class="breadcrumb-item active"><a href="{{ route('student.index') }}">Data tool</a></li>
   <li class="breadcrumb-item">Edit data tool</li>
</ol>
@endsection
@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Edit student</h3>
               </div>
               <div class="card-body">
                  <form action="{{ route('tool.update', $tool->id) }}" method="post">
                  @csrf
                  @method('put')
                     <label for="">Tool Name</label>
                     <input type="text" name="toolName" value="{{ $tool->toolName }}" class="form-control @error('toolName') is-invalid @enderror" placeholder="Tool Name ...">
                     @error('toolName')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">Specification</label>
                     <input type="text" name="specification" value="{{ $tool->specification }}" class="form-control @error('specification') is-invalid @enderror" placeholder="specification ...">
                     @error('specification')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">Fund</label>
                     <input type="text" name="fund" value="{{ $tool->fund }}" class="form-control @error('fund') is-invalid @enderror" placeholder="Fund ...">
                     @error('fund')
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