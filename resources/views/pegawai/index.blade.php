@extends('layouts.gui')

@section('title')
Pegawai
@endsection


@section('content')

<div class='box'>
	<div class='box-header'>
		<div class='row'>
			<div class='col-sm-6'>
				<form method=post action="{{ url('pegawai') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type=text name=cari class='form-control input-sm inline' value="{{ $cari or '' }}" placeholder='Search'>
				</form>
			</div>
			<div class='col-sm-6 text-right'>
				<a class='btn btn-sm btn-primary' href="{{ url('pegawai/form') }}"><i class='fa fa-plus'></i> Tambah</a>
			</div>
		</div>
	</div>
	<div class='box-body'>
		<table class='table table-bordered table-striped'>
		<thead>
		<tr>
			<th>NO</th>
			<th>NAMA LENGKAP</th>
			<th>EMAIL</th>
			<th>DIVISI</th>
			<th>JABATAN</th>
			<th></th>
		</tr>
		</thead>
		@forelse($data as $item)
		<tr>
			<td>{{ $row_number++ }}</td>
			<td>{{ $item->name }}</td>
			<td>{{ $item->email }}</td>
			<td>{{ isset($item->divisi) ? $item->divisi->name : '-'  }}</td>
			<td>{{ $item->jabatan->name }}</td>
			<td>
				<a class='btn btn-xs btn-default' href='{{ url("pegawai/form/$item->id") }}' title=Ubah><i class='fa fa-pencil'></i></a>
				<a class='btn btn-xs btn-danger' href='{{ url("pegawai/delete/$item->id") }}' title=Hapus onClick="return confirm('Hapus?');"><i class='fa fa-trash-o'></i></a>
			</td>
		</tr>
		@empty
		<tr><td colspan='6'>Masih kosong</td></tr>
		@endforelse
		</table>
	</div>
</div>

@endsection

