
@extends('layouts.admin')
@section('title')
| Vendor
@endsection
@section('script')
<script>
  window.remove = function (id) {
      event.preventDefault();
  
      swal({
          title: "Apakah Anda Yakin?",
          text: "Vendor yang sudah di hapus tidak dapat di kembalikan!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya, Hapus!",
          cancelButtonText: 'Batal',
          closeOnConfirm: false,
          html: false
      }, function () {
          document.getElementById('delete-' + id).submit();
          swal("Berhasil!",
              "Vendor sudah dihapus.",
              "success");
      });
  };

  window.inactive = function (id) {
      event.preventDefault();
  
      swal({
          title: "Apakah Anda Yakin?",
          text: "Vendor akan di Non Activkan",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya, non activkan",
          cancelButtonText: 'Batal',
          closeOnConfirm: false,
          html: false
      }, function () {
          document.getElementById('inactive-' + id).submit();
          swal("Mohon Tunggu!",
              "Sedang Pengecekan Data",
              "success");
      });
  };

  window.active = function (id) {
      event.preventDefault();
  
      swal({
          title: "Apakah Anda Yakin?",
          text: "Vendor akan di Activkan kembali",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya, Activkan kembali",
          cancelButtonText: 'Batal',
          closeOnConfirm: false,
          html: false
      }, function () {
          document.getElementById('active-' + id).submit();
          swal("Berhasil!",
              "Vendor sudah diaktifkan.",
              "success");
      });
  };
</script>
@endsection
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-users"></i> Vendors</h1>
      {{-- <p>Start a beautiful journey here</p> --}}
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Vendor</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div align="right">
            <a href="{{ url ('Vendors/create') }}" class="btn btn-primary btn-sm">
                <b><i class="fa fa-plus"></i></b> Vendors
            </a>
        </div>
        <hr>
        <table class="table table-hover table-striped" id="sampleTable">
            <thead>
                <tr>
                  <td><b> No </b></td>
                  <td><b> Nama </b></td>
                  <td><b> kategori </b></td>
                  <td><b> No Telp </b></td>
                  <td><b> Email </b></td>
                  <td><b> Alamat </b></td>
                  <td><b>  </b></td>
                  <td><b> Aksi  </b></td>

                </tr>
            </thead>
          <tbody>
            @foreach($vendors as $key=>$value)
              <tr>
                <td> {{ $key+1 }} </td>
                <td> {{ $value->name }}</td>
                <td> {{ $value->category->name }}</td>
                <td> {{ $value->notelp }}</td>
                <td> {{ $value->email }}</td>
                <td> {{ $value->alamat }}</td>
                <td> {{ $value->active }}</td>
                <td>
                    <div class="toggle">
                      @if ($value->active== 1)
                      <form id="inactive-{{$value->id}}" action="{{ url('/Vendors/inactive/'.$value->id ) }}" method="POST"style="display: none;">
                        {{ csrf_field() }}
                      </form> 
                        <a href="#" onclick="inactive({{$value->id}})"><input type="checkbox" checked=""><span class="button-indecator"></span></a>
                      @else
                      <form id="active-{{$value->id}}" action="{{ url('/Vendors/active/'.$value->id ) }}" method="POST"style="display: none;">
                        {{ csrf_field() }}
                      </form> 
                        <a href="#" onclick="active({{$value->id}})"><input type="checkbox"><span class="button-indecator"></span></a>
                      @endif
                      
                    </div>
                </td>
                <td>
                  @if ($value->status != 1)
                    <form id="delete-{{$value->id}}" action="{{ action('VendorsController@destroy', ['id' => $value->id]) }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                    </form>
                    <a class="btn btn-danger btn-xs" style="padding: 0px 5px 0px 5px;color: #fff" onclick="remove({{$value->id}})">Hapus
                    </a>
                  @endif
                  
                  <a href=" {{  url('Vendors/'.$value->id.'/edit') }} " class="btn btn-primary btn-xs" style="padding: 0px 5px 0px 5px"> Ubah </a>
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