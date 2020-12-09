<?php

namespace App\Http\Middleware;

use App\Helpers\Alert;
use App\Helpers\Core\AlertFactory;
use Closure;
use App\Helpers\Response;
use Illuminate\Http\Request;

class Concluder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $start = microtime(true);
        Alert::create()->alert()->success(microtime(true) - $start);
        $response = $next($request);
        (new AlertFactory())->pushFlashes();
        return $response;
    }
}
