@extends('layouts.admin') 
@section('title') | Test Rabinkarp
@endsection
 
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-user"></i> Rabinkarp </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h5>Tambah Rabinkarp</h5>
                <hr>
                <form class="forms-sample" action="{{ url('test/rabinkarp')}}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Judul  <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="nama" required="" placeholder="Nama " />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Isi  <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="isi" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="ibox-footer text-right">
                        <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</main>
@endsection