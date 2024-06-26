<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedPhoto;

class SavedPhotoController extends Controller
{

    public function toggleSave(Request $request, $postId)
    {
        $saved = SavedPhoto::where('user_id', auth()->id())
                           ->where('post_id', $postId)
                           ->first();

        if ($saved) {
            $saved->delete();
            return redirect()->back()->with('success', 'Post unsaved successfully.');
        }

        $newSavedPhoto = new SavedPhoto();
        $newSavedPhoto->user_id = auth()->id();
        $newSavedPhoto->post_id = $postId;
        $newSavedPhoto->save();

        return redirect()->back()->with('success', 'Post saved successfully.');
    }


    public function index()
    {
        $savedPhotos = SavedPhoto::where('user_id', auth()->id())->with('post')->get();
        return view('save', compact('savedPhotos'));
    }

}
