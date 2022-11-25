<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Slide;
use App\Models\Portfolio;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\College;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;
use App\Http\Requests\CreateContactRequest;
use Illuminate\Support\Facades\Config;

use Illuminate\Http\Request;
use Session;

class FrontendController extends Controller
{
    public function index()
    {
        $lang = Config::get('app.locale');
        $name = Setting::first()->name;
        $description = Setting::first()->description;
        $name_en = Setting::first()->name_en;
        $image = Setting::first()->image;
        $description_en = Setting::first()->description_en;

        if($lang == 'ar') {
            SEOMeta::setTitle($name);
            SEOMeta::setDescription($description);
    
            SEOMeta::setTitle($name);
            SEOMeta::setDescription($description);
            SEOMeta::setCanonical('https://alfarrabi.edu.sd');
    
            OpenGraph::setDescription($description);
            OpenGraph::setTitle($name);
            OpenGraph::setUrl('https://alfarrabi.edu.sd/');
            OpenGraph::addProperty('type', 'articles');
    
    
            JsonLd::setTitle($name);
            JsonLd::setDescription($description);
            JsonLd::addImage($image);
        } else {
            SEOMeta::setTitle($name_en);
            SEOMeta::setDescription($description_en);
    
            SEOMeta::setTitle($name_en);
            SEOMeta::setDescription($description_en);
            SEOMeta::setCanonical('https://alfarrabi.edu.sd');
    
            OpenGraph::setDescription($description_en);
            OpenGraph::setTitle($name_en);
            OpenGraph::setUrl('https://alfarrabi.edu.sd');
            OpenGraph::addProperty('type', 'articles');
    
    
            JsonLd::setTitle($name_en);
            JsonLd::setDescription($description_en);
            JsonLd::addImage($image);

        }



        return view('index')
                ->with('slides', Slide::where('status', '=', 1 )->get())
                ->with('posts', Post::orderBy('created_at' ,'DESC')->paginate(3))
                ->with('settings', Setting::first());
    }

    public function gallery()
    {    
        $lang = Config::get('app.locale');
        $name = Setting::first()->name;
        $name_en = Setting::first()->name_en;
        $description = Setting::first()->description;
        $description_en = Setting::first()->description_en;

        if($lang == 'ar') {
            SEOMeta::setTitle($name);
            SEOMeta::setDescription($description);
        } else {
            SEOMeta::setTitle($name_en);
            SEOMeta::setDescription($description_en);

        }
        
        return view('media-gallery')
            ->with('portfolios', Portfolio::where('status' ,'=', 1)->orderBy('created_at' ,'DESC')->simplePaginate(6));
        
    }


    public function portfolioDetails($slug)
    {
        //dd($slug);
        $portfolio = Portfolio::where('slug', $slug)->orWhere('slug_en', $slug)->first();
        
        $lang = Config::get('app.locale');
        
        if($lang == 'ar') {

        SEOMeta::setTitle($portfolio->name);
        SEOMeta::addMeta('article:section', $portfolio->name, 'property');
        SEOMeta::addMeta('article:published_time', $portfolio->created_at->toW3CString(), 'property');

        OpenGraph::setTitle($portfolio->name);
        OpenGraph::setUrl('https://alfarrabi.edu.sd');
        OpenGraph::addProperty('locale', 'pt-br');
        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);

        OpenGraph::addImage($portfolio->image);
        OpenGraph::addImage(['url' => $portfolio->image, 'size' => 300]);
        OpenGraph::addImage($portfolio->image, ['height' => 300, 'width' => 300]);
        

        JsonLd::setTitle($portfolio->name);
        JsonLd::setType('Article');
        
        TwitterCard::setTitle($portfolio->name);
                 
        } else {
         
        SEOMeta::setTitle($portfolio->name_en);
        SEOMeta::addMeta('article:section', $portfolio->name_en, 'property');
        SEOMeta::addMeta('article:published_time', $portfolio->created_at->toW3CString(), 'property');

        OpenGraph::setTitle($portfolio->name_en);
        OpenGraph::setUrl('https://alfarrabi.edu.sd');
        OpenGraph::addProperty('locale', 'pt-br');
        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);

        OpenGraph::addImage($portfolio->image);
        OpenGraph::addImage(['url' => $portfolio->image, 'size' => 300]);
        OpenGraph::addImage($portfolio->image, ['height' => 300, 'width' => 300]);
        

        JsonLd::setTitle($portfolio->name_en);
        JsonLd::setType('Article');
        
        TwitterCard::setTitle($portfolio->name_en);
        
        }
        //dd(123);
 
          return view('portfolio-details')->with('portfolio', $portfolio); 
    }


    public function contact()
    {
        $name = Setting::first()->name;
        $image = Setting::first()->image;
        $description = Setting::first()->description;

        SEOMeta::setTitle($name);
        SEOMeta::setDescription($description);

        SEOMeta::setTitle($name);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical('https://alfarrabi.edu.sd');

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($name);
        OpenGraph::setUrl('https://alfarrabi.edu.sd/');
        OpenGraph::addProperty('type', 'articles');


        JsonLd::setTitle($name);
        JsonLd::setDescription($description);
        JsonLd::addImage($image);


        return view('contact');
    }

    public function sendemail(CreateContactRequest $request)
    {
        //dd($request->all());
        $token = $request->input('g-recaptcha-response');

         // Create Post
         // Create Post
         $post = new Contact();
         $post->name = $request->input('name');
         $post->email = $request->input('email');
         $post->subject = $request->input('subject');
         $post->message = $request->input('message');

        if($token)
         { 

         $post->save();
          Session::flash('success', 'تم إرسال الرسالة بنجاح');

         } else
         {
            Session::flash('info', 'Recaptcha error');

         } 
         return back();

     }


     public function about()
     {
         $name = Setting::first()->name;
         $image = Setting::first()->image;
         $description = Setting::first()->description;
 
         SEOMeta::setTitle($name);
         SEOMeta::setDescription($description);
 
         SEOMeta::setTitle($name);
         SEOMeta::setDescription($description);
         SEOMeta::setCanonical('https://alfarrabi.edu.sd/about');
 
         OpenGraph::setDescription($description);
         OpenGraph::setTitle($name);
         OpenGraph::setUrl('https://alfarrabi.edu.sd/about');
         OpenGraph::addProperty('type', 'articles');
 
 
         JsonLd::setTitle($name);
         JsonLd::setDescription($description);
         JsonLd::addImage($image);
 
 
         return view('pages.about')
                 ->with('settings', Setting::first());
     }
     public function vision()
     {
         $name = Setting::first()->name;
         $image = Setting::first()->image;
         $description = Setting::first()->description;
 
         SEOMeta::setTitle($name);
         SEOMeta::setDescription($description);
 
         SEOMeta::setTitle($name);
         SEOMeta::setDescription($description);
         SEOMeta::setCanonical('https://alfarrabi.edu.sd/vision');
 
         OpenGraph::setDescription($description);
         OpenGraph::setTitle($name);
         OpenGraph::setUrl('https://alfarrabi.edu.sd/vision');
         OpenGraph::addProperty('type', 'articles');
 
 
         JsonLd::setTitle($name);
         JsonLd::setDescription($description);
         JsonLd::addImage($image);
 
 
         return view('pages.vision')
                 ->with('settings', Setting::first());
     }
     public function value()
     {
         $name = Setting::first()->name;
         $image = Setting::first()->image;
         $description = Setting::first()->description;
 
         SEOMeta::setTitle($name);
         SEOMeta::setDescription($description);
 
         SEOMeta::setTitle($name);
         SEOMeta::setDescription($description);
         SEOMeta::setCanonical('https://alfarrabi.edu.sd/value');
 
         OpenGraph::setDescription($description);
         OpenGraph::setTitle($name);
         OpenGraph::setUrl('https://alfarrabi.edu.sd/value');
         OpenGraph::addProperty('type', 'articles');
 
 
         JsonLd::setTitle($name);
         JsonLd::setDescription($description);
         JsonLd::addImage($image);
 
 
         return view('pages.value')
                 ->with('settings', Setting::first());
     }

     
     public function condition()
     {
         $name = Setting::first()->name;
         $image = Setting::first()->image;
         $description = Setting::first()->description;
 
         SEOMeta::setTitle($name);
         SEOMeta::setDescription($description);
 
         SEOMeta::setTitle($name);
         SEOMeta::setDescription($description);
         SEOMeta::setCanonical('https://alfarrabi.edu.sd/condition');
 
         OpenGraph::setDescription($description);
         OpenGraph::setTitle($name);
         OpenGraph::setUrl('https://alfarrabi.edu.sd/condition');
         OpenGraph::addProperty('type', 'articles');
 
 
         JsonLd::setTitle($name);
         JsonLd::setDescription($description);
         JsonLd::addImage($image);
 
 
         return view('pages.condition')
                 ->with('settings', Setting::first());
     }
     
          
     public function Procedures()
     {
         $name = Setting::first()->name;
         $image = Setting::first()->image;
         $description = Setting::first()->description;
 
         SEOMeta::setTitle($name);
         SEOMeta::setDescription($description);
 
         SEOMeta::setTitle($name);
         SEOMeta::setDescription($description);
         SEOMeta::setCanonical('https://alfarrabi.edu.sd/Procedures');
 
         OpenGraph::setDescription($description);
         OpenGraph::setTitle($name);
         OpenGraph::setUrl('https://alfarrabi.edu.sd/Procedures');
         OpenGraph::addProperty('type', 'articles');
 
 
         JsonLd::setTitle($name);
         JsonLd::setDescription($description);
         JsonLd::addImage($image);
 
 
         return view('pages.procedures')
                 ->with('settings', Setting::first());
     }

               
     public function Resignation()
     {
         $name = Setting::first()->name;
         $image = Setting::first()->image;
         $description = Setting::first()->description;
 
         SEOMeta::setTitle($name);
         SEOMeta::setDescription($description);
 
         SEOMeta::setTitle($name);
         SEOMeta::setDescription($description);
         SEOMeta::setCanonical('https://alfarrabi.edu.sd/Resignation');
 
         OpenGraph::setDescription($description);
         OpenGraph::setTitle($name);
         OpenGraph::setUrl('https://alfarrabi.edu.sd/Resignation');
         OpenGraph::addProperty('type', 'articles');
 
 
         JsonLd::setTitle($name);
         JsonLd::setDescription($description);
         JsonLd::addImage($image);
 
 
         return view('pages.resignation')
                 ->with('settings', Setting::first());
     }

     public function post_details($slug)
     {
         $post = Post::where('slug', $slug)->orWhere('slug_en', $slug)->first();
         
         $lang = Config::get('app.locale');
         
         if($lang == 'ar') {
 
         SEOMeta::setTitle($post->name);
         SEOMeta::setDescription($post->body);
         SEOMeta::addMeta('article:section', $post->name, 'property');
         SEOMeta::addMeta('article:published_time', $post->created_at->toW3CString(), 'property');
 
         OpenGraph::setDescription($post->body);
         OpenGraph::setTitle($post->name);
         OpenGraph::setUrl('http://nic.gov.sd');
         OpenGraph::addProperty('type', $post->body);
         OpenGraph::addProperty('locale', 'pt-br');
         OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
 
         OpenGraph::addImage($post->image);
         OpenGraph::addImage(['url' => $post->image, 'size' => 300]);
         OpenGraph::addImage($post->image, ['height' => 300, 'width' => 300]);
         
 
         JsonLd::setTitle($post->name);
         JsonLd::setDescription($post->body);
         JsonLd::setType('Article');
         
         TwitterCard::setTitle($post->name);
                  
         } else {
          
         SEOMeta::setTitle($post->name_en);
         SEOMeta::setDescription($post->body_en);
         SEOMeta::addMeta('article:section', $post->name_en, 'property');
         SEOMeta::addMeta('article:published_time', $post->created_at->toW3CString(), 'property');
 
         OpenGraph::setDescription($post->body_en);
         OpenGraph::setTitle($post->name_en);
         OpenGraph::setUrl('https://sdexpo2020.sd');
         OpenGraph::addProperty('type', $post->body_en);
         OpenGraph::addProperty('locale', 'pt-br');
         OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
 
         OpenGraph::addImage($post->image);
         OpenGraph::addImage(['url' => $post->image, 'size' => 300]);
         OpenGraph::addImage($post->image, ['height' => 300, 'width' => 300]);
         
 
         JsonLd::setTitle($post->name_en);
         JsonLd::setDescription($post->body_en);
         JsonLd::setType('Article');
         
         TwitterCard::setTitle($post->name_en);
         
         }
         //dd(123);
        
         return view('post-details')->with('post', $post); 
            
     }


     public function college_details($slug)
     {
         $college = College::where('slug', $slug)->orWhere('slug_en', $slug)->first();
         
         $lang = Config::get('app.locale');
         
         if($lang == 'ar') {
 
         SEOMeta::setTitle($college->name);
         SEOMeta::setDescription($college->body);
         SEOMeta::addMeta('article:section', $college->name, 'property');
         SEOMeta::addMeta('article:published_time', $college->created_at->toW3CString(), 'property');
 
         OpenGraph::setDescription($college->body);
         OpenGraph::setTitle($college->name);
         OpenGraph::setUrl('http://nic.gov.sd');
         OpenGraph::addProperty('type', $college->body);
         OpenGraph::addProperty('locale', 'pt-br');
         OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
 
         OpenGraph::addImage($college->image);
         OpenGraph::addImage(['url' => $college->image, 'size' => 300]);
         OpenGraph::addImage($college->image, ['height' => 300, 'width' => 300]);
         
 
         JsonLd::setTitle($college->name);
         JsonLd::setDescription($college->body);
         JsonLd::setType('Article');
         
         TwitterCard::setTitle($college->name);
                  
         } else {
          
         SEOMeta::setTitle($college->name_en);
         SEOMeta::setDescription($college->body_en);
         SEOMeta::addMeta('article:section', $college->name_en, 'property');
         SEOMeta::addMeta('article:published_time', $college->created_at->toW3CString(), 'property');
 
         OpenGraph::setDescription($college->body_en);
         OpenGraph::setTitle($college->name_en);
         OpenGraph::setUrl('https://sdexpo2020.sd');
         OpenGraph::addProperty('type', $college->body_en);
         OpenGraph::addProperty('locale', 'pt-br');
         OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
 
         OpenGraph::addImage($college->image);
         OpenGraph::addImage(['url' => $college->image, 'size' => 300]);
         OpenGraph::addImage($college->image, ['height' => 300, 'width' => 300]);
         
 
         JsonLd::setTitle($college->name_en);
         JsonLd::setDescription($college->body_en);
         JsonLd::setType('Article');
         
         TwitterCard::setTitle($college->name_en);
         
         }
         //dd(123);
        
         return view('college-details')->with('college', $college); 
            
     }

     
 
    public function bahri()
    {

        SEOMeta::setTitle('مجمع خدمات الجمهور - بحري');
        SEOMeta::setDescription('مجمع خدمات الجمهور - بحري');

        SEOMeta::setTitle('مجمع خدمات الجمهور - بحري');
        SEOMeta::setDescription('مجمع خدمات الجمهور - بحري');
        SEOMeta::setCanonical('https://alfarrabi.edu.sd');

        OpenGraph::setDescription('مجمع خدمات الجمهور - بحري');
        OpenGraph::setTitle('مجمع خدمات الجمهور - بحري');
        OpenGraph::setUrl('https://alfarrabi.edu.sd/');
        OpenGraph::addProperty('type', 'articles');


        JsonLd::setTitle('مجمع خدمات الجمهور - بحري');
        JsonLd::setDescription('مجمع خدمات الجمهور - بحري');


        return view('bahri-complex');
    }

    public function omdurman()
    {

        SEOMeta::setTitle('مجمع خدمات الجمهور - أم درمان');
        SEOMeta::setDescription('مجمع خدمات الجمهور - أم درمان');

        SEOMeta::setTitle('مجمع خدمات الجمهور - أم درمان');
        SEOMeta::setDescription('مجمع خدمات الجمهور - أم درمان');
        SEOMeta::setCanonical('https://alfarrabi.edu.sd');

        OpenGraph::setDescription('مجمع خدمات الجمهور - أم درمان');
        OpenGraph::setTitle('مجمع خدمات الجمهور - أم درمان');
        OpenGraph::setUrl('https://alfarrabi.edu.sd/');
        OpenGraph::addProperty('type', 'articles');


        JsonLd::setTitle('مجمع خدمات الجمهور - أم درمان');
        JsonLd::setDescription('مجمع خدمات الجمهور - أم درمان');


        return view('omdurman-complex');
    }

    public function khartoum()
    {

        SEOMeta::setTitle('مجمع خدمات الجمهور - الخرطوم');
        SEOMeta::setDescription('مجمع خدمات الجمهور - الخرطوم');

        SEOMeta::setTitle('مجمع خدمات الجمهور - الخرطوم');
        SEOMeta::setDescription('مجمع خدمات الجمهور - الخرطوم');
        SEOMeta::setCanonical('https://alfarrabi.edu.sd');

        OpenGraph::setDescription('مجمع خدمات الجمهور - الخرطوم');
        OpenGraph::setTitle('مجمع خدمات الجمهور - الخرطوم');
        OpenGraph::setUrl('https://alfarrabi.edu.sd/');
        OpenGraph::addProperty('type', 'articles');


        JsonLd::setTitle('مجمع خدمات الجمهور - الخرطوم');
        JsonLd::setDescription('مجمع خدمات الجمهور - الخرطوم');


        return view('khartoum-complex');
    }

    public function projects()
    {
        $name = Setting::first()->name;
        $image = Setting::first()->image;
        $description = Setting::first()->description;

        SEOMeta::setTitle($name);
        SEOMeta::setDescription($description);

        SEOMeta::setTitle($name);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical('https://alfarrabi.edu.sd/projects');

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($name);
        OpenGraph::setUrl('https://alfarrabi.edu.sd/projects');
        OpenGraph::addProperty('type', 'articles');


        JsonLd::setTitle($name);
        JsonLd::setDescription($description);
        JsonLd::addImage($image);


        return view('projects')
                ->with('projects', Project::orderBy('created_at' ,'DESC')->get())
                ->with('settings', Setting::first());
    }


}
