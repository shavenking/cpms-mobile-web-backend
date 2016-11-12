<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Model\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            $token = JWTAuth::attempt($credentials);

            if (!$token) {
                return response()->json($credentials, 401);
            }
        } catch (JWTException $e) {
            return response()->json([], 500);
        }

        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = $this->create($request->only('name', 'email', 'password'));

        try {
            $token = JWTAuth::attempt($credentials);

            if (!$token) {
                return response()->json([], 401);
            }
        } catch (JWTException $e) {
            return response()->json([], 500);
        }

        return response()->json(compact('token'));
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
