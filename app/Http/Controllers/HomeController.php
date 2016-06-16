<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Surat\Masuk;
use App\Models\Surat\Keluar;

class HomeController extends Controller
{
	function index()
	{
		return view('home', [
				'pegawai_count' => User::count(),
				'ms_inbox_count' => Masuk::MyInbox()->count(),
				'ms_masuk_count' => Masuk::count(),
				'ms_keluar_count' => Keluar::count(),
			]);
	}
}
