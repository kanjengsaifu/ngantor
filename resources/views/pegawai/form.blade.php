@extends('layouts.gui')

@section('title')
Pegawai
<small>Formulir</small>
@endsection


@section('content')

<div class='row'>
<div class='col-sm-6'>
	<div class='box box-primary'>
		<div class='box-header'>
			<h3 class='box-title'>{{ (isset($data->id) or !empty(old('id'))) ? 'Ubah' : 'Tambah' }}</h3>
		</div>
		<form method=post action="{{ url('pegawai/save') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="id" value="{{ $data->id or old('id') }}">
		<div class='box-body'>
			@if ($errors->has('name'))
			<div class="form-group has-warning">
			@else
			<div class="form-group">
			@endif
				<label>Nama Lengkap</label>
				@if ($errors->has('name')) <em class="text-muted">{{ $errors->first('name') }}</em>@endif
				<input type=text name='name' class='form-control' value="{{ $data->name or old('name') }}">
			</div>

			@if ($errors->has('email'))
			<div class="form-group has-warning">
			@else
			<div class="form-group">
			@endif
				<label>Email</label>
				@if ($errors->has('email')) <em class="text-muted">{{ $errors->first('email') }}</em>@endif
				<input type=email name='email' class='form-control' value="{{ $data->email or old('email') }}">
			</div>

			@if ($errors->has('password'))
			<div class="form-group has-warning">
			@else
			<div class="form-group">
			@endif
				<label>Password</label>
				@if ($errors->has('password')) <em class="text-muted">{{ $errors->first('password') }}</em>@endif
				<input type=password name='pwd' class='form-control'>
				@if (isset($data->id))
				<small><em class='text-muted'>Kosongkan password jika tidak ingin diganti</em></small>
				@endif
			</div>

			@if ($errors->has('id_divisi'))
			<div class="form-group has-warning">
			@else
			<div class="form-group">
			@endif
				<label>Divisi</label>
				@if ($errors->has('id_divisi')) <em class="text-muted">{{ $errors->first('id_divisi') }}</em>@endif
				<select class="form-control" name=id_divisi>
					<option value=''>-</option>
					@foreach($divisi as $item)
						@if (((isset($data->id_divisi) && $data->id_divisi == $item->id)) or (old('id_divisi') == $item->id))
							<option value="{{ $item->id }}" selected>{{ $item->name }}</option>
						@else
							<option value="{{ $item->id }}">{{ $item->name }}</option>
						@endif
					@endforeach
				</select>
            </div>

			@if ($errors->has('id_jabatan'))
			<div class="form-group has-warning">
			@else
			<div class="form-group">
			@endif
				<label>Jabatan</label>
				@if ($errors->has('id_jabatan')) <em class="text-muted">{{ $errors->first('id_jabatan') }}</em>@endif
				<select class="form-control" name=id_jabatan>
					<option value=''>- Pilih -</option>
					@foreach($jabatan as $item)
						@if (((isset($data->id_jabatan) && $data->id_jabatan == $item->id)) or (old('id_jabatan') == $item->id))
							<option value="{{ $item->id }}" selected>{{ $item->name }}</option>
						@else
							<option value="{{ $item->id }}">{{ $item->name }}</option>
						@endif
					@endforeach
				</select>
            </div>
		</div>

		<div class='box-footer'>
			<button type=submit class='btn btn-primary'>Simpan</button>
		</div>
		</form>
	</div>
</div>

@endsection

