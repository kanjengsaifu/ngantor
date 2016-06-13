<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    protected $table = 'ms_masuk';

	/**
	 * relasi data
	 */
	function sifat()
	{
		return $this->belongsTo('App\Models\Surat\Sifat', 'id_sifat', 'id');
	}
}
