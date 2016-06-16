<?php

namespace App\Http\Controllers\Surat;

use Auth;
use Illuminate\Http\Request;

use App\Models\Surat\Sifat;
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


	function form($id=null)
	{
		return view('surat.keluar.form', [
			'data' => Keluar::find($id),
			'sifat' => Sifat::all(),
		]);
	}


	function save(Request $request)
	{
		try {
			if ($request->has('id')) {
				$u = Keluar::find( $request->input('id') );

			} else {
				$u = new Keluar;
			}
			$u->nomor = $request->input('nomor');
			$u->tgl = $request->input('tgl');
			$u->id_sifat = $request->input('id_sifat');
			$u->perihal = $request->input('perihal');
			$u->id_user = Auth::User()->id;
			$u->save();

			if ($u->hasErrors()) {
				return redirect('surat/keluar/form')->withErrors($u->getErrors())->withInput();
			}

		} catch (\Exception $ex) {
			return redirect('surat/keluar/form')->with('error', $ex->getMessage());
		}

		return redirect()->intended('surat/keluar');
	}


	function delete($id)
	{
		$del = Keluar::find($id);

		try {
			if ($del) {
				$del->delete();
			}

		} catch (\Exception $ex) {
		}

		return redirect()->intended('surat/keluar');
	}

}