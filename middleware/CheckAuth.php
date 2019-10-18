<?php namespace Api\Middleware;

use Closure;
use BackendAuth;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!BackendAuth::check()) {
            return response()->make('', 403);
        }

        return $next($request);
    }
}
