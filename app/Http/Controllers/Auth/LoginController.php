<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that 
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        if(isset($_REQUEST['error_code']) and $_REQUEST['error_code'] !=""){
            return redirect($this->redirectTo);
        }
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        if ($user->getEmail() != '') {
            $authUser = User::where('email', 'like', $user->getEmail())->first();
            if ($authUser) {
                /* $authUser->provider = $provider;
                $authUser->provider_id = $user->getId();
                $authUser->update(); */
                return $authUser;
            }
        }
        $str = $user->getEmail();
        $newUser = new User();
        $newUser->first_name = $user->getName();
        $newUser->last_name = $user->getName();
        $newUser->name = $user->getName();
        $newUser->email = $user->getEmail();
        $newUser->provider = $provider;
        $newUser->provider_id = $user->getId();
        $newUser->password = bcrypt($str);
        $newUser->is_active = 1;
        $newUser->verified = 1;
        $newUser->current_status = 'pending_for_user_confirmation';
        $newUser->email_verified_at = date("Y-m-d h-i-s");
        $newUser->save();

        $authUser = User::where('email', 'like', $newUser->email)->first();
        if ($authUser) {
            return $authUser;
        }
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // Check if user is active
        $user = User::where('email', $request->email)->first();

        if ($user && !$user->is_active && $user->is_accept_terms==1 && $user->user_type!='sub_account') {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect()->route('login');
        }elseif ($user && !$user->is_active && $user->is_accept_terms==1 && $user->user_type=='sub_account') {
            flash(__('Please contact your Account Administrator'))->error();
            return redirect()->route('login');
        }elseif ($user && $user->is_active && $user->is_accept_terms==1 && $user->user_type=='sub_account') {
            $parentUser= User::find($user->parent_id);
            if($parentUser&&!$parentUser->is_active){
                flash(__('Please contact your Account Administrator'))->error();
                return redirect()->route('login');
            }
        }elseif ($user && !$user->is_active && $user->is_accept_terms!=1){
            $user->delete();
//            return redirect()->route('login');
        }elseif ($user && $user->is_active && $user->is_accept_terms==1 && $user->package_id==0 && $user->user_type=='employer'){
            return redirect()->route('employer_packages_list', ['id'=>$user->id]);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Send the response after the user was authenticated.
     * Remove the other sessions of this user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $previous_session = Auth::User()->session_id;
        if ($previous_session) {
            Session::getHandler()->destroy($previous_session);
        }

        Auth::user()->session_id = Session::getId();
        Auth::user()->save();
        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }
}
