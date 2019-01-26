
@extends('layouts.admin')
@section('title')
| User
@endsection
@section('script')
<script>
  window.remove = function (id) {
      event.preventDefault();
  
      swal({
          title: "Apakah Anda Yakin?",
          text: "User yang sudah di hapus tidak dapat di kembalikan!",
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
              "User sudah dihapus.",
              "success");
      });
  };
</script>
@endsection
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-users"></i> User</h1>
      {{-- <p>Start a beautiful journey here</p> --}}
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">User</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div align="right">
            <a href="{{ url ('User/create') }}" class="btn btn-primary btn-sm">
                <b><i class="fa fa-plus"></i></b> User
            </a>
        </div>
        <hr>
        <table class="table table-hover table-striped" id="sampleTable">
            <thead>
                <tr>
                  <td><b> No </b></td>
                  <td><b> Nama </b></td>
                  <td><b> Email </b></td>
                  <td><b> Jabatan </b></td>
                  <td><b> Aksi  </b></td>

                </tr>
            </thead>
          <tbody>
            <?php $no=1;?>
            @foreach($users as $key=>$value)
              <tr>
                <td> {{ $key+1 }} </td>
                <td> {{ $value->name }}</td>
                <td> {{ $value->email }}</td>
                <td> {{ $value->role->name }} </td>
                <td>
                  <form id="delete-{{$value->id}}"
                    action="{{ action('UserController@destroy', ['id' => $value->id]) }}" method="POST"
                    style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                  </form>
                  <a class="btn btn-danger btn-xs" style="padding: 0px 5px 0px 5px;color: #fff"
                    onclick="remove({{$value->id}})">
                    Hapus
                  </a>
                  <a href=" {{  url('User/'.$value->id.'/edit') }} " class="btn btn-primary btn-xs" style="padding: 0px 5px 0px 5px"> Ubah </a>
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