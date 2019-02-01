@extends('layouts.admin') 
@section('title') | Detail PO
@endsection
 
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tasks"></i> PO </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}"> <i class="fa fa-home fa-lg"></i></li></a>
                <li class="breadcrumb-item"><a href="{{ url('Produk/PO')}}"> PO </a></li>
                <li class="breadcrumb-item"> Detail PO </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h5>Detail PO</h5>
                <hr>
                <form class="forms-sample" action="#" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="id_product" required="" placeholder="Kode" value="{{ $produk->id }}"/>
                    <div class="form-group">
                        <div class="row">
                            <label for="name" class="col-md-2">Kode Transaksi<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="no_trans" required="" placeholder="Kode" value="{{ $produk->no_trans }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="name" class="col-md-2">Kategori<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{ $produk->category->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="name" class="col-md-2">Vendor<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{ $produk->vendor->name }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Nama Produk <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" required="" placeholder="Nama Produk" value="{{ $produk->name }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Harga Jual </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="price" id="price" placeholder="Harga Jual" value="{{ $produk->price }}"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Target Selesai <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control datepicker" id="datepicker" name="finishing" required="" placeholder="Target Selesai"
                                    value="{{ $produk->finishing }}" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Gambar</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control" name="image" placeholder="Target Selesai" id="imgInp" />                                @if ($errors->has('image'))
                                <strong style="color:red">{{ $errors->first('image') }}</strong> @endif
                                <img width="200" id="blah" src="{{ asset($produk->image) }}" class="img-rounded">
                            </div>
                        </div>
                    </div>
                    <hr>
                    @php
                        $tgl = substr($produk->created_at,0,10); 
                        $tgl2 = date('Y-m-d', strtotime('+1 days', strtotime($tgl)));
                    @endphp
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2"></label>
                            <div class="col-md-12">
                                <table class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td> No </td>
                                            <td> Ukuran </td>
                                            <td> QTY </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;?>
                                        @foreach ($detail as $item =>$value)
                                            <tr>
                                                <td> {{ $no++}}</td>
                                                @if ( date('Y-m-d') >= $tgl2 )
                                                    <td>
                                                        <input type="text" name="size[]" class="form-control" value="{{ $value->size }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="qty[]" class="form-control" value="{{ $value->size }}" readonly>
                                                    </td>
                                                @else
                                                    <td>
                                                        <input type="text" name="size[]" class="form-control" value="{{ $value->size }}" >
                                                    </td>
                                                    <td>
                                                        <input type="text" name="qty[]" class="form-control" value="{{ $value->size }}" >
                                                    </td>
                                                @endif

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-footer text-right">
                        <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url('/Produk/PO/') }}" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
 
@section('script')
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        }
    }

    $('#test').bind('keydown', function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
        }
    });

    $("#imgInp").change(function(){
        readURL(this);
    });

</script>
@endsection