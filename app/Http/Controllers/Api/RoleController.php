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
      return response()->json($validator->errors(), 422);
    }

		$Role = Role::create([
			'name' => $request->get('name'),
			'display_name' => $request->get('display_name'),
			'description' => $request->get('description'),
		]);

		return response()->json($Role, 201);
	}

	/**
	 * Edit role
	 * @param  Request $request
	 * @return Illuminate\Http\Response
	 */
	public function edit(Request $request) {
		$validator = Validator::make($request->all(), [
      'id' => 'required|exists:roles,id',
	    'name' => 'required|unique:roles,name,' . $request->get('id')
    ], [
			'exists' => 'Role with given id not exists'
		]);

		if ($validator->fails()) {
      return response()->json($validator->errors(), 422);
    }

		$Role = Role::find($request->get('id'))->fill([
			'name' => $request->get('name'),
			'display_name' => $request->get('display_name'),
			'description' => $request->get('description'),
		]);

		$Role->save();

		return response()->json($Role, 200);
	}


  /**
   * Delete role
   * @method delete
   * @param  Request $request
   * @return Illuminate\Http\Response
   */
  public function delete(Request $request) {
    $validator = Validator::make($request->all(), [
      'id' => 'required|exists:roles'
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors()->first('id'), 422);
    }

    Role::destroy($request->get('id'));

    return response()->json(null, 204);
  }

}
