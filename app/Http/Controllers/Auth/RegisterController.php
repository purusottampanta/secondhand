<?php

namespace App\Http\Controllers\Auth;

// use App\User;
use App\Events\Auth\EmailConfirmed;
use App\Repositories\Eloquent\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRegisterRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $userRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('guest');
        $this->userRepo = $userRepo;
    }

    /**
     * registers user to the system
     * @param  App\Http\Requests\UserRegisterRequest
     * @return mixed
     */     
    public function register(UserRegisterRequest $request)
    {
        $user = $this->userRepo->registerUser($request->all(), $confirmation_code = str_random(30));

        return redirect('login')->withStatus('A confirmation message has been sent. Please check your email.');
    }

    /**
     * this method accepts the confirmation code from link and confirms the user
     * @param  string $confirmation_code 
     * @return mixed                    [description]
     */         
    public function getConfirm($confirmation_code)
    {
        if($confirmation_code){
            $user = $this->userRepo->confirm($confirmation_code);

            event(new EmailConfirmed($user));

            return redirect('login')->with('status', 'Email address has been verified.');
        }

        throw new NotFoundHttpException();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => bcrypt($data['password']),
    //     ]);
    // }
}
