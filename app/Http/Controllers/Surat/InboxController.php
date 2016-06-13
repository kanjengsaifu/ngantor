<?php

namespace App\Http\Controllers\Surat;

use Hash;
use Illuminate\Http\Request;

use App\Models\Surat\Masuk;

class InboxController extends Controller
{

	function index(Request $request)
	{
		if ($request->has('cari')) {
			$c = $request->input('cari');
			$data = Masuk::where('perihal', 'LIKE', "%$c%")->get();
		} else {
			$data = Masuk::get();
		}

		return view('surat.index', [
			'row_number' => 1,
			'data' => $data,
			'cari' => $request->input('cari'),
		]);
	}
}
