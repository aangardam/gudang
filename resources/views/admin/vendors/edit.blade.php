@extends('layouts.admin') 
@section('title') | Edit Vendors
@endsection
 
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-user"></i> Vendors </h1>
            {{--
            <p>Start a beautiful journey here</p> --}}
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}"> <i class="fa fa-home fa-lg"></i></li></a>
                <li class="breadcrumb-item"><a href="{{ url('Vendors')}}"> Vendors </a></li>
                <li class="breadcrumb-item"> Edit Vendors </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h5>Edit Vendors</h5>
                <hr>
                <form class="forms-sample" action="{{ url('/Vendors/'.$vendors->id)}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Nama  <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" required="" placeholder="Nama" value="{{ $vendors->name }}" />
                                <input type="hidden" class="form-control" name="active" value="1" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Kategori  <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <select name="category_id" class="form-control" required>
                                    <option value="" selected="" disabled>-Pilih Kategori-</option>
                                    @foreach ($category as $item)
                                        @if ($item->id == $vendors->category_id)
                                            <option value="{{ $item->id }}" selected=""> {{ $item->name }}</option>    
                                        @else
                                            <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                        @endif
                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Email  </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="email" required="" placeholder="Email" value="{{ $vendors->email }}" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">No Telepon </label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="notelp" required="" placeholder="No Telepon " value="{{ $vendors->notelp }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Alamat </label>
                            <div class="col-md-10">
                                <textarea name="address" class="form-control">{{ $vendors->notelp }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="ibox-footer text-right">
                        <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url('/Vendors') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</main>
@endsection