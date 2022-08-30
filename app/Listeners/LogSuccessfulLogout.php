<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Login;




class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @return voi d
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {

       try {

         $token = Login::where('user_id', \Auth::user()->id)->get();
         $lastToken = $token->last();


        $login = $event->user->logins()->where('session_token', $lastToken->session_token)->first();

         if ($login)
        {
            $login->logout_at = \Carbon\Carbon::now();
            $login->save();

            \Alert::alert('¡Vuelve pronto!', 'Su sesión ha finalizado satisfactoriamente.', 'success');
        }

       } catch (\Exception $e) {
        //dd($e);
          \Alert::alert('¡Uuups!', 'Error interno con el token, ingresa nuevamente.', 'error');
           return redirect('/login');
       }

        
    }
}
