@extends('layouts.admin')
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h3><i class="fa fa-dashboard"></i> Dasboard </h3>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Dasboard </a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12 ">
            <h1> Selamat Datang  <b> {{ auth::user()->name }} </b></h1>
        </div>
    </div>

    <!--  <div class="row">
         <div class="col-md-12">
            <div class="tile">

            </div>
         </div>
     </div> -->
</main>
@endsection