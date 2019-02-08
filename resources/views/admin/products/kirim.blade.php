@extends('layouts.admin') 
@section('title') | Kirim Barang 
@endsection
 
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tasks"></i> Kirim Barang </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}"> <i class="fa fa-home fa-lg"></i></li></a>
                {{--  <li class="breadcrumb-item"><a href="{{ url('Produk/')}}">  </a></li>  --}}
                <li class="breadcrumb-item"> Kirim Barang  </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h5>Kirim Barang</h5>
                <hr>
                <form class="forms-sample" action="{{ url('Produk/Stok/save') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="id_product" required="" placeholder="Kode" />
                    <div class="form-group">
                        <div class="row">
                            <label for="name" class="col-md-2">Surat Jalan <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="no_trans" required="" placeholder="Surat Jalan"/>
                            </div>
                            <label for="email" class="col-md-2">Toko <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <select name="store_id" class="form-control" required>
                                    <option value="" selected disabled>Pilih Toko</option>
                                    @foreach ($store as $item)
                                        <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="form-group">
                        <div class="row">
                            <label for="name" class="col-md-2">Produk <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <select name="product_id" id="produk" class="form-control">
                                    @foreach ($produk as $item)
                                        <option value="{{ $item->id }}-{{ $item->name }}"> {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="email" class="col-md-2">Ukuran <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <select name="store_id" class="form-control" required>
                                    <option value="" selected disabled>Pilih Ukuran</option>
                                    @foreach ($store as $item)
                                        <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="name" class="col-md-2">Jumlah <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="no_trans" required="" placeholder="Jumlah"/>
                            </div>
                            <label for="email" class="col-md-2"></label>
                            <div class="col-md-4">
                                <a class="btn btn-success" onclick="tambah_produk()">Tambah produk</a>
                            </div>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td> Produk </td>
                                            <td> Ukuran </td>
                                            <td> QTY </td>
                                            <td> Aksi </td>
                                        </tr>
                                    </thead>
                                    <input type="hidden" id="no" value="0">
                                    <tbody id="detail"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="ibox-footer text-right">
                        <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url('/Produk/Stok/') }}" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
<script>
    function tambah_produk(){
        var size = $("#size").val();
        var qty = $('#qty').val();
        var store = $('#store_id').val();
        var store = store.split('-');
        if(size == ''|| qty == '' || store == ''){
            alert("Data tidak boleh kosong ");
        }else{
            var no = Number($("#no").val())+1;
            $('#no').val(no);
            $("#detail").append(
                "<tr id='no"+no+"'>"+
                    "<td>"+store[1]+"</td>"+
                    "<td>"+size+"</td>"+
                    "<td>"+qty+"</td>"+
                    "<td><button type='button' class='btn btn-danger btn-xs' onclick='fungsihapus("+no+")'>Hapus</button></td>"+

                    "<input type='hidden'  name='size[]' value='"+size+"'>"+ 
                    "<input type='hidden'  name='qty[]' value='"+qty+"'>"+ 
                    "<input type='hidden'  name='store[]' value='"+store[0]+"'>"+ 
                    "<input type='hidden'  name='quantity' value='"+no+"'>"+ 

                "</tr>"
            )
        }
    }
    function fungsihapus(id){
        console.log(id)
        $("#no"+id+"").remove();
    }
</script>
@endsection