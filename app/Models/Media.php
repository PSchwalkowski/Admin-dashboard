<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model {

	/**
   * The table associated with the model.
   *
   * @var string
   */
	protected $table = 'media';

	/**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'path', 'title', 'alt', 'mime_type'
  ];

	protected $appends = ['url', 'type'];

	protected $filesTypes = [
		'audio',
		'image',
		'video',
		'document',
		'archive'
	];

	public function getUrlAttribute() {
		return asset('storage/' . $this->path);
	}

	public function getTypeAttribute() {
		$fileType = 'other';

		foreach ($this->filesTypes as $type) {
			if (strpos($this->mime_type, $type) !== false) {
				$fileType = $type;
			}
		}

		return $fileType;
	}
}
