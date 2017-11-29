<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;

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
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate(true); //<-- pass a boolean true to regenerate function.

        return redirect('/');
    }

    public function authenticated(Request $request, $user){
        //dd($user->id);
        
        Session::put('user_id', $user->id);

        $files = array_diff(scandir(storage_path('framework/sessions')), array('.', '..', '.gitignore'));

        foreach ($files as $file) {
            $filepath = storage_path('framework/sessions/' . $file);
            $session = unserialize(file_get_contents($filepath));
            //dd($session);
            if(isset($session['user_id'])){
                if ($session['user_id'] === $user->id && $session['_token'] !== Session::get('_token')) {
                unlink($filepath);
                }    
            }
            
        }

        return redirect()->intended($this->redirectPath());
    }
}
