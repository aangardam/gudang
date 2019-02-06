@extends('layouts.admin') 
@section('title') | Detail 
@endsection
 
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tasks"></i> Detail </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}"> <i class="fa fa-home fa-lg"></i></li></a>
                {{--  <li class="breadcrumb-item"><a href="{{ url('Produk/')}}">  </a></li>  --}}
                <li class="breadcrumb-item"> Detail  </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h5>Detail PO</h5>
                <hr>
                <form class="forms-sample" action="{{ url('Produk/Stok/save') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="id_product" required="" placeholder="Kode" value="{{ $produk->id }}" readonly/>
                    <div class="form-group">
                        <div class="row">
                            <label for="name" class="col-md-2">Kode Transaksi<span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="no_trans" required="" placeholder="Kode" value="{{ $produk->no_trans }}" readonly/>
                            </div>
                            <label for="email" class="col-md-2">Nama Produk <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="name" required="" placeholder="Nama Produk" value="{{ $produk->name }}" readonly/>
                            </div>
                        </div>
                    </div>
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
                                        @foreach ($detail as $item)
                                            <tr>
                                                <td> {{ $no++}}</td>
                                                <td> {{ $item->size }} </td>
                                                <td> {{ $item->qty }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <label for="name" class="col-md-1">Toko<span class="text-danger">*</span></label>
                            <div class="col-md-2">
                                <select id="store_id" name="store_id" class="form-control">
                                    @foreach ($store as $item)
                                        <option value="{{ $item->id }} - {{ $item->name }}" >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="email" class="col-md-1">Ukuran <span class="text-danger">*</span></label>
                            <div class="col-md-2">
                                {{--  <input type="text" class="form-control " id="size" name="size" required="" placeholder="Ukuran" value="All Size" />  --}}
                                <select id="size" name="size" class="form-control">
                                    @foreach ($detail as $item2)
                                        <option>{{ $item2->size }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="email" class="col-md-1">QTY <span class="text-danger">*</span></label>
                            <div class="col-md-2">
                                <input type="number" class="form-control " id="qty" name="qty" required="" placeholder="QTY" value="All Size" />
                            </div>
                            <div class="col-md-2">
                                <a class="btn btn-success" onclick="tambah_produk()">Tambahkan</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td> Toko </td>
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