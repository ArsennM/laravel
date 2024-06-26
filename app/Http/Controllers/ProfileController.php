<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 


class ProfileController extends Controller
{

    public function showUserProfile($id){
        $user = User::find($id);
        return view('auth.profile_show', ['user' => $user]);
    }  



    public function show($userId = null)
{
    $user = $userId ? User::findOrFail($userId) : auth()->user();

    $activeRequests = auth()->check() ? auth()->user()->activeRequests : null;
    $receivedRequests = auth()->check() ? auth()->user()->receivedRequests : null;

    return view('profile', compact('user', 'activeRequests', 'receivedRequests'));
}

    

    public function showOther($id)
    {
        $user = User::findOrFail($id);

        return view('auth.profile_show', compact('user'));
    }
}

