<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Companie;
use App\Models\Employee;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Hash;

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
    // overrode function logout
    use AuthenticatesUsers {
        logout as performLogout;
    }

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
        // This will check if user is authenticated
        
        $this->middleware('guest')->except('logout');
        $this->employee = new Employee;
    }
    public function login(Request $request)
    {
        // Check validation - Note : you can change validation as per your requirements 
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $companie = Companie::select('id', 'name');
        $companie = $companie->where('name', $request->companyname)->first();

        // Check Condition company No. Found or Not
        if (empty($companie)) {
            $errors = [ 'companyerror' => 'Company Not Found!'];
            return back()->withErrors($errors);
        }

        // Get user record
        $employee = Employee::with(['companie' => function ($query) {
            $query->select(['id', 'name']);
        }]);
        $employee = $employee->select('id', 'first_name', 'last_name', 'email', 'phone', 'companie_id', 'password', 'created_at', 'updated_at');
        $employee = $employee->where('email', $request->get('email'))->where('companie_id', $companie->id)->first();



        // Check Condition user No. Found or Not
        if (empty($employee)) {
            $errors = ['email' => 'Invalid Email!'];
            return back()->withErrors($errors);
        }

        
        // Check Condition password does not match with hash password or invalid password
        if (!Hash::check($request->get('password'), $employee->password)) {
            $errors = ['password' => 'Invalid Password!'];
            return back()->withErrors($errors);
        }

        // Set Auth Details
        Auth::login($employee);

        // Redirect home page and save company name to sessions
        Session::put('companyname', $employee->companie->name);
        return redirect()->route('company', $employee->companie->name);
    }
    // logout functin overrode
    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->route('default');
    }
}
