<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Session;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at' ,'DESC')->get();
        return view('backend.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // dd($request->all());
        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image

            $path = $request->file('image')->move(public_path('/uploads/posts'), $fileNameToStore);

        }
        $post = new post();

         $post->title = $request->input('title');
         $post->body = $request->input('body');
         $post->slug = make_slug($request->input('title'));
         $post->published_at = $request->published_at;
         $post->user_id = auth()->user()->id;
         if($request->has('status')){
             $post->status = $request->input('status');
         }
         
         
         $post->image = $fileNameToStore;
         $post->save();

        Session::flash('success', 'Added successfully');
    
        return redirect(route('admin.posts.index'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('backend.posts.view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('backend.posts.create',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
            // dd($request->all());
           //TODO: check validation and status button
            $request->validate([
                 'title' => 'string',
                 'body' => 'string',
                 'image' =>'image|mimes:jpeg,png,jpg|max:1048',
             ]);
             
             if($request->hasFile('image')){
                // Get filename with the extension
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                // Upload Image
    
                $path = $request->file('image')->move(public_path('/uploads/posts'), $fileNameToStore);
            }
 
         
         $post->body = $request->input('body');
            $post->published_at = $request->published_at;
         $post->user_id = auth()->user()->id;
         if($request->has('status')){
             $post->status = $request->input('status');
         }
         
         if($request->title) {
            $post->title = $request->input('title');
             $post->slug = make_slug($request->input('title'));
           }

           if($request->hasFile('image')){


            $path = parse_url($post->image);
    
            File::delete(public_path($path['path']));
    
                $post->image = $fileNameToStore;
            }
           $post->save();
   
         Session::flash('success', 'Updated Successfully');
 
         // redirect user
         return redirect(route('admin.posts.index'));
 
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try{
            $post->delete();
            
            session()->flash('success', 'Deleted successfully');
    
            return redirect(route('admin.posts.index'));
            
        } catch (Exception $e) {

            return back()->withError($e->getMessage());
        }
    }

    public function trashed()
    {
        if (! Gate::allows('is_admin')) {
            return view('errors.403');
        }
        $posts = Post::onlyTrashed()->get();

        return view('backend.posts.trashed', compact('posts'));
        
    }

    public function restore($id)
    {

        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        //$post = post::onlyTrashed()->firstOrFail();

        $post->restore();

        session()->flash('success', 'Post Restored successfully');

        return back();

    }

    public function kill($id)
    {
      if (! Gate::allows('is_admin')) {
        return view('errors.403');
    }
      $post = Post::withTrashed()->where('id', $id)->firstOrFail();

      if($post->trashed()) {

          $path = parse_url($post->image);

          File::delete(public_path($path['path']));

          $post->forceDelete();

      } else {
          $post->delete();
      }
      session()->flash('success', 'Post deleted successfully');

      return back();


    }

    
    public function Publish($id)
    {
        $post = Post::find($id);

        //dd($id);

        $post->status = 1;

        $post->save();

        Session::flash('success', 'Updated Successfully');

        return redirect(route('admin.posts.show',$post))->with('post', $post);

    }

    
    public function unPublish($id)
    {
        //dd($id);
        $post = Post::find($id);

        //dd($id);

        $post->status = 0;

        $post->save();

        Session::flash('success', 'Updated Successfully');

        return redirect(route('admin.posts.show',$post))->with('post', $post);

    }

}