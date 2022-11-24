<?php

namespace App\Providers;

use App\Models\College;
use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        view()->composer('*', function($view){
             
            $settings = Setting::first();
            $view->with('settings', $settings);
        });

        
        view()->composer('*', function($view){
            $latest = Post::where('status', '=', 1)->orderBy('created_at' ,'DESC')->paginate(5);
            $view->with('latest', $latest);
        });
        
        
        
        view()->composer('*', function($view){
            $AllColleges = College::where('status', '=', 1)->get();
            $view->with('AllColleges', $AllColleges);
        });
        
        
        view()->composer('*', function($view){
            $allPosts = Post::all();
            $view->with('allPosts', $allPosts);
        });
        
        view()->composer('*', function($view){
            $allusers = User::all();
            $view->with('allusers', $allusers);
        });
        
        view()->composer('*', function($view){
            $allcontacts = Contact::all();
            $view->with('allcontacts', $allcontacts);
        });


    }
}
