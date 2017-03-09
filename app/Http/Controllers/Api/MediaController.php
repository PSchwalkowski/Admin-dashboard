<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use App\Models\Media;

class MediaController extends Controller {

	/**
   * Get all roles
   * @method getAll
   * @return Illuminate\Http\Response
   */
  public function getAll() {
    return response()->json(Media::get());
  }

	/**
	 * Create file
	 * @param  Request $request
	 * @return Illuminate\Http\Response
	 */
	public function create(Request $request) {
		$validator = Validator::make($request->all(), [
      'file' => 'required|file',
    ]);

		if ($validator->fails()) {
      return response()->json($validator->errors(), 409);
    }


		$filepath = $request->file->storePubliclyAs(
			'uploads',
			$request->file->getClientOriginalName()
		);

		$File = Media::create([
			'name' => $request->file->getClientOriginalName(),
			'path' => $filepath,
			'mime_type' => $request->file->getClientMimeType()
		]);

		return response()->json($File, 201);
	}

	/**
	 * Edit file meta
	 * @param  Request $request
	 * @return Illuminate\Http\Response
	 */
	public function edit(Request $request) {
		$validator = Validator::make($request->all(), [
			'id' => 'required|exists:media,id'
		]);

		if ($validator->fails()) {
      return response()->json($validator->errors(), 409);
    }

		$Media = Media::find($request->get('id'))->fill([
			'title' => $request->get('title'),
			'alt' => $request->get('alt'),
		]);

		$Media->save();

		return response()->json($Media, 200);
	}

}
