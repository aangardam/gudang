@extends('layouts.admin')
@section('title')
| Ubah User
@endsection

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-tasks"></i> User </h1>
      {{-- <p>Start a beautiful journey here</p> --}}
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('home') }}"> <i class="fa fa-home fa-lg"></i></li></a>
      <li class="breadcrumb-item"><a href="{{ url('User')}}"> User </a></li>
      <li class="breadcrumb-item"> Ubah User </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <h5>Ubah User</h5>
        <hr>
        <form class="forms-sample" action="{{ url('User/'.$users->id)}}" method="post" >
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="id" value="id">
          <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <div class="row">
              <label for="name" class="col-md-2">Nama <span class="text-danger">*</span></label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="name" required="" placeholder="Nama" value="{{ $users->name }}" />
                @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="row">
              <label for="email" class="col-md-2">Email <span class="text-danger">*</span></label>
              <div class="col-md-10">
                <input type="email" class="form-control" readonly="" name="email" required="" placeholder="E-Mail" value="{{ $users->email }}"/>
                @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <div class="row">
              <label for="name" class="col-md-2">Jabatan <span class="text-danger">*</span></label>
              <div class="col-md-10">
                <select name="role_id" class="form-control" required="">
                  <option value="" selected="" disabled=""> Pilih Jabatan </option>
                  @foreach ($role as $element)
                  @if ($users->role_id == $element->id)
                  <option value="{{ $element->id }}" selected=""> {{ $element->name }}</option>
                  @else
                  <option value="{{ $element->id }}"> {{ $element->name }}</option>
                  @endif
                  
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="row">
              <label for="password" class="col-md-2">Password <span class="text-danger">*</span></label>
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

          <div class="form-group">
            <div class="row">
              <label for="password" class="col-md-2">Ulangi Password <span
                class="text-danger">*</span></label>
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
            <div class="ibox-footer text-right">
              <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>
              <a href="{{ url('/User') }}" class="btn btn-danger">Batal</a>
            </div>
          </form>
        </div>
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
              text: 'Password minimal 8 Karakter'
            });
            return false;
          }
        }
      });
    });
  });
</script>
@endsection