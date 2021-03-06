@extends('layouts.admin') 
@section('title') | Tambah Toko
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
                <li class="breadcrumb-item"> Tambah Toko </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h5>Tambah Toko</h5>
                <hr>
                <form class="forms-sample" action="{{ action('StoreController@store')}}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Cabang  <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" required="" placeholder="Nama " />
                                <input type="hidden" class="form-control" name="active" value=1 />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Email  </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="email" placeholder="Email " />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">No Telepon </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="notelp" placeholder="No Telepon " />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Alamat <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <textarea name="address" class="form-control" required></textarea>
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
                                        <option value="{{ $item->id }}"> {{ $item->name }}</option>
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