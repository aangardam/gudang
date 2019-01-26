@extends('layouts.admin')
@section('title')
| Profil
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
          <div class="col-md-4">
            <div class="tile">
              <h3 class="tile-title"> Profil User</h3>
              <hr>
              <form method="post" enctype="multipart/form-data" action="{{ url('profil/update/'.$user->id)}}">
                 {{ csrf_field() }}
                <div align="center">
                  <label for="upload" title="Ganti Gambar">
                    <input id = "upload" style="display:none" type="file" name="image">
                    @if($staff->foto == '')
                      <img src="{{ asset('image/logo-smp.jpg') }}" alt="profile" id="blah"> <br><br>
                    @else
                      <img src="{{ $staff->foto }} " alt="profile" id="blah" width="50%">
                    @endif
                    <h5> {{Auth::user()->name }} <br>
                      <small> {{Auth::user()->email }} </small>
                    </h5>
                  </label>
                  <div>
                      <input type="file" class="form-control" name="image" capture accept=".png, .jpg" id="imgInp" required> <br>
                  </div>
                  <div align="center">
                      <button type="submit" class="btn btn-primary btn-xs">Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-8">
            <div class="tile">
              <h3 class="tile-title"> Data Detail </h3>
              <hr>
              <form method="post" action="{{ url('profil/edit/'.$user->id)}}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $staff->id  }}" />
                <input type="hidden" name="user_id" value="{{ $staff->user_id  }}" />
                <div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                      <label> NIP <small class="text-danger">*</small></label>
                    </div>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nip" required="" value="{{ $staff->nip}}" readonly="">
                    </div>
                  </div>
                </div>
                <div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                      <label> NUPTK <small class="text-danger">*</small></label>
                    </div>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nuptk" required="" value="{{ $staff->nuptk}}" readonly="">
                    </div>
                  </div>
                </div>
                <div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                      <label> Nama <small class="text-danger">*</small></label>
                    </div>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" required="" value="{{ $staff->name}}">
                    </div>
                  </div>
                </div>
                <div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                      <label> Email <small class="text-danger">*</small></label>
                    </div>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="email" required="" value="{{ $staff->email}}">
                    </div>
                  </div>
                </div>
                <div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                      <label> Tempat Lahir <small class="text-danger">*</small></label>
                    </div>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="pob" required="" value="{{ $staff->pob}}">
                    </div>
                  </div>
                </div>
                <div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                      <label> Tanggal Lahir <small class="text-danger">*</small></label>
                    </div>
                    <div class="col-sm-10">
                      <input type="text" class="form-control datepicker" name="dob" required="" value="{{ $staff->dob}}">
                    </div>
                  </div>
                </div>
                <div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                      <label> No HP <small class="text-danger">*</small></label>
                    </div>
                    <div class="col-sm-10">
                      <input type="text" class="form-control datepicker" name="hp" required="" value="{{ $staff->hp}}">
                    </div>
                  </div>
                </div>
                <div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                      <label> Jenis Kelamin <small class="text-danger">*</small></label>
                    </div>
                    <div class="col-sm-10">
                      <select name="jk" id="jk" class="form-control">
                        @if( $staff->jk == 'L' )
                        <option value="L"> Laki Laki </option>
                        <option value="P"> Perempuan </option>
                        @else
                        <option value="P"> Perempuan </option>
                        <option value="L"> Laki Laki </option>
                        @endif
                      </select>
                    </div>
                  </div>
                </div>

                 <div align="right">
                    <button type="submit" class="btn btn-success mr-2">Simpan</button>
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
<script type="text/javascript">
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
@endsection