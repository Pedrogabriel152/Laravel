<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index() {
        return view('user.index');
    }

    public function store(Request $request){
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->back()->withErrors(['Usuário ou senha incorreto']);
        }

        return to_route('series.index');
    }

    public function create() {
        return view('user.create');
    }

    public function register(Request $request) {
        $data = $request->except(['_token']);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        Auth::login($user);
        $token = JWT::encode([
            'user' => $user->nome,
            'email' => $user->email
        ],'minha_chave', 'HS256');
        
        return to_route('series.index');
    }

    public function logout() {
        Auth::logout();
        return to_route('login');
    }
}
