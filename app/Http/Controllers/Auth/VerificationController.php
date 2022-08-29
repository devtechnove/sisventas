<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Modules\Empresa\Entities\Empresa;
class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

     /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {

         $user = \Auth::user();
         $user->status = 1;
         $user->email_verified_at = date('Y-m-d H:i:s');
         $user->save();

         $empresa = Empresa::find($user->empresa_id);
         $empresa->is_active = 1;
         $empresa->save();


        $cuenta = new \Modules\Cuentas\Entities\Cuentas();
        $cuenta->nb_nombre = 'Banco de Venezuela';
        $cuenta->fe_apertura = date('Y-m-d');
        $cuenta->nu_cuenta = '0102-0000-00-00000-00000';
        $cuenta->moneda_id = 1 ;
        $cuenta->saldo_apertura = 25000;
        $cuenta->saldo_actual = 25000;
        $cuenta->tx_nota ='Cuenta corriente' ;
        $cuenta->is_active = 1 ;
        $cuenta->empresa_id = $empresa->id;
        $cuenta->save();




        if (! hash_equals((string) $request->route('id'), (string) $request->user()->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($request->user()->getEmailForVerification()))) {
            throw new AuthorizationException;
        }



        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                        ? new JsonResponse([], 204)
                        : redirect($this->redirectPath());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        if ($response = $this->verified($request)) {

            return $response;
        }



        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect($this->redirectPath())->with('verified', true);
    }
}
