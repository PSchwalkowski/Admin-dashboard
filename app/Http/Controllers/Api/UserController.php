<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;

use App\Models\User;

class UserController extends Controller {

  /**
   * Get all uses
   * @method getAll
   * @return Illuminate\Http\Response
   */
  public function getAll() {
    return response()->json(User::get());
  }

	public function create(Request $request) {
		$validator = Validator::make($request->all(), [
      'name' => 'required|unique:users,name',
      'email' => 'required|unique:users,email',
			'password' => 'required|min:8'
    ]);

		if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }

		$User = User::create([
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'password' => $request->get('password'),
		]);

		return response()->json($User, 201);
	}

	public function edit(Request $request) {
		$validator = Validator::make($request->all(), [
      'id' => 'required|exists:users,id',
	    'name' => 'required|unique:users,name,' . $request->get('id'),
      'email' => 'required|unique:users,email,' . $request->get('id'),
			'password' => 'min:8'
    ], [
			'exists' => 'User with given id not exists'
		]);

		if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }

		$User = User::find($request->get('id'))->fill([
			'name' => $request->get('name'),
			'email' => $request->get('email')
		]);

		$User->save();

		if ($request->has('password')) {
			$User->password = bcrypt($request->get('password'));
		}

		return response()->json($User, 200);
	}

  /**
   * Delete user
   * @method delete
   * @param  Request $request [description]
   * @return Illuminate\Http\Response
   */
  public function delete(Request $request) {
    $validator = Validator::make($request->all(), [
      'id' => 'required|exists:users'
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors()->first('id'), 400);
    }

    User::destroy($request->get('id'));

    return response()->json(null, 204);
  }

}
