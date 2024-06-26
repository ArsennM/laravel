<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ChangeNameController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SavedPhotoController;

Route::get('/users/search', [UserController::class, 'search'])->name('users.search');



Route::post('/photos/save/{postId}', [SavedPhotoController::class, 'toggleSave'])->name('photos.toggleSave');

Route::get('/photos/save', [SavedPhotoController::class, 'index'])->name('save.photos');


Route::get('/allPost', function () {
})->name('allPost');

Route::get('/profile/{id?}', [ProfileController::class, 'show'])->name('profile');

Route::post('/like/{postId}', [LikeController::class, 'like'])->name('like');

Route::delete('/cancel-request/{user}', [FollowController::class,'cancelRequest'])->name('cancelRequest');


Route::get('/posts/{post}', [PostController::class, 'showPost'])->name('post.show');
Route::get('createPost', [PostController::class, 'store'])->name('post.createPost');
Route::post('/posts/create', [PostController::class, 'store'])->name('posts-create');
Route::get('/createPostForm', [PostController::class, 'create'])->name('post.createForm');


Route::post('/follow/{user}', [FollowController::class,'follow'])->name('follow');
Route::delete('/unfollow/{user}', [FollowController::class,'unfollow'])->name('unfollow');

Route::get('/following/{user}', [FollowController::class,'following'])->name('following');
Route::get('/followers/{user}', [FollowController::class,'followers'])->name('followers');

Route::get('/followers/{user}', [UserController::class, 'showFollowers'])->name('follow.showFollowers');
Route::get('/following/{user}', [UserController::class, 'showFollowing'])->name('follow.showFollowing');

Route::get('allChats', [MessageController::class, 'allChats'])->name('message.allChats');

Route::get('/chat/{userId}/{userName}', [MessageController::class, 'showChat'])->name('chat.show');

Route::get('/allPost', [PostController::class, 'allPost'])->name('allPost');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

Route::post('/notifications/{id}', [NotificationController::class, 'accept'])->name('notifications.accept');

Route::get('/posts/{postId}/comments/create',[CommentController::class,'create'])->name('comments.create');
Route::post('/posts/{postId}/comments',[CommentController::class,'store'])->name('comments.store');
Route::delete('/comments/{commentId}', [CommentController::class, 'destroy'])->name('comments.destroy');


Route::post('/notifications/{id}/reject', [NotificationController::class, 'reject'])->name('notifications.reject');



Route::get('/send-message/{recipient}', [MessageController::class, 'create'])->name('message.create');
Route::post('/send-message/{recipient}', [MessageController::class, 'store'])->name('message.store');
Route::post('/chat/{userId}/{userName}/send-message', [MessageController::class, 'sendMessage'])->name('chat.sendMessage');

Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('change-password');
Route::post('/change-password', [ChangePasswordController::class, 'changePassword']);

Route::get('/users', [UserController::class, 'index'])->name('users');

Route::get('/change-name', [ChangeNameController::class, 'showChangeNameForm'])->name('change-name');
Route::post('/change-name', [ChangeNameController::class, 'changeName'])->name('change-name');

Route::get('/profile_show/{id}', [ProfileController::class, 'showUserProfile'])->name('profile_show');

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);

Route::post('/register', [UserController::class, 'register']);


Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::get('/register', function () {
    return view('auth.register');
})->name('register');
