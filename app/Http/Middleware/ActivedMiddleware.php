<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActivedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        dd(auth()->user()->status);

         try {


            if (auth()->user()->status != 1 )
      {
           \Auth::logout();
           \Alert::alert('¡Tu cuenta está desactivada!', 'Por favor, contacta a tu proveedor.', 'error');
          return redirect()->to('/login');
      }
      else
      {
          return $next($request);

       }

      } catch (\Exception $e) {

          \Alert::alert('¡Sesión finalizada!', 'Por favor, Ingresa nuevamente.', 'info');
          return redirect('/login');
      }
    }
}
