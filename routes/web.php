<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SlideController;
use Illuminate\Support\Facades\Route;





Route::get('/', [FrontendController::class , 'index'])->name('index');
Route::get('post/{slug}', [FrontendController::class, 'post_details'])->name('post.show');
Route::get('/allservices/details/{id}', [FrontendController::class , 'service_details'])->name('service.details');
Route::get('/services/details/{id}', [FrontendController::class , 'service_details_specific'])->name('service.specific');
Route::get('/services/bahri', [FrontendController::class , 'bahri'])->name('bahri');
Route::get('/services/omdurman', [FrontendController::class , 'omdurman'])->name('omdurman');
Route::get('/services/khartoum', [FrontendController::class , 'khartoum'])->name('khartoum');
Route::get('/contact-us', [FrontendController::class , 'contact'])->name('contact');
Route::post('/contactUs', [FrontendController::class , 'sendemail'])->name('send.email');
Route::get('/about', [FrontendController::class , 'about'])->name('about');
Route::get('/projects', [FrontendController::class , 'projects'])->name('projects');
Route::get('projects/{slug}', [FrontendController::class, 'project_details'])->name('project.details');


Auth::routes();


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('services','App\Http\Controllers\ServiceController');
Route::get('/service/sudan', 'App\Http\Controllers\ServiceController@sudan')->name('service.sudan');
Route::get('/service/foreign', 'App\Http\Controllers\ServiceController@foreign')->name('service.foreign');

Route::resource('posts','App\Http\Controllers\PostController');
// Route::get('/posts/trashed/', [App\Http\Controllers\PostController::class , 'trashed'])->name('posts.trashed');
Route::put('/posts/Publish/{id}', [PostController::class , 'Publish'])->name('post.Publish');
Route::put('/posts/unPublish/{id}', [PostController::class , 'unPublish'])->name('post.unPublish');

Route::get('/trashed/posts', [PostController::class , 'trashed'])->name('posts.trashed');
Route::put('/trashed/restore/{id}', [PostController::class , 'restore'])->name('posts.restore');
Route::delete('/posts/delete/{id}', [PostController::class,'kill'])->name('post.kill');


Route::resource('projects','App\Http\Controllers\ProjectController');

// Users
Route::resource('users','App\Http\Controllers\UsersController');
Route::get('/user/trashed', 'App\Http\Controllers\UsersController@trashed')->name('trashed');
Route::put('/user/restore/{id}', [UsersController::class , 'restore'])->name('users.restore');
Route::delete('/user/delete/{id}', [UsersController::class,'kill'])->name('user.kill');
Route::get('/user/profile', 'App\Http\Controllers\UsersController@profile')->name('profile');
Route::put('/user/profile/{id}', 'App\Http\Controllers\UsersController@updateProfile')->name('user.profile.update');
Route::get('/user/not-admin/{id}', 'App\Http\Controllers\UsersController@not_admin')->name('user.not_admin');
Route::get('/user/admin/{id}', 'App\Http\Controllers\UsersController@admin')->name('user.admin');

// Slides 
Route::resource('slides', 'App\Http\Controllers\SlideController');
Route::put('/slides/Publish/{id}', [SlideController::class, 'Publish'])->name('slide.Publish');
Route::put('/slides/unPublish/{id}', [SlideController::class, 'unPublish'])->name('slide.unPublish');

Route::resource('contacts', 'App\Http\Controllers\ContactController');

Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');;
Route::put('/settings/update/{id}', [SettingController::class, 'update'])->name('setting.update');;

});
