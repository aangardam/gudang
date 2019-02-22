@extends('layouts.admin') 
@section('title') | Profil
@endsection
 
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-user"></i> Profil</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Profil</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <h3 class="tile-title"> Detail Login </h3>
              <hr>
              <form method="post" action="{{ url('profil/edit/'.$user->id)}}">
                {{ csrf_field() }}
                <input type="hidden" name="status" value="{{ $status }}">
                <div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                      <label> Nama <small class="text-danger">*</small></label>
                    </div>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" required="" value="{{ $user->name}}">
                    </div>
                  </div>
                </div>
                <div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                      <label> Email <small class="text-danger">*</small></label>
                    </div>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" required="" value="{{ $user->email}}">
                    </div>
                  </div>
                </div>
                @if ($status == 'Vendors')
                <div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                      <label> Alamat </label>
                    </div>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="address" value="{{ $vendors->address}}">
                    </div>
                  </div>
                </div>
                <div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                      <label> No Telp </label>
                    </div>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="notelp" value="{{ $vendors->notelp}}">
                    </div>
                  </div>
                </div>
                @endif
                {{-- password --}}
                <div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                      <label> Password</label>
                    </div>
                    <div class="col-md-10">
                      <div class="input-group">
                        <input id="password" type="password" class="form-control" placeholder="password" name="password">
                        <span class="input-group-btn">
                            <button id= "show_password" class="btn btn-primary" type="button">
                              <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </button>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- confrim password --}}
                <div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                      <label> Ulangi Password</label>
                    </div>
                    <div class="col-md-10">
                      <div class="input-group">
                        <input id="password2" type="password" class="form-control" placeholder="Konfirmasi Password" name="password2">
                        <span class="input-group-btn">
                            <button id= "show_password2" class="btn btn-primary" type="button">
                              <span toggle="#password2" class="fa fa-fw fa-eye field-icon toggle-password-confrim"></span>
                        </button>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div align="right">
                  <button type="submit" id="btnSubmit" class="btn btn-success mr-2">Simpan</button>
                </div>
              </form>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
 
@section('script')
<script>
  $(document).ready(function(){
    $(".toggle-password-confrim").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });

    $(".toggle-password").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });

    $(function () {
      $("#btnSubmit").click(function () {
        var password = $("#password2").val();
        var confirmPassword = $("#password").val();
        if(password.length != 0 || confirmPassword.length != 0){
          if(password.length >= 4 || confirmPassword.length >= 4 ){
            if (password != confirmPassword) {
              swal({
                type: 'error',
                title: 'Error',
                text: 'Password Tidak Sesuai'
              });
              return false;
            }
            return true;
          }else{
            swal({
              type: 'error',
              title: 'Error',
              text: 'Password minimal 4 Karakter'
            });
            return false;
          }
        }
      });
    });
  });

</script>
@endsection