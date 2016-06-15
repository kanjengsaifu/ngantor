<?php

namespace App\Http\Controllers\Surat;

use Auth;
use Illuminate\Http\Request;

use App\Models\Surat\Masuk;

class InboxController extends Controller
{

	function index(Request $request)
	{
		$data = Masuk::where('id_user', '=', Auth::User()->id);
		if ($request->has('cari')) {
			$c = $request->input('cari');
			$data = $data->where('perihal', 'LIKE', "%$c%");
		}

		return view('surat.inbox.index', [
			'row_number' => 1,
			'data' => $data->orderBy('created_at', 'DESC')->get(),
			'cari' => $request->input('cari'),
		]);
	}

}
