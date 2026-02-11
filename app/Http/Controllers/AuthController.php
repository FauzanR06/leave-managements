<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'employee_number' => 'required',
            'password' => 'required',
        ]);
    
        $user = User::where('employee_number', $request->employee_number)->first();
    
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'employee_number' => ['The provided credentials are incorrect.'],
            ]);
        }
    
        // Create a new token for the user
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'role' => $user->role
        ]);    
    }

    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
