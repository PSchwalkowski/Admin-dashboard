<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use App\Models\Media;

class MediaController extends Controller {

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
      return response()->json($validator->errors(), 422);
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

}
