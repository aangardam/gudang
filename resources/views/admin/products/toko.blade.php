
@extends('layouts.admin')
@section('title')
| Stok Toko
@endsection
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-tasks"></i> Stok Toko</h1>
      {{-- <p>Start a beautiful journey here</p> --}}
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Stok Toko</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <hr>
        <table class="table table-hover table-striped" id="sampleTable">
            <thead>
                <tr>
                  <td><b> No </b></td>
                  <td><b> No Surat </b></td>
                  <td><b> Toko </b></td>
                  {{--  <td><b> Produk </b></td>
                  <td><b> ukuran </b></td>
                  <td><b> Jumlah </b></td>  --}}
                  <td><b> Status </b></td>
                  <td>Print</td>
                </tr>
            </thead>
          <tbody>
            <?php $no=1;?>
            @foreach($data as $key=>$value)
              <tr>
                <td> {{ $key+1 }} </td>
                <td> {{ $value->nosurat }}</td>
                <td> {{ $value->store->name }}</td>
                {{--  <td> {{ $value->produk->name }}</td>
                <td> {{ $value->size }}</td>
                <td align="right"> {{ number_format($value->qty) }}</td>  --}}
                <td> {{ $value->status }}</td>               
                <td>
                  <a href="{{ url('Produk/store/print/'.$value->nosurat) }}" class="btn btn-sm btn-success"> 
                    <i class="glyphicon glyphicon-print"></i> PRINT
                </a>
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