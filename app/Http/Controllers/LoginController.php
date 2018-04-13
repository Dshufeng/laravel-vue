<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;


class LoginController extends Controller
{
    //
    public function index(){
        return view('login/index');
    }
    public function login(Request $request){
        $name = $request->input('name');
        $password = $request->input('password');

        if(Auth::guard('my')->attempt(compact('name','password'))){
            $user = Auth::guard('my')->user();
            return response()->json([
                'status' => true,
                'msg' => '登录成功',
                'user'=>[
                    'name' => $user['name'],
                    'my_session' => Session::getId(),
                ]
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => '用户名或者密码不正确'
            ]);
        }
    }

    public function check(Request $request){
        if (Auth::guard('my')->check()) {
            return ['auth' => 'Authenticated'];
        }
        return ['auth' => 'Unauthenticated'];
    }

    public function logout(){
        Auth::guard('my')->logout();
        return response()->json([
            'status'=>true
        ]);
    }
}
