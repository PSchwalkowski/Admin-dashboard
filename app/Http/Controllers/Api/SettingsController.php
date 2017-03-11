<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use App\Models\Settings;

class SettingsController extends Controller {

	/**
   * Get all roles
   * @method getAll
   * @return Illuminate\Http\Response
   */
  public function getAll() {
    return response()->json(Settings::get());
  }

	/**
	 * Edit file meta
	 * @param  Request $request
	 * @return Illuminate\Http\Response
	 */
	public function edit(Request $request) {
		$validator = Validator::make($request->all(), [
			'title' => 'required'
		]);

		if ($validator->fails()) {
      return response()->json($validator->errors(), 409);
    }

		Settings::where('name', 'title')->update([
			'value' => $request->get('title')
		]);

		return response()->json(Settings::get(), 200);
	}
}
