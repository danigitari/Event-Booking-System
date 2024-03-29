<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ])->assignRole('user');


        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Registration Successful',
            'user' => $user,
            'token' => $token,

        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            // dd($request);

            return response()->json([
                'message' => 'Invalid Credentials',
            ], 401);
        }


        $token = $user->createToken('authToken')->plainTextToken;


        return response()->json([
            'message' => 'Login Successful',
            'user' => $user,
            'token' => $token,
            'role' => $user->getRoleNames(),

        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout Successful',
        ]);
    }

    public function editProfile(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if (!$user) {

            return response()->json([
                'message' => 'Invalid Credentials',
            ], 401);
        }
        $user->phone_number = $request->phone_number;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'message' => 'Profile Reset Successfully',
        ]);
    }
    public function getCurrentUser()
    {
        $user = auth()->user();
        return response()->json([
            'user' => $user,
        ]);
    }
}
