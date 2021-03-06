<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = 'divisi';


	protected $validator;

	protected static $valid_message = [
			'name.required' => 'Masukkan nama divisi',
			'name.unique' => 'Nama divisi sudah ada',
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
			'name' => 'required|unique:divisi'. ($this->id ? ",id,$this->id" : ''),
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
}
