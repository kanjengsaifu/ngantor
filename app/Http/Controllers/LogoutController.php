<?php

namespace App\Http\Controllers;

use Auth;

class LogoutController extends Controller
{
	function index()
	{
		Auth::logout();

		return redirect()->intended('');
	}
}