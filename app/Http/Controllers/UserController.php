<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller {

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
   * Show users list.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    return view('users.index');
  }

  /**
   * Show create form.
   *
   * @return \Illuminate\Http\Response
   */
  public function getCreate() {
    return view('users.create');
  }

  /**
   * Process create form.
   *
   * @param Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function postCreate(Request $request) {
    $this->validate($request, [
      'name' => 'required|min:3|unique:users,name',
      'email' => 'required|email',
      'password' => 'required|min:8',
    ]);

    User::create([
      'name' => $request->get('name'),
      'email' => $request->get('email'),
      'password' => bcrypt($request->get('password')),
    ]);

    return redirect(url('users'));
  }
}
