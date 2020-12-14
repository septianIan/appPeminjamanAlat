@extends('template.ui')
@section('title', 'Create data student')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active"><a href="/home">Home</a></li>
   <li class="breadcrumb-item active"><a href="{{ route('student.index') }}">Data student</a></li>
   <li class="breadcrumb-item">Create data student</li>
</ol>
@endsection
@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Create student</h3>
               </div>
               <div class="card-body">
                  <form action="{{ route('student.store') }}" method="post">
                  @csrf
                     <label for="">Nim</label>
                     <input type="number" name="nim" value="{{ old('nim') }}" class="form-control @error('nim') is-invalid @enderror" placeholder="Nim ..." autocomplete="off">
                     @error('nim')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                     <label for="">Nama</label>
                     <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Name ...">
                     @error('name')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">Majors</label>
                     <input type="text" name="majors" value="{{ old('majors') }}" class="form-control @error('majors') is-invalid @enderror" placeholder="Majors ...">
                     @error('majors')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">Class</label>
                     <input type="text" name="class" value="{{ old('class') }}" class="form-control @error('class') is-invalid @enderror" placeholder="Class ...">
                     @error('class')
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