<?php

namespace App\Http\Controllers\Surat;

use Auth;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Surat\Status;
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


	function form($type, $id)
	{
		//forward
		if ($type == 0) {
			return view('surat.inbox.form_forward', [
				'data' => Masuk::find($id),
				'status' => Status::where('type', '=', 0)->orderBy('name')->get(),
				'users' => User::where('id', '!=', Auth::User()->id)->orderBy('name')->get(),
			]);
		}

		return view('surat.inbox.form_finish', [
				'data' => Masuk::find($id),
				'status' => Status::where('type', '=', 2)->orderBy('name')->get(),
			]);
	}


	function save_forward(Request $request)
	{
		try {
			$id = $request->input('id');
			$u = Masuk::find( $id );
			$u->id_status = $request->input('id_status');
			$u->id_user = $request->input('id_user');
			$u->save();

			if ($u->hasErrors()) {
				return redirect("surat/inbox/form/0/$id")->withErrors($u->getErrors())->withInput();
			}

		} catch (\Exception $ex) {
			return redirect("surat/inbox/form/0/$id")->with('error', $ex->getMessage());
		}

		return redirect()->intended('surat/inbox');
	}

}
