<?php

namespace App\Http\Middleware;

use Closure;

class roleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(! $request->user()->hasRole($role))
        {
            return redirect('unauthorized');
			//abort(404, 'You can\'t do that.'); //it's kind of an obvious lie anyway
        }
        return $next($request);
    }
}
