<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;


class UserController extends Controller

{

    public function search(Request $request)
    {
        $searchQuery = $request->input('query');

        $users = User::where('name', 'like', "%$searchQuery%")->get();

        return response()->json($users);
    }



    public function index()
    {
        $users = User::with('likes')->get(); 
        Log::info($users->toArray()); 
        return view('auth.users', compact('users')); 
    }


    public function showFollowers($userId)
    {
        $user = User::findOrFail($userId);
        $followers = $user->followers;

        return view('follow.showFollowers', compact('user', 'followers'));
    }

    public function showFollowing($userId)
    {
        $user = User::findOrFail($userId);
        $following = $user->following;

        return view('follow.showFollowing', compact('user', 'following'));
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'profile_visibility' => 'required|in:public,private', // добавляем правило валидации для поля статуса профиля
        ]);
    
        $profilePhotoPath = null;
    
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
        }
    
        $private = $request->profile_visibility === 'private' ? 'private' : 'public';

    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_photo_path' => $profilePhotoPath,
            'private' => $private,
        ]);
    
        if ($user) {
            return redirect()->route('login');
        } else {
            return response()->json($user);
        }
    }
    

    public function login(Request $request)
    {
        Log::channel('single')->info('User ID2222: ');
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect()->route('profile',['id' => $user->id]);

        } else {
            return back()->withErrors([
                'email' => 'Неверный email или пароль.',
            ]);
        }
    

        $user = $request->user();

        if ($request->remember_me) {
            $token->expires_at = now()->addWeeks(1);
        }

        return Redirect::route('profile');

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => $token->expires_at->toDateTimeString(),
        ]);

    }


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Successfully logged out']);
    }
}

