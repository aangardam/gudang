@extends('layouts.admin') 
@section('title') | Detail Barang 
@endsection
 
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tasks"></i> Detail Barang </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}"> <i class="fa fa-home fa-lg"></i></li></a>
                {{--  <li class="breadcrumb-item"><a href="{{ url('Produk/')}}">  </a></li>  --}}
                <li class="breadcrumb-item"> Detail Barang  </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h5>Detail Barang</h5>
                <hr>
                <form class="forms-sample" action="{{ url('Produk/pending/save') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <div class="row">
                            <label for="name" class="col-md-2">Surat Jalan <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="nosurat" required="" placeholder="Surat Jalan" value="{{ $data[0]->nosurat }}" readonly="" />
                            </div>
                            <label for="email" class="col-md-2">Toko <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="store_id" required="" placeholder="Surat Jalan" value="{{ $data[0]->store->name }}" readonly="" />
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
                                            <td> No </td>
                                            <td> Jenis </td>
                                            <td> Produk </td>
                                            <td> Ukuran </td>
                                            <td> QTY </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $value=>$item)
                                        <input type="hidden" name="id[]" value="{{ $item->id }}">
                                            <tr>
                                                <td> {{ $value+1 }}</td>
                                                <td>{{ $item->produk->category->name }}</td>
                                                <td>{{ $item->produk->name }}</td>
                                                <td> {{ $item->size }}</td>
                                                <td> {{ $item->qty }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="ibox-footer text-right">
                        @if ($data[0]->status == 'Pending')
                            <button type="submit" id="btnSubmit" class="btn btn-primary">Terima</button>
                        @endif
                        
                        <a href="{{ URL::previous() }}" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
