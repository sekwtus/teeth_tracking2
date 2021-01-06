<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Employee;

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

    // use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        $field = $this->field($request);

        return [
            $field => $request->get($this->username()),
            'password' => $request->get('password'),
        ];
    }

    public function field(Request $request)
    {
        $email = $this->username();

        return filter_var($request->get($email), FILTER_VALIDATE_EMAIL) ? $email : 'username';
    }

    protected function validateLogin(Request $request)
    {
        $field = $this->field($request);
        $messages = ["{$this->username()}.exists" => 'The account you are trying to login is not registered or it has been disabled.'];
        $this->validate($request, [
            $this->username() => "required|exists:users,{$field}",
            'password' => 'required',
        ], $messages);
    }

    protected function authenticated($request, $user){
        $user_status = Employee::select('status')->where('ID_user',$user->id)->get();
        if($user_status[0]->status == 0){
            Auth::logout();
            return redirect('/')->withSuccess('ไม่อนุญาติให้ใช้งาน กรุณาติดต่อเจ้าหน้าที่');
        }
    }
}
