<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Http\Requests\StoreCollegeRequest;
use App\Http\Requests\UpdateCollegeRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Session;
use Image;

class CollegeController extends Controller
{
    public function index()
    {
        if (! Gate::allows('is_admin')) {
            abort(403);
        }
        $colleges = College::orderBy('created_at' ,'DESC')->get();
        return view('backend.colleges.index', compact('colleges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('is_admin')) {
            abort(403);
        }
        return view('backend.colleges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecollegeRequest $request)
    {
        // dd($request->all());
        if (! Gate::allows('is_admin')) {
            abort(403);
        }

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

            $path = $request->file('image')->move(public_path('/uploads/colleges'), $fileNameToStore);

        }

        $college = new college();

         $college->title = $request->input('title');
         $college->body = $request->input('body');
         $college->title_en = $request->input('title_en');
         $college->body_en = $request->input('body_en');
         $college->slug = make_slug($request->input('title'));
         $college->slug_en = str_slug($request->input('title_en'));
         if($request->has('status')){
             $college->status = $request->input('status');
         }
         $college->image = $fileNameToStore;
         
         $college->save();

        Session::flash('success', 'Added successfully');
    
        return redirect(route('admin.colleges.index'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(college $college)
    {
        if (! Gate::allows('is_admin')) {
            abort(403);
        }
        return view('backend.colleges.view', compact('college'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(college $college)
    {
        if (! Gate::allows('is_admin')) {
            abort(403);
        }
        return view('backend.colleges.edit',compact('college'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecollegeRequest $request, college $college)
    {
        if (! Gate::allows('is_admin')) {
            abort(403);
        }
                     
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

            $path = $request->file('image')->move(public_path('/uploads/colleges'), $fileNameToStore);
        }
             
         $college->body = $request->input('body');
         $college->body_en = $request->input('body_en');
         if($request->has('status')){
             $college->status = $request->input('status');
         }
         
         if($request->title) {
            $college->title = $request->input('title');
             $college->slug = make_slug($request->input('title'));
           }
         if($request->title_en) {
            $college->title_en = $request->input('title_en');
             $college->slug_en = str_slug($request->input('title_en'));
           }
           if($request->hasFile('image')){


            $path = parse_url($college->image);
    
            File::delete(public_path($path['path']));
    
                $post->image = $fileNameToStore;
            }

         $college->save();
   
         Session::flash('success', 'Updated Successfully');
 
         // redirect user
         return redirect(route('admin.colleges.index'));
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(college $college)
    {
        if (! Gate::allows('is_admin')) {
            return view('errors.403');
        }
        $path = parse_url($college->image);
        File::delete(public_path($path['path']));

        $path2 = parse_url($college->image_en);
        File::delete(public_path($path2['path']));

        $college->delete();

        Session::flash('success', 'successfully Deleted');

        return redirect(route('admin.colleges.index'));
    }

    public function trashed()
    {

        if (! Gate::allows('is_admin')) {
            return view('errors.403');
        }
        $colleges = college::onlyTrashed()->get();

        return view('backend.colleges.trashed', compact('colleges'));
        
    }

    public function restore($id)
    {
        if (! Gate::allows('is_admin')) {
            abort(403);
        }

        $college = college::withTrashed()->where('id', $id)->firstOrFail();
        //$college = college::onlyTrashed()->firstOrFail();

        $college->restore();

        session()->flash('success', 'college Restored successfully');

        return back();

    }

    public function kill($id)
    {
      if (! Gate::allows('is_admin')) {
        return view('errors.403');
    }
    $college = college::withTrashed()->where('id', $id)->firstOrFail();
    
    if($college->trashed()) {
        
        $path = parse_url($college->image);
        
        // dd($path);
          File::delete(public_path($path['path']));

          $college->forceDelete();

      } else {
          $college->delete();
      }
      session()->flash('success', 'college deleted successfully');

      return back();


    }

    
    public function Publish($id)
    {
        //dd($id);
        if (! Gate::allows('is_admin')) {
            abort(403);
        }
        $college = college::find($id);


        $college->status = 1;

        $college->save();

        Session::flash('success', 'Updated Successfully');

        return redirect(route('admin.colleges.show',$college))->with('college', $college);

    }

    
    public function unPublish($id)
    {
        //dd($id);
        if (! Gate::allows('is_admin')) {
            abort(403);
        }
        $college = college::find($id);

        //dd($id);

        $college->status = 0;

        $college->save();

        Session::flash('success', 'Updated Successfully');

        return redirect(route('admin.colleges.show',$college))->with('college', $college);

    }

}
