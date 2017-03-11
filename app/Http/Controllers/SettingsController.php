<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller {

  /**
   * Settings.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    return view('settings.index');
  }
}
