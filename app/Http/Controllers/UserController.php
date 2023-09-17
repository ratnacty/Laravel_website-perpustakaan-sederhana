<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index_login()
    {

        return view('User.login');

    }


    public function login_process(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $dataLogin = [
            'email' => $request->email ,
            'password' => $request->password,
            
           
        ];

        if(Auth::attempt($dataLogin)){

            $request->session()->regenerate();
            return redirect()->intended('/home')->with(['success' => 'Login Successfull']);
        }else{
            return redirect()->back()->with(['error' => 'Login Failed. Please check your email and password']);
        }
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
    

        return redirect()->route('login')->with(['success' => 'Logout has successfull']);
    }


    public function register()
    {

        return view('User.register');

    }

    public function register_process(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' =>'required|email|unique:users,email',
            'password' => 'required|min:3'
        ],[
            'name.required' => 'name is required',
            'email.required' => 'email is required',
            'email.unique' => 'email already used',
            'password.required' => 'password is required',
            'password.min' => 'password min 3 character',
        ]);

        

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
           

        ];

        User::create($data);
       

        return redirect()->route('login')->with(['success' => 'Create account has successfull, please login with email same account']);

    }


    public function admin()
    {
        return redirect('/home');
    }



// Kelola Data User ...

    public function index_user(Request $request)
    {
        if($request->has('search')){
            $user = User::where('name','LIKE','%' . $request->search . '%')->paginate(10);
        }else{
            $user = User::paginate(10);
        }
       

        return view('Home.backend.user.index',compact('user'));
    }


    public function store_user(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' =>'required|email|unique:users,email',
            'level' => 'required',
            'password' => 'required|min:3'
        ],[
            'name.required' => 'name is required',
            'email.required' => 'email is required',
            'email.unique' => 'email already used',
            'password.required' => 'password is required',
            'password.min' => 'password min 3 character',
        ]);

        $dataUser = [
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
           

        ];

        User::create($dataUser);

        return redirect()->back()->with(['success'=>'User berhasil ditambah']);
       
    }


    public function update_user(Request $request,$id)
    {

        Validator::make($request->all(),[
            'name' => 'required',
            'email' =>'required|email|',
            'level' =>'required',
            'password' => 'required|min:3'
        ])->validate();

        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->level = $request->level;
        $data->password = bcrypt($request->password);
        $data->save();

        return redirect()->route('user')->with(['success' => 'berhasil Update user']);
    }



    public function destroy_user($id)
    {
        $data = User::find($id);
        $data->delete();

        return redirect()->back()->with(['success' => 'User berhasil terhapus']);
    }


    public function show_user($id)
    {
       $user = User::find($id);
       $data = Peminjaman::where('user_id',$user->id)->get();

        return view('Home.backend.user.show',compact('user','data'));
    }

  



}
