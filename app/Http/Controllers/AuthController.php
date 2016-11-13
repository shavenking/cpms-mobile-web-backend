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
        return $this->attempt($credentials);
    }

    public function register(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $this->create($request->toArray());
        return $this->attempt($credentials);
    }

    private function attempt(array $credentials)
    {
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
