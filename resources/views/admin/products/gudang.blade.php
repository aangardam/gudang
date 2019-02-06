
@extends('layouts.admin')
@section('title')
| Stok Gudang
@endsection
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-tasks7"></i> Stok Gudang</h1>
      {{-- <p>Start a beautiful journey here</p> --}}
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Stok Gudang</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div align="right">
            {{--  <a href="{{ url ('Produk/PO/create') }}" class="btn btn-primary btn-sm">
                <b><i class="fa fa-plus"></i></b> PO
            </a>  --}}
        </div>
        <hr>
        <table class="table table-hover table-striped" id="sampleTable">
            <thead>
                <tr>
                  <td><b> No </b></td>
                  <td><b> No Transaksi </b></td>
                  <td><b> Nama </b></td>
                  <td><b> Harga </b></td>
                  <td><b> QTY </b></td>
                  <td><b> Gambar </b></td>
                  <td><b> Aksi  </b></td>

                </tr>
            </thead>
          <tbody>
            <?php $no=1;?>
            @foreach($products as $key=>$value)
              <tr>
                <td> {{ $key+1 }} </td>
                <td> {{ $value->no_trans }}</td>
                <td> {{ $value->name }}</td>
                <td align="right"> {{ number_format($value->price) }}</td>
                <td> {{ $value->total }}</td>
                <td> 
                  @if ($value->image == '')
                      -
                  @else
                    <img src="{{ url($value->image) }}" width="100px">  
                  @endif
                    
                </td>
                <td valign="middle">
                  <a href=" {{  url('Produk/Send/'.$value->id.'/view2') }} " class="btn btn-success btn-xs" style="padding: 0px 5px 0px 5px"> Lihat </a>
                </td>
               
              </tr>
            @endforeach
          </tbody>        	
        </table>
      </div>
    </div>
  </div>
</main>
@endsection