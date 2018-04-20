<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller {

	public function list() {

		// TODO: fetch data and paginate table via vue.js component
		return view('users.list', ['users' => User::paginate(6)]);
	}
}
