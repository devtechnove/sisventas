<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Login as LoginModel;
use Stevebauman\Location\Facades\Location;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
       //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        //dd($_SERVER['REMOTE_ADDR']);

        $yourUserIpAddress = /*$_SERVER['HTTP_X_FORWARDED_FOR']*/ '66.102.0.0';
        $location = Location::get($yourUserIpAddress);
        $login = $login = new LoginModel;
        $login->user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $login->user_location = $location->countryName  . '('.$location->countryCode.')';
        $login->session_token = session('_token');
        $login->ip_address = $_SERVER['REMOTE_ADDR'];
        $login->login_at = \Carbon\Carbon::now();

        $event->user->logins()->save($login);

    }
}
