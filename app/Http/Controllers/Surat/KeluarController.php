<?php

namespace App\Http\Controllers\Surat;

use Illuminate\Http\Request;

use App\Models\Surat\Keluar;

class KeluarController extends Controller
{

	function index(Request $request)
	{
		$data = new Keluar();
		if ($request->has('cari')) {
			$c = $request->input('cari');
			$data = Keluar::where('perihal', 'LIKE', "%$c%");
		}

		return view('surat.keluar.index', [
			'row_number' => 1,
			'data' => $data->orderBy('created_at', 'DESC')->get(),
			'cari' => $request->input('cari'),
		]);
	}
}