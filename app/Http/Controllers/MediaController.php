<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller {

	/**
	 * Show media library.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('media.index');
	}
}
