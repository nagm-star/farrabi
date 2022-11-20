<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Slide;
use App\Models\Contact;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;
use App\Http\Requests\CreateContactRequest;

use Illuminate\Http\Request;
use Session;

class FrontendController extends Controller
{
    public function index()
    {
        $name = Setting::first()->name;
        $image = Setting::first()->image;
        $description = Setting::first()->description;

        SEOMeta::setTitle($name);
        SEOMeta::setDescription($description);

        SEOMeta::setTitle($name);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical('http://passport.gov.sd');

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($name);
        OpenGraph::setUrl('http://passport.gov.sd/');
        OpenGraph::addProperty('type', 'articles');


        JsonLd::setTitle($name);
        JsonLd::setDescription($description);
        JsonLd::addImage($image);


        return view('index')
                ->with('slides', Slide::where('status', '=', 1 )->get())
                ->with('posts', Post::orderBy('created_at' ,'DESC')->paginate(3))
                ->with('settings', Setting::first());
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
        SEOMeta::setCanonical('http://passport.gov.sd');

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($name);
        OpenGraph::setUrl('http://passport.gov.sd/');
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
         SEOMeta::setCanonical('http://passport.gov.sd/about');
 
         OpenGraph::setDescription($description);
         OpenGraph::setTitle($name);
         OpenGraph::setUrl('http://passport.gov.sd/about');
         OpenGraph::addProperty('type', 'articles');
 
 
         JsonLd::setTitle($name);
         JsonLd::setDescription($description);
         JsonLd::addImage($image);
 
 
         return view('about')
                 ->with('settings', Setting::first());
     }

    public function post_details($slug)
    {
        $post = Post::where('slug', $slug)->first();
        
        SEOMeta::setTitle($post->title);
        SEOMeta::setDescription($post->body);
        SEOMeta::addMeta('article:section', $post->title, 'property');
        SEOMeta::addMeta('article:published_time', $post->created_at->toW3CString(), 'property');

        OpenGraph::setDescription($post->body);
        OpenGraph::setTitle($post->title);
        OpenGraph::setUrl('http://passport.gov.sd');
        OpenGraph::addProperty('type', $post->body);
        OpenGraph::addProperty('locale', 'pt-br');
        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);

        OpenGraph::addImage($post->image);
        OpenGraph::addImage(['url' => $post->image, 'size' => 300]);
        OpenGraph::addImage($post->image, ['height' => 300, 'width' => 300]);
        

        JsonLd::setTitle($post->title);
        JsonLd::setDescription($post->body);
        JsonLd::setType('Article');
        
        TwitterCard::setTitle($post->title);
                 
       
       return view('post-details')->with('post', $post); 
           
    }
    public function project_details($slug)
    {
        $project = Project::where('slug', $slug)->first();
        
        SEOMeta::setTitle($project->title);
        SEOMeta::setDescription($project->body);
        SEOMeta::addMeta('article:section', $project->title, 'property');
        SEOMeta::addMeta('article:published_time', $project->created_at->toW3CString(), 'property');

        OpenGraph::setDescription($project->body);
        OpenGraph::setTitle($project->title);
        OpenGraph::setUrl('http://passport.gov.sd/project/$slug');
        OpenGraph::addProperty('type', $project->body);
        OpenGraph::addProperty('locale', 'pt-br');
        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);

        OpenGraph::addImage($project->image);
        OpenGraph::addImage(['url' => $project->image, 'size' => 300]);
        OpenGraph::addImage($project->image, ['height' => 300, 'width' => 300]);
        

        JsonLd::setTitle($project->title);
        JsonLd::setDescription($project->body);
        JsonLd::setType('Article');
        
        TwitterCard::setTitle($project->title);
                 
       
       return view('project-details')->with('project', $project); 
           
    }

    public function bahri()
    {

        SEOMeta::setTitle('مجمع خدمات الجمهور - بحري');
        SEOMeta::setDescription('مجمع خدمات الجمهور - بحري');

        SEOMeta::setTitle('مجمع خدمات الجمهور - بحري');
        SEOMeta::setDescription('مجمع خدمات الجمهور - بحري');
        SEOMeta::setCanonical('http://passport.gov.sd');

        OpenGraph::setDescription('مجمع خدمات الجمهور - بحري');
        OpenGraph::setTitle('مجمع خدمات الجمهور - بحري');
        OpenGraph::setUrl('http://passport.gov.sd/');
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
        SEOMeta::setCanonical('http://passport.gov.sd');

        OpenGraph::setDescription('مجمع خدمات الجمهور - أم درمان');
        OpenGraph::setTitle('مجمع خدمات الجمهور - أم درمان');
        OpenGraph::setUrl('http://passport.gov.sd/');
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
        SEOMeta::setCanonical('http://passport.gov.sd');

        OpenGraph::setDescription('مجمع خدمات الجمهور - الخرطوم');
        OpenGraph::setTitle('مجمع خدمات الجمهور - الخرطوم');
        OpenGraph::setUrl('http://passport.gov.sd/');
        OpenGraph::addProperty('type', 'articles');


        JsonLd::setTitle('مجمع خدمات الجمهور - الخرطوم');
        JsonLd::setDescription('مجمع خدمات الجمهور - الخرطوم');


        return view('khartoum-complex');
    }

    public function service_details($id)
    {
        $type = '';
        if($id == 'sudanese') {
            $type = 1;
        } else {
            $type = 0;
        }
       
        $services = Service::where('category', $type)->get();
        
  
        OpenGraph::setUrl('http://passport.gov.sd/services/details/', $id);
        OpenGraph::addProperty('locale', 'pt-br');
        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);

                 
       
       return view('service-details', compact('type'))->with('services', $services); 
           
    }

    public function service_details_specific($slug)
    {
        $service = Service::where('slug', $slug)->first();
        $relatedServices = Service::where('category', $service->category)->get();
        SEOMeta::setTitle($service->title);
        SEOMeta::setDescription($service->body);
        SEOMeta::addMeta('article:section', $service->title, 'property');
        SEOMeta::addMeta('article:published_time', $service->created_at->toW3CString(), 'property');

        OpenGraph::setDescription($service->body);
        OpenGraph::setTitle($service->title);
        OpenGraph::setUrl('http://passport.gov.sd');
        OpenGraph::addProperty('type', $service->body);
        OpenGraph::addProperty('locale', 'pt-br');
        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);

        OpenGraph::addImage($service->image);
        OpenGraph::addImage($service->image, ['height' => 300, 'width' => 300]);
        

        JsonLd::setTitle($service->title);
        JsonLd::setDescription($service->body);
        JsonLd::setType('Article');
        
        TwitterCard::setTitle($service->title);
                 
       
       return view('service-specific-details')
                       ->with('service', $service)
                       ->with('relatedServices', $relatedServices); 
           
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
        SEOMeta::setCanonical('http://passport.gov.sd/projects');

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($name);
        OpenGraph::setUrl('http://passport.gov.sd/projects');
        OpenGraph::addProperty('type', 'articles');


        JsonLd::setTitle($name);
        JsonLd::setDescription($description);
        JsonLd::addImage($image);


        return view('projects')
                ->with('projects', Project::orderBy('created_at' ,'DESC')->get())
                ->with('settings', Setting::first());
    }


}
