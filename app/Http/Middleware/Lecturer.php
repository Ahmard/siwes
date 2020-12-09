<?php

namespace App\Http\Middleware;

use App\Helpers\Core\Alert;
use Closure;
use Illuminate\Http\Request;

class Lecturer
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
        if (auth()->check() && auth()->user()->isLecturer()){
            return $next($request);
        }

        return Alert::create()
            ->alert()
            ->warning('You dont have permission to view this resource 😜')
            ->redirect()
            ->route('home');
    }
}
