<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Post;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
    $post = Post::searched()->where('status' ,'=', 1)->get();
    $college = college::where('status', '=', 1)->get();

    return response()->view('sitemap.index', [
        'post' => $post,
        'college' => $college,
    
    ])->header('Content-Type', 'text/xml');
    }

public function post()
{
    $posts = Post::searched()->where('status' ,'=', 1)->get();
    return response ()->view ('sitemap.posts', [
        'posts' => $posts,
    ])->header ('Content-Type', 'text/xml');
}

public function colleges() 
{
    $colleges= College::where('status' ,'=', 1)->orderBy('created_at' ,'DESC')->get();
    
    return response ()->view ('sitemap.colleges', [
        'colleges' => $colleges,
    ])->header ('Content-Type', 'text/xml');
}



}
