<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function home() {
    return view('home');
  }

  /**
   * Show users view
   *
   * @return \Illuminate\Http\Response
   */
  public function users() {
    return view('users.index');
  }

  /**
   * Show roles view
   *
   * @return \Illuminate\Http\Response
   */
  public function roles() {
    return view('roles.index');
  }

  /**
   * Show media view
   *
   * @return \Illuminate\Http\Response
   */
  public function media() {
    return view('media.index');
  }

  /**
   * Show settings view
   *
   * @return \Illuminate\Http\Response
   */
  public function settings() {
    return view('settings.index');
  }
}
