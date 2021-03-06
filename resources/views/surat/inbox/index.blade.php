@extends('layouts.gui')

@section('title')
Surat
<small>Kotak Surat</small>
@endsection


@section('content')

<div class='box'>
	<div class='box-header'>
		<div class='row'>
			<div class='col-sm-6'>
				<form method=post action="{{ url('surat/inbox') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type=text name=cari class='form-control input-sm inline' value="{{ $cari or '' }}" placeholder='Search'>
				</form>
			</div>
			<div class='col-sm-6 text-right'>
				<a class='btn btn-sm btn-primary' href="{{ url('surat/masuk/form') }}"><i class='fa fa-plus'></i> Tambah</a>
			</div>
		</div>
	</div>
	<div class='box-body'>
		<table class='table table-bordered table-striped'>
		<thead>
		<tr>
			<th>NOMOR</th>
			<th>SIFAT</th>
			<th>ASAL</th>
			<th>PERIHAL</th>
			<th>POSISI</th>
			<th>STATUS</th>
			<th></th>
		</tr>
		</thead>
		@forelse($data as $item)
		<tr>
			<td>{{ $item->nomor }}</td>
			<td>{{ $item->sifat->name }}</td>
			<td>{{ $item->asal }}</td>
			<td>{{ $item->perihal }}</td>
			<td>{{ $item->user->name }}</td>
			<td>
				@if ($item->status->type == 1)
					<label class='label label-primary'>{{ $item->status->name }}</label>
				@elseif ($item->status->type == 2)
					<label class='label label-success'>{{ $item->status->name }}</label>
				@else
					<label class='label label-info'>{{ $item->status->name }}</label>
				@endif
			</td>
			<td>
				<a class='btn btn-xs btn-default' href='{{ url("surat/inbox/form/0/$item->id") }}' title='Teruskan'><i class='fa fa-envelope'></i></a>
				<a class='btn btn-xs btn-danger' href='{{ url("surat/inbox/form/2/$item->id") }}' title='Eksekusi Akhir'><i class='fa fa-envelope'></i></a>
			</td>
		</tr>
		@empty
		<tr><td colspan='7'>Masih kosong</td></tr>
		@endforelse
		</table>
	</div>
</div>

@endsection

