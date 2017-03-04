<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller {

  /**
   * Show roles list.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    return view('roles.index');
  }
}
