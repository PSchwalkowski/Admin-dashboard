<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiClient extends Model {

  protected $table = 'api_clients';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'email', 'token'
	];
}
