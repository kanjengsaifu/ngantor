<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	protected $validator;


	protected static $valid_message = [
			'name.required' => 'Masukkan nama lengkap',
			'email.required' => 'Masukkan alamat email',
			'email.email' => 'Alamat email tidak sesuai',
			'email.unique' => 'Alamat email sudah digunakan orang lain',
			'password.required' => 'Masukkan password',
			'password.min' => 'Password minimal 6 karakter',
			'id_jabatan.required' => 'Pilih jabatan',
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
		//tambahkan validasi sometimes
		$v->sometimes('password', 'required', function($input) {
			return empty($input->id);
		});
		if ($v->fails()) {
			$this->setErrors($v->errors());
			return FALSE;
		}

		return TRUE;
	}


	public function validRules()
	{
		return [
			'name' => 'required',
			'email' => 'required|email|unique:users'. ($this->id ? ",id,$this->id" : ''),
			'password' => 'sometimes|min:6',
			'id_jabatan' => 'required',
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
	function divisi()
	{
		// many2one
		return $this->belongsTo('App\Models\Divisi', 'id_divisi', 'id');
	}

	function jabatan()
	{
		// many2one
		return $this->belongsTo('App\Models\Jabatan', 'id_jabatan', 'id');
	}

}
