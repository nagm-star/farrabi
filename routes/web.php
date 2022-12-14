<?php

use App\Http\Controllers\CollegeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SlideController;
use Illuminate\Support\Facades\Route;


Route::get('/lang/{lang?}',[App\Http\Controllers\LangSwitcherController::class, 'LangSwitcher'])->name('lang.switch');

Route::get('/sitemap.xml/', [App\Http\Controllers\SitemapController::class, 'index']);
Route::get('/sitemap.xml/sitemap/media/news', [App\Http\Controllers\SitemapController::class, 'post']);
Route::get('/sitemap.xml/sitemap/colleges', [App\Http\Controllers\SitemapController::class, 'colleges']);




Route::get('/', [FrontendController::class , 'index'])->name('index');
Route::get('post/{slug}', [FrontendController::class, 'post_details'])->name('post.show');
Route::get('college/{slug}', [FrontendController::class, 'college_details'])->name('college.show');
Route::get('/services/khartoum', [FrontendController::class , 'khartoum'])->name('khartoum');
Route::get('/contact-us', [FrontendController::class , 'contact'])->name('contact');
Route::post('/contactUs', [FrontendController::class , 'sendemail'])->name('send.email');
Route::get('/about', [FrontendController::class , 'about'])->name('about');
Route::get('/vision', [FrontendController::class , 'vision'])->name('vision');
Route::get('/value', [FrontendController::class , 'value'])->name('value');
Route::get('/condition', [FrontendController::class , 'condition'])->name('condition');
Route::get('/Procedures', [FrontendController::class , 'Procedures'])->name('Procedures');
Route::get('/Resignation', [FrontendController::class , 'Resignation'])->name('Resignation');

Route::get('media/gallary', [App\Http\Controllers\FrontEndController::class, 'gallery'])->name('media');
Route::get('media/gallary/{slug}', [App\Http\Controllers\FrontEndController::class, 'portfolioDetails'])->name('portfolio.show');


Auth::routes();


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('posts','App\Http\Controllers\PostController');
Route::put('/posts/Publish/{id}', [PostController::class , 'Publish'])->name('post.Publish');
Route::put('/posts/unPublish/{id}', [PostController::class , 'unPublish'])->name('post.unPublish');

Route::get('/trashed/posts', [PostController::class , 'trashed'])->name('posts.trashed');
Route::put('/trashed/restore/{id}', [PostController::class , 'restore'])->name('posts.restore');
Route::delete('/posts/delete/{id}', [PostController::class,'kill'])->name('post.kill');

Route::resource('colleges','App\Http\Controllers\CollegeController');
Route::put('/colleges/Publish/{id}', [CollegeController::class , 'Publish'])->name('college.Publish');
Route::put('/colleges/unPublish/{id}', [CollegeController::class , 'unPublish'])->name('college.unPublish');


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

// Portfolio 
Route::resource('portfolio', 'App\Http\Controllers\PortfolioController');
Route::put('/portfolio/Publish/{id}', [PortfolioController::class, 'Publish'])->name('portfolio.Publish');
Route::put('/portfolio/unPublish/{id}', [PortfolioController::class, 'unPublish'])->name('portfolio.unPublish');



Route::resource('contacts', 'App\Http\Controllers\ContactController');

Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');;
Route::put('/settings/update/{id}', [SettingController::class, 'update'])->name('setting.update');;

});
