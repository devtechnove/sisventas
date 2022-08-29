<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class VerifiedMiddleware
{
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|null
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {

        //dd ($request->user()->email_verified_at == null );

        if ($request->user()->email_verified_at == null) {
            return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
        }

        return $next($request);
    }
}
