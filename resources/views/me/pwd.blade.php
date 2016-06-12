@extends('layouts.gui')

@section('title')
Ganti Password
<small>{{ Auth::user()->name }}</small>
@endsection


@section('content')

<div class='row'>
<div class='col-sm-4'>
	<div class='box box-primary'>
		<form method=post action="{{ url('me/pwd') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class='box-body'>
			@if (Session::has('message'))
			<div class="alert alert-success">{{ Session::get('message') }}</div>
			@endif

			@if ($errors->has('pwd_old'))
			<div class="form-group has-warning">
			@else
			<div class="form-group">
			@endif
				<label>Password Lama</label>
				@if ($errors->has('pwd_old')) <em class="text-muted">{{ $errors->first('pwd_old') }}</em>@endif
				<input type="password" name=pwd_old class="form-control">
			</div>

			@if ($errors->has('pwd_new'))
			<div class="form-group has-warning">
			@else
			<div class="form-group">
			@endif
				<label>Password Baru</label>
				@if ($errors->has('pwd_new')) <em class="text-muted">{{ $errors->first('pwd_new') }}</em>@endif
				<input type="password" name=pwd_new class="form-control">
			</div>
		</div>
		<div class='box-footer'>
			<button type=submit class='btn btn-primary'>Ganti Sekarang</button>
		</div>
		</form>
	</div>
</div>
</div>

@endsection
