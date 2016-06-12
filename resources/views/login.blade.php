@extends('layouts.auth')

@section('content')

<div class="login-box">
	<div class="login-logo">
		<a href="#"><b>Ng</b>antor</a>
	</div><!-- /.login-logo -->

	<div class="login-box-body">
		<p class="login-box-msg">Sign in to start your session</p>

		<form method='post' action="{{ url('login') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			@if ($errors->has('email')) <p class="text-danger">{{ $errors->first('email') }}</p> @endif
			<div class="form-group has-feedback">
				<input type="email" class="form-control" name="email" placeholder='Email' value="{{ old('email') }}" />
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>

			@if ($errors->has('pwd')) <p class="text-danger">{{ $errors->first('pwd') }}</p> @endif
			<div class="form-group has-feedback">
				<input type="password" class="form-control" name="pwd" placeholder='Password' />
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>

			<div class="row">
				<div class="col-xs-4">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
				</div><!-- /.col -->
			</div>
		</form>

	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->

@endsection
