<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
class IsAdmin
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
        if (Auth::user() &&  Auth::user()->admin == 1) {
            return $next($request);
        }
        Session::flash('alert-class', 'alert-danger');
        Session::flash('message', 'У вас нет прав доступа!');
        return redirect('/');
    }
}
