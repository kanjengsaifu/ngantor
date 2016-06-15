<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    protected $table = 'ms_masuk';


	protected $validator;

	protected static $valid_message = [
			'nomor.required' => 'Masukkan nomor surat',
			'nomor.unique' => 'Nomor surat sudah ada',
			'id_sifat.required' => 'Pilih sifat surat',
			'asal.required' => 'Masukkan asal surat',
			'perihal.required' => 'Masukkan perihal surat',
			'id_status.required' => 'Pilih status surat',
			'id_user.required' => 'Pilih tujuan surat',
		];


	protected $valid_errors;


	public function __construct(array $attributes = array())
	{
		parent::__construct($attributes);

		$this->validator = \App::make('validator');
	}

	/**
     * Listen for save event
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            return $model->validate();
        });
    }


	public function validate()
	{
		$v = $this->validator->make($this->attributes, $this->validRules(), static::$valid_message);
		if ($v->fails()) {
			$this->setErrors($v->errors());
			return FALSE;
		}

		return TRUE;
	}


	public function validRules()
	{
		return [
			'nomor' => 'required|unique:ms_masuk'. ($this->id ? ",id,$this->id" : ''),
			'id_sifat' => 'required',
			'asal' => 'required',
			'perihal' => 'required',
			'id_status' => 'required',
			'id_user' => 'required',
		];
	}


	protected function setErrors($errors)
    {
        $this->valid_errors = $errors;
    }


	public function getErrors()
    {
        return $this->valid_errors;
    }


	public function hasErrors()
    {
        return ! empty($this->valid_errors);
    }


	/**
	 * relasi data
	 */
	function sifat()
	{
		return $this->belongsTo('App\Models\Surat\Sifat', 'id_sifat', 'id');
	}

	function status()
	{
		return $this->belongsTo('App\Models\Surat\Status', 'id_status', 'id');
	}

	function user()
	{
		return $this->belongsTo('App\Models\User', 'id_user', 'id');
	}
}
