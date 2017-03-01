<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller {

  /**
   * Show users list.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    return view('users.index');
  }
}
