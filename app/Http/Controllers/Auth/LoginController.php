<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Events\Auth\UserRegistered;
use App\Repositories\Eloquent\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/';

    protected $userRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('guest')->except('logout');
        $this->userRepo = $userRepo;
    }

    /**
     * what happens after the user is authenticated
     * @param  Request $request 
     * @param  mixed  $user    
     * @return mixed           
     */
    protected function authenticated(Request $request, $user)
    {
        if(!$user->confirmed){

            $request->session()->put('user_id', $user->id);
            $this->guard()->logout();

            return redirect('/login')->with('error', 'You must verify your email address before access.
            <br> If you have not received the confirmation email check your spam folder.
            <br>To get a new confirmation email please <a href="' . url('auth/resend') . '" class="alert-link">click here</a>.');
        }

        if($user->is_admin){
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->intended('/');
    }

    /**
     * resend the user activation(email vaerification) link
     * @param  Request $request 
     * @return mixed           
     */
    public function getResend(Request $request)
    {
        if($request->session()->get('user_id')){
            $user = $this->userRepo->getNew();
            $user = $user->findOrFail($request->session()->get('user_id'));

            if(empty($user->confirmation_code)){
                $user->update(['confirmation_code' => str_random(30)]);
            }

            event(new UserRegistered($user));

            return redirect('login')->with('status', 'A confirmation E-mail has been sent. Please check your email.');
        }

        return redirect('login')->with('error', 'Sorry! Session was not set.');
    }
}
