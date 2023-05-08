<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class AuthController extends Controller{

    // Xử lí đăng ký
    public function register(){
        return view('Auth.register');
    }

    public function Registration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data, $request);

        return redirect("register")->with('success', 'Sign Up Success');
    }

    public function create(array $data, Request $request)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

        ]);
    }
    // Xử lí đăng nhập
    public function login(){
        return view('Auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('index')
                ->withSuccess('Signed in');
        }
        return redirect("login")->withSuccess('Login details are not valid');
    }
       //trang index (trang chu)
       public function index(){
        return view('index');
    }


    //logout
    public function logOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('index');
    }
  

}