<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangeNameController extends Controller
{
    public function showChangeNameForm()
    {
        $user = Auth::user();
        return view('auth.change_name', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('change-name', compact('user'));
    }



    public function changeName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.confirmed' => 'The new name confirmation does not match.',
        ]);

        $user = Auth::user();
        $user->name = $request->name;


        if (method_exists($user, 'save')) {
            if ($user->save()) {
                $request->session()->put('user', $user);
                return redirect()->route('profile')->with('success', 'Profile updated successfully.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to update profile.');
            }
        } else {
            throw new \Exception('Save method does not exist on User model');
        }
    }
}