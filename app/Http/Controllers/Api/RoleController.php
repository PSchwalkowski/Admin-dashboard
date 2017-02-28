<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;

use App\Models\Role;

class RoleController extends Controller {

  /**
   * Get all roles
   * @method getAll
   * @return Illuminate\Http\Response
   */
  public function getAll() {
    return response()->json(Role::get());
  }

	/**
	 * Create role
	 * @param  Request $request
   * @return Illuminate\Http\Response
	 */
	public function create(Request $request) {
		$validator = Validator::make($request->all(), [
      'name' => 'required|unique:roles,name',
    ]);

		if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }

		$Role = Role::create([
			'name' => $request->get('name'),
			'display_name' => $request->get('display_name'),
			'description' => $request->get('description'),
		]);

		return response()->json($Role, 201);
	}

}
