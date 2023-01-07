<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(UserRegistrationRequest $request)
    {
        $data = $request->only(['email', 'username', 'name', 'dob', 'phone', 'password']);

        $data['password'] = Hash::make($data['password']);

        // Create a new user
        $user = User::create($data);

        // Return a success response
        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(UserLoginRequest $request)
    {
        if (Auth::attempt($request->only(['username', 'password']))) {
            $user = Auth::user();
            $token = $user->createToken('api_token')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['message' => 'Invalid username or password'], 401);
        }
    }

    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }


    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted'], 200);
    }
}
