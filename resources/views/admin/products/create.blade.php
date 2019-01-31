@extends('layouts.admin') 
@section('title') | Tambah PO
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
                <li class="breadcrumb-item"> Tambah PO </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h5>Tambah PO</h5>
                <hr>
                <form class="forms-sample" action="{{ url('Produk/PO/save')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <div class="row">
                            <label for="name" class="col-md-2">Kode Transaksi<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="no_trans" required="" placeholder="Kode" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="name" class="col-md-2">Kategori<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" selected="" disabled>- Pilih Kategori - </option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="name" class="col-md-2">Vendor<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <select name="vendor_id" id="vendor_id" class="form-control" required>
                                    <option value="" selected="" disabled>- Pilih Vendor - </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Nama Produk <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" required="" placeholder="Nama Produk" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Harga Jual </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="price" id="price" placeholder="Harga Jual" onkeyup="format()" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Target Selesai <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control datepicker" id="datepicker" name="finishing" required="" placeholder="Target Selesai"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Gambar</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control" name="image" placeholder="Target Selesai" id="imgInp" />                                @if ($errors->has('image'))
                                <strong style="color:red">{{ $errors->first('image') }}</strong> @endif
                                <img width="200" id="blah" class="img-rounded">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">Ukuran <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control " id="size" name="size" required="" placeholder="Ukuran" value="All Size" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2">QTY <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control " id="qty" required="" placeholder="Jumlah Produk" onkeyup="format()"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2"></label>
                            <div class="col-md-10">
                                <a class="btn btn-primary" onclick="tambah_produk()">Tambahkan</a>
                                <button type="reset" class="btn btn-danger"> Reset  </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="email" class="col-md-2"></label>
                            <div class="col-md-10">
                                <table class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
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
                    <div class="ibox-footer text-right">
                        <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url('/Produk/PO/') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
 
@section('script')
<script type="text/javascript">
    $('#category_id').on('change',function(){
        var category = $(this).val();
        // alert(category)
        $.ajax({
            url:'/ajax/getVendor/'+category,
            success:function(response){
                $("#vendor_id").html(response);
                $.each(response, function (index, vendor) {
                    console.log(vendor);
                    $("#vendor_id").append("<option value='" + vendor.id +"'>"  + vendor.name + "</option>");
                });
            }
        });
    });
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
<script>
    function format(){
        var price = $("#price").val();
        document.getElementById("price").value=formatNumber(price,0,0,true);
        var qty = $("#qty").val();
        document.getElementById("qty").value=formatNumber(qty,0,0,true);
    }
    function formatNumber(number, digits, decimalPlaces, withCommas)
    {
        number       = number.toString();
        var simpleNumber = '';
        for (var i = 0; i < number.length; ++i)
        {
            if ("0123456789.".indexOf(number.charAt(i)) >= 0)
                simpleNumber += number.charAt(i);
        }
        number = parseFloat(simpleNumber);
        if (isNaN(number))      number     = 0;
        if (withCommas == null) withCommas = false;
        if (digits     == 0)    digits     = 1;

        var integerPart = (decimalPlaces > 0 ? Math.floor(number) : Math.round(number));
        var string      = "";

        for (var i = 0; i < digits || integerPart > 0; ++i)
        {
            // Insert a comma every three digits.
            if (withCommas && string.match(/^\d\d\d/))
                string = "," + string;

            string      = (integerPart % 10) + string;
            integerPart = Math.floor(integerPart / 10);
        }

        if (decimalPlaces > 0)
        {
            number -= Math.floor(number);
            number *= Math.pow(10, decimalPlaces);

            string += "." + formatNumber(number, decimalPlaces, 0);
        }

        return string;
    }

</script>
<script>
    function tambah_produk(){
        var size = $("#size").val();
        var qty = Number($('#qty').val().replace(/,/g, ''));
        if(size == ''|| qty == ''){
            alert("Ukuran dan/atau qty tidak boleh kosong ");
        }else{
            var no = Number($("#no").val())+1;
            $('#no').val(no);
            $("#detail").append(
                "<tr id='no"+no+"'>"+
                    "<td>"+size+"</td>"+
                    "<td>"+convertToRupiah(qty)+"</td>"+
                    "<td><button type='button' class='btn btn-danger btn-xs' onclick='fungsihapus("+no+")'>Hapus</button></td>"+

                    "<input type='hidden'  name='size[]' value='"+size+"'>"+ 
                    "<input type='hidden'  name='qty[]' value='"+qty+"'>"+ 
                    "<input type='hidden'  name='quantity' value='"+no+"'>"+ 

                "</tr>"
            )
        }
    }
    function fungsihapus(id){
        console.log(id)
        $("#no"+id+"").remove();
    }
    function convertToRupiah(angka)
    {
      var rupiah = '';    
      var angkarev = angka.toString().split('').reverse().join('');
      for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+',';
          return rupiah.split('',rupiah.length-1).reverse().join('');
    }
</script>
@endsection