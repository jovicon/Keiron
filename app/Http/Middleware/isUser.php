<?php

namespace App\Http\Middleware;

use Closure;

class isUser
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
        if ($request->user()->user_type_id == 1) {
            return redirect('/admin');
        }

        return $next($request);
    }
}
