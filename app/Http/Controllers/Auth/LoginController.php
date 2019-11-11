<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\MessageBag;
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
    protected $redirectTo = '/user/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout(Request $request) {
      Auth::logout();
      return redirect('/signin');
    }
    public function getSignin(Request $request)
    {
        return view('user.signin.index');
    }

    public function postSignin(Request $request)
    {
        $rules = [
            'email'=>'required|email',
             'password'=>'required'   
        ];
        $message = [
            'email.required'=>'Email không được bỏ trống!',
            'email.email'=>'Email không đúng định dạng!',
            'password.required'=>'Password không được bỏ trống!',
            //'password.min'=>'Mật khẩu phải trên 8 kí tự', 
        ];
        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            $email = $request->input('email');
            $password = $request->input('password');
            if(Auth::attempt(['email'=>$email,'password'=>$password]))
            {
                return redirect(route('user_relationship'));
            }
            else
            {
                $errors = new MessageBag(['errorSignin'=>'Email hoặc mật khẩu không đúng!']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
        }
    }
}
