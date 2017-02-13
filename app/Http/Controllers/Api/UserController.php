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
      return response()->json($validator->errors()->first('id'), 403);
    }

    User::destroy($request->get('id'));

    return response()->json(null, 204);
  }

}
