<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'identifier';
    }

    protected function credentials(Request $request)
    {
        $login = $request->input($this->username());

        /**
         * Comprobamos si el campo de identificador tiene formato de e-mail.
         * Si no lo tiene, comprobaremos las credenciales contra el campo
         * de login (user, o username, o como lo hayamos llamado
         * en la base de datos) y la contraseña.
         * Si el campo de identificador tiene formato de email,
         * comprobaremos las credenciales contra el campo email
         * (poniéndole aquí el nombre con el que dicho campo está
         * en la base de datos).
         */
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        return [
            $field => $login,
            'password' => $request->input('password')
        ];
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            session()->put('locale', auth()->user()->language);
            App::setLocale(auth()->user()->language);
            $scope = auth()->user()->scope;
            $this->redirectTo = ($scope == 'M') ? 'master/index' : (($scope == 'A') ? 'admin/index' : 'user/index');
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
