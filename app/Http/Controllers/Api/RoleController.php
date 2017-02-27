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
	
}
