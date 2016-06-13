<?php

namespace App\Http\Controllers\Pegawai;

use Hash;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Divisi;
use App\Models\Jabatan;


class PegawaiController extends Controller
{

	function index(Request $request)
	{
		if ($request->has('cari')) {
			$c = $request->input('cari');
			$data = User::where('name', 'LIKE', "%$c%")->get();
		} else {
			$data = User::get();
		}

		return view('pegawai.index', [
			'row_number' => 1,
			'data' => $data,
			'cari' => $request->input('cari'),
		]);
	}


	function form($id=null)
	{
		return view('pegawai.form', [
			'data' => User::find($id),
			'divisi' => Divisi::all(),
			'jabatan' => Jabatan::all(),
		]);
	}


	function save(Request $request)
	{
		try {
			if ($request->has('id')) {
				$u = User::find( $request->input('id') );
				if ($request->has('pwd')) {
					/**
					 * Hash::make bisa membuat validasi di Model User tidak akan bekerja dengan baik
					 * jadi harus buat kondisi tambahan dan picu kesalahan secara manual jika tidak sesuai dengan kondisi yang diinginkan
					 */
					if (strlen($request->input('pwd')) < 6) {
						$u->password = 'x'; //biar mo error min
					} else {
						$u->password = Hash::make($request->input('pwd'));
					}
				}

			} else {
				$u = new User;
				if ($request->has('pwd')) {
					if (strlen($request->input('pwd')) < 6) {
						$u->password = 'x'; //biar mo error min
					} else {
						$u->password = Hash::make($request->input('pwd'));
					}
				} else {
					$u->password = NULL; //biar mo error required
				}
			}
			$u->name = $request->input('name');
			$u->email = $request->input('email');
			if ($request->has('id_divisi')) {
				$u->id_divisi = $request->input('id_divisi');
			} else {
				$u->id_divisi = NULL;
			}
			$u->id_jabatan = $request->input('id_jabatan');
			$u->save();

			if ($u->hasErrors()) {
				return redirect('pegawai/form')->withErrors($u->getErrors())->withInput();
			}

		} catch (\Exception $ex) {
			return redirect('pegawai/form')->with('error', $ex->getMessage());
		}

		return redirect()->intended('pegawai');
	}


	function delete($id)
	{
		$del = User::find($id);

		try {
			if ($del) {
				$del->delete();
			}

		} catch (\Exception $ex) {
		}

		return redirect()->intended('pegawai');
	}

}
