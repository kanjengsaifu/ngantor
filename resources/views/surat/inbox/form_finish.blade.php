@extends('layouts.gui')

@section('title')
Kotak Surat
<small>Formulir</small>
@endsection


@section('content')

<div class='row'>
<div class='col-sm-6'>
	<div class='box box-primary'>
		<div class='box-header'>
			<h3 class='box-title'>Eksekusi Akhir</h3>
		</div>
		<form method=post action="{{ url('surat/inbox/save_finish') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="id" value="{{ $data->id }}">
		<div class='box-body'>
			<div class="form-group">
				<label>Nomor</label>
				<p>{{ $data->nomor }}</p>
			</div>


			<div class="form-group">
				<label>Asal</label>
				<p>{{ $data->asal }}</p>
			</div>


			<div class="form-group">
				<label>Perihal</label>
				<p>{{ $data->perihal }}</p>
			</div>

			@if ($errors->has('id_status'))
			<div class="form-group has-warning">
			@else
			<div class="form-group">
			@endif
				<label>Status</label>
				@if ($errors->has('id_status')) <em class="text-muted">{{ $errors->first('id_status') }}</em>@endif
				<select class="form-control" name=id_status>
					<option value=''>- Pilih -</option>
					@foreach($status as $item)
						@if (((isset($data->id_status) && $data->id_status == $item->id)) or (old('id_status') == $item->id))
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

