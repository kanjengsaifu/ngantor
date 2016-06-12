<?php

namespace App\Http\Controllers\Me;

use Auth;
use Hash;
use Illuminate\Http\Request;
use Validator;


class ChPwdController extends Controller
{
	function index()
	{
		return view('me.pwd');
	}

	function save(Request $request)
	{
		//validasi lo hihilawo, ja pongatawa to Model User
		$valid = Validator::make($request->all(), [
			'pwd_old' => 'required',
			'pwd_new' => 'required|min:6'
		], [
			'pwd_old.required' => 'Masukkan password lama',
			'pwd_new.required' => 'Masukkan password baru',
			'pwd_new.min' => 'Password baru minimal 6 karakter',
		]);


		if ($valid->fails()) {
			return redirect()->back()->withErrors($valid->errors())->withInput();

		} else {
			if (Auth::validate([
					'email' => Auth::user()->email,
					'password' => $request->input('pwd_old')
				])) {

				try {
					$u = Auth::user();
					$u->password = Hash::make($request->input('pwd_new'));
					$u->save();

					return redirect('me/pwd')->with('message', 'Password telah berhasil diganti. Ingat terus password baru Anda.');

				} catch (\Exception $ex) {

				}

			} else {
				/**
				 * buat kesalahan validasi secara manual
				 */
				$valid->getMessageBag()->add('pwd_old', 'Password lama tidak dikenal');
				return redirect('me/pwd')->withErrors($valid->errors());
			}
		}


		return redirect()->intended('me/pwd');
	}

}
