<?php

namespace App\Http\Middleware;

use Validator;
use Closure;
use App\Models\ApiClient;

class Api {

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next) {
		$validator = Validator::make($request->header(), [
			'api-token' => 'required|exists:api_clients,token'
		]);

		if ($validator->fails()) {
      return response()->json($validator->errors(), 409);
    }

    return $next($request);
  }
}
