@extends('layouts.admin')
@section('title')
| Ubah Kategori
@endsection

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-tasks"></i> Kategori </h1>
      {{-- <p>Start a beautiful journey here</p> --}}
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('home') }}"> <i class="fa fa-home fa-lg"></i></li></a>
      <li class="breadcrumb-item"><a href="{{ url('Kategori')}}"> Kategori </a></li>
      <li class="breadcrumb-item"> Ubah Kategori </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <h5>Ubah Kategori</h5>
        <hr>
        <form class="forms-sample" action="{{ url('Kategori/'.$category->id)}}" method="post" >
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="put">
          <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <div class="row">
              <label for="name" class="col-md-2">Kode <span class="text-danger">*</span></label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="code" required="" placeholder="Kode" value="{{ $category->code }}" />
                @if ($errors->has('code'))
                <span class="help-block">
                  <strong>{{ $errors->first('code') }}</strong>
                </span>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="row">
              <label for="email" class="col-md-2">Kategori <span class="text-danger">*</span></label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="name" required="" placeholder="Kategori" value="{{ $category->name }}" />
                @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>
            </div>
          </div>
          <div class="ibox-footer text-right">
            <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('/Kategori') }}" class="btn btn-danger">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
@endsection
