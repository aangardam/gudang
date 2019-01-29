@extends('layouts.admin') 
@section('title') | Edit Toko
@endsection
 
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-home"></i> Toko </h1>
            {{--
            <p>Start a beautiful journey here</p> --}}
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}"> <i class="fa fa-home fa-lg"></i></li></a>
                <li class="breadcrumb-item"><a href="{{ url('Toko')}}"> Toko </a></li>
                <li class="breadcrumb-item"> Edit Toko </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h5>Edit Toko</h5>
                <hr>
                <form class="forms-sample" action="{{ url('Toko/'.$store->id) }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Cabang  <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" required="" placeholder="Nama " value="{{ $store->name }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Email  </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="email" placeholder="Email " value="{{ $store->email }}" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">No Telepon </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="telp" placeholder="No Telepon " value="{{ $store->telp }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Alamat <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <textarea name="address" class="form-control" required> {{ $store->address }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Kepala Toko  <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <select name="user_id" class="form-control" required>
                                    <option value="" selected="" disabled>-Pilih Kepala Toko-</option>
                                    @foreach ($user as $item)
                                        @if ($item->id == $store->user_id )
                                            <option value="{{ $item->id }}" selected> {{ $item->name }}</option>  
                                        @else
                                            <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                        @endif
                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-footer text-right">
                        <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url('/Toko') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</main>
@endsection