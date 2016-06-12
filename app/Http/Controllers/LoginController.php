<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{
	function index(Guard $auth)
	{
		if ( ! $auth->guest()) {
			return redirect()->intended('home');
		}

		return view('login');
	}

	function login(Request $request)
	{
		$valid = Validator::make($request->all(), [
			'email' => 'required',
			'pwd' => 'required'
		], [
			'email.required' => 'Email jangan dikosongkan',
			'pwd.required' => 'Password jangan dikosongkan',
		]);


		if ($valid->fails()) {
			return redirect()->back()->withErrors($valid->errors())->withInput();

		} else {
			if (Auth::attempt([
					'email' => $request->input('email'),
					'password' => $request->input('pwd')
				])) {
				return redirect()->intended('home');

			} else {
				//buat kesalahan validasi secara manual
				$valid->getMessageBag()->add('pwd', 'Akses ditolak');
				return redirect('login')->withErrors($valid->errors())->withInput();
			}
		}
	}
}