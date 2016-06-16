@extends('layouts.gui')

@section('title')
Surat Keluar
<small>Formulir</small>
@endsection


@section('content')

<div class='row'>
<div class='col-sm-6'>
	<div class='box box-primary'>
		<div class='box-header'>
			<h3 class='box-title'>{{ (isset($data->id) or !empty(old('id'))) ? 'Ubah' : 'Tambah' }}</h3>
		</div>
		<form method=post action="{{ url('surat/keluar/save') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="id" value="{{ $data->id or old('id') }}">
		<div class='box-body'>
			@if ($errors->has('nomor'))
			<div class="form-group has-warning">
			@else
			<div class="form-group">
			@endif
				<label>Nomor</label>
				@if ($errors->has('nomor')) <em class="text-muted">{{ $errors->first('nomor') }}</em>@endif
				<input type=text name='nomor' class='form-control' value="{{ $data->nomor or old('nomor') }}">
			</div>

			@if ($errors->has('tgl'))
			<div class="form-group has-warning">
			@else
			<div class="form-group">
			@endif
				<label>Tanggal</label>
				@if ($errors->has('tgl')) <em class="text-muted">{{ $errors->first('tgl') }}</em>@endif
				<input type="text" name=tgl class="form-control" value="{{ $data->tgl or old('tgl') }}">
            </div>

			@if ($errors->has('id_sifat'))
			<div class="form-group has-warning">
			@else
			<div class="form-group">
			@endif
				<label>Sifat</label>
				@if ($errors->has('id_sifat')) <em class="text-muted">{{ $errors->first('id_sifat') }}</em>@endif
				<select class="form-control" name=id_sifat>
					<option value=''>- Pilih -</option>
					@foreach($sifat as $item)
						@if (((isset($data->id_sifat) && $data->id_sifat == $item->id)) or (old('id_sifat') == $item->id))
							<option value="{{ $item->id }}" selected>{{ $item->name }}</option>
						@else
							<option value="{{ $item->id }}">{{ $item->name }}</option>
						@endif
					@endforeach
				</select>
            </div>

			@if ($errors->has('perihal'))
			<div class="form-group has-warning">
			@else
			<div class="form-group">
			@endif
				<label>Perihal</label>
				@if ($errors->has('perihal')) <em class="text-muted">{{ $errors->first('perihal') }}</em>@endif
				<input type=text name='perihal' class='form-control' value="{{ $data->perihal or old('perihal') }}">
			</div>
		</div>

		<div class='box-footer'>
			<button type=submit class='btn btn-primary'>Simpan</button>
		</div>
		</form>
	</div>
</div>

@endsection


@section('script')
<script languange='javascript'>
$(function () {
	$("input[name=tgl]").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
});
</script>
@endsection

