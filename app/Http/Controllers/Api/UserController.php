<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

  public function delete(Request $request) {
    return response()->json($request->all());
  }

}
