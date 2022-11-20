<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Session;
use Image;

class SlideController extends Controller
{
    public function index()
    {
        if (! Gate::allows('is_admin')) {
            return view('errors.403');
        }
        $slides = Slide::orderBy('created_at' ,'DESC')->get();
        return view('backend.slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('is_admin')) {
            return view('errors.403');
        }
        return view('backend.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSlideRequest $request)
    {
        // dd($request->all());
        if (! Gate::allows('is_admin')) {
            return view('errors.403');
        }
        try{

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
    
                $path = $request->file('image')->move(public_path('/uploads/slides'), $fileNameToStore);
    
            }

        $slide = new Slide();
        $slide->title = $request->input('title');
        $slide->body = $request->input('body');
        $slide->title_en = $request->input('title_en');
        $slide->body_en = $request->input('body_en');

        if($request->has('status')){
            $slide->status = $request->input('status');
        }

        $slide->user_id = auth()->user()->id;
           
        $slide->image = $fileNameToStore;
        
        $slide->save();

        Session::flash('success', 'Added Successfully');

        return redirect(route('admin.slides.index'));
            
        } catch (Exception $e) {

            return back()->withError($e->getMessage());
        }
        
        
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        if (! Gate::allows('is_admin')) {
            return view('errors.403');
        }
        return view('backend.slides.view')->with('slide', $slide);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        // $slide = Slide::find($slide);
        if (! Gate::allows('is_admin')) {
            return view('errors.403');
        }
        return view('backend.slides.edit')->with('slide', $slide);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slide $slide)
    {
        // dd($request->all());
        if (! Gate::allows('is_admin')) {
            return view('errors.403');
        }
        try{
       
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
    
                $path = $request->file('image')->move(public_path('/uploads/slides'), $fileNameToStore);
            }
                   

     
        if($request->has('status')){
        $slide->status = $request->input('status');
        }
        $slide->title = $request->input('title');
        $slide->title_en = $request->input('title_en');
        $slide->body = $request->input('body');
        $slide->body_en = $request->input('body_en');
        
        if($request->hasFile('image')){


            $path = parse_url($slide->image);
    
            File::delete(public_path($path['path']));
    
                $slide->image = $fileNameToStore;
            }

        $slide->save();

        Session::flash('success', 'Updated Successfully');

        return redirect(route('admin.slides.index'));
            
        } catch (Exception $e) {

            return back()->withError($e->getMessage());
        }

      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        if (! Gate::allows('is_admin')) {
            return view('errors.403');
        }
        $path = parse_url($slide->image);
        File::delete(public_path($path['path']));

        $path2 = parse_url($slide->image_en);
        File::delete(public_path($path2['path']));


        $slide->delete();

        Session::flash('success', 'successfully Deleted');

        return redirect(route('admin.slides.index'));
    }

        
    public function Publish($id)
    {
        if (! Gate::allows('is_admin')) {
            return view('errors.403');
        }
        $slide = slide::findorFail($id);

        //dd($id);

        $slide->status = 1;

        $slide->save();

        Session::flash('success', 'Updated Successfully');

        return redirect(route('admin.slides.show',$slide))->with('slide', $slide);

    }

    
    public function unPublish($id)
    {
        
        if (! Gate::allows('is_admin')) {
            return view('errors.403');
        }
        $slide = slide::findorFail($id);

        //dd($id);

        $slide->status = 0;

        $slide->save();

        Session::flash('success', 'Updated Successfully');

        return redirect(route('admin.slides.show',$slide))->with('slide', $slide);

    }
}
