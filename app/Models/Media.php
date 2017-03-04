<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {

	protected $table = 'media';

	/**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'path', 'title', 'alt', 'mime_type'
  ];
}
