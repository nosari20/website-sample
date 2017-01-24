<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class ClientAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller For Client
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Login methode
     *
     * @var string
     */
    protected $username = 'name';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/espace-client';

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectAfterRegister = '/admin/client';

    /**
     * Login view
     *
     * @var string
     */
    protected $loginView = 'client.auth.login';

    /**
     * Registration view
     *
     * @var string
     */
    protected $registerView = 'client.auth.register';

    
    


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['only' => ['getLogin','postLogin']]);
        $this->middleware($this->authMiddleware(), ['only' => ['getRegister', 'postRegister','register']]);
        $this->middleware($this->authClientMiddleware(), ['only' => ['getLogout']]);
    }

    /**
     * Get the auth middleware for the application.
     */
    public function authMiddleware()
    {
        return 'auth';
    }
    /**
     * Get the auth middleware for the application.
     */
    public function authClientMiddleware()
    {
        return 'auth.client';
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|alpha_dash|unique:users',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'user',
        ]);
    }




    /**
     * Get the post register  redirect path.
     *
     * @return string
     */
    public function redirectPathRegister($id)
    {
        return property_exists($this, 'redirectAfterRegister') ? $this->redirectAfterRegister.'/'.$id : '/admin';
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        return $this->register($request);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $user = $this->create($request->all());
        return redirect($this->redirectPathRegister($user->id));
    }
}
