@extends('layouts.admin')
@section('title')
| Page Not Found
@endsection
@section('content')

<style>
html, body {
	height: 100%;
}

body {
	margin: 0;
	padding: 0;
	width: 100%;
	color: #B0BEC5;
	display: table;
	font-weight: 100;
	font-family: 'Lato';
}

.title {
	font-size: 150px;
	color: aqua;
	text-align: center;
	/*margin-top: %;*/
}
.title2 {
	font-size: 60px;
	text-align: center;
	color: black;
}
.error-desc {
	font-size: 30px;
	text-align: center;
	color: black;
}
.error-desc a {
	font-size: 20px;
	margin-left: 750px;
}
</style>
<div class="title"> 404 </div>
<div class="title2"><b> Oops! Page not found </b></div>
<div class="error-desc">
	Sorry, but the page you are looking for has not been found. Try found something else in our app.
	<form class="form-inline m-t" role="form">
		<center><a href="{{ url()->previous() }}" class="btn btn-primary">Back</a></center>
	</form>
</div>

@endsection