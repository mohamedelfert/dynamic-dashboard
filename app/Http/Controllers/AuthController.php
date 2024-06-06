<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // store user
        $user = User::create($request->all());

        // Check if the user was successfully stored
        if ($user) {
            // Delete existing tokens for the user
            $user->tokens()->delete();
            // Create a new token for the user
            $token = $user->createToken('auth_token')->plainTextToken;
        }

        // Return a success response with user data and token
        return response()->json(['data' => $user, 'token' => $token]);
    }

    // User login endpoint
    public function login(Request $request)
    {
        // Extract credentials from the request
        $credentials = request(['email', 'password']);

        // Attempt to authenticate the user
        if (!Auth::attempt($credentials)) {
            // If authentication fails, return an unauthorized response
            return response()->json(['message' => 'unauthorized']);
        }

        // Retrieve the authenticated user
        $user = $request->user();

        // Delete existing tokens for the user
        $user->tokens()->delete();

        // Set a custom expiration time (e.g., 7 days from now)
        $customExpiresAt = now()->addDays(7);

        // Create a new token for the user
        $tokenResult = $user->createToken('auth_token', ['expires_at' => $customExpiresAt]);
        $token = $tokenResult->plainTextToken;

        // Return a success response with user data and token
        return response()->json(['data' => $user, 'token' => $token]);
    }

    // User logout endpoint
    public function logout(Request $request)
    {
        // Revoke the current access token for the authenticated user
        $request->user()->currentAccessToken()->delete();
        // Return a success response for logout
        return response()->json(['message' => 'logout']);
    }
}

