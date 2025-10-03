<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Incorrect credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('token');

        $tokenModel = $token->accessToken;
        $tokenModel->expires_at = Carbon::now()->addWeeks(2);
        $tokenModel->save();

        return response()->json([
        'token' => $token->plainTextToken,
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $user->getRoleNames()
        ]
    ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'rol' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

          $user->assignRole($request->rol);

        $token = $user->createToken('token');

        return response()->json([
            'token' => $token->plainTextToken,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->getRoleNames()
            ]
        ]);
    }

    public function viewRegister()
    {
        return view('register');
    }

    public function viewRegisterAdmin()
    {
        return view('registerAdmin');
    }

    public function viewRegisterTecnicoTI()
    {
        return view('registerTecnicoTI');
    }
    public function viewRegisterTecnicoInSitu()
    {
        return view('registerTecnicoInSitu');
    }



}
