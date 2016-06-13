<?php

namespace App\Http\Controllers\Surat;

use Auth;
use Hash;
use Illuminate\Http\Request;

use App\Models\Surat\Sifat;
use App\Models\Surat\Status;
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


	function form($id=null)
	{
		return view('surat.form', [
			'data' => Masuk::find($id),
			'sifat' => Sifat::all(),
		]);
	}


	function save(Request $request)
	{
		try {
			if ($request->has('id')) {
				$u = Masuk::find( $request->input('id') );

			} else {
				$u = new Masuk;
			}
			$u->nomor = $request->input('nomor');
			$u->id_sifat = $request->input('id_sifat');
			$u->asal = $request->input('asal');
			$u->perihal = $request->input('perihal');
			$u->id_status = Status::where('type', '=', '1')->firstOrFail()->id;
			$u->id_user = Auth::User()->id;
			$u->save();

			if ($u->hasErrors()) {
				return redirect('surat/inbox/form')->withErrors($u->getErrors())->withInput();
			}

		} catch (\Exception $ex) {
			return redirect('surat/inbox/form')->with('error', $ex->getMessage());
		}

		return redirect()->intended('surat/inbox');
	}

}
