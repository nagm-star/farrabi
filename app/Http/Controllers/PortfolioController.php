<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Portfolio;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Image;
use Session;
class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.portfolio.index')->with('portfolios', Portfolio::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
                
        $request->validate([
            'name' => 'required', 'string',
            'image*' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);
 
       try{
        $images=array();
        if($files=$request->file('image')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('uploads/gallery/',$name);
                $images[]=$name;
            }
        }

        $portfolio = new portfolio();

        // $portfolio->name = $name;

         $portfolio->name = $request->input('name');
         $portfolio->name_en = $request->input('name_en');
         $portfolio->image = json_encode($images);
         $portfolio->slug = make_slug($request->input('name'));
         $portfolio->slug_en = str_slug($request->input('name_en'));
         if($request->has('status')){
             $portfolio->status = $request->input('status');
         }
         
         
         $portfolio->save();

        
        Session::flash('success', 'Added successfully');
    
        return redirect(route('admin.portfolio.index'));
        
                
        } catch (Exception $e) {
            return back()->withError($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        return view('backend.portfolio.view', compact('portfolio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {

        return view('backend.portfolio.edit',compact('portfolio'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);


        try{

           $request->validate([
                'name' => 'string',
                'image*' =>'sometimes|image|mimes:jpeg,png,jpg|max:1048',
            ]);
 
            $images=array();

            if($files=$request->file('image')){
                
                    foreach (json_decode($portfolio->image, true) as $image) {
                        $imagePath = public_path('uploads/gallery/'. $image);
                        
                        unlink($imagePath);
                    }
    
                    foreach($files as $file){
                        $name=$file->getClientOriginalName();
                        $file->move('uploads/gallery/',$name);
                        $images[]=$name;
                    }
                    $portfolio->image =  json_encode($images);
                }

        $portfolio->user_id = auth()->user()->id;
        if($request->has('status')){
            $portfolio->status = $request->input('status');
        }

        if($request->name) {
            $portfolio->name = $request->input('name');

            $portfolio->slug = make_slug($request->input('name'));
          }

          
        if($request->name_en) {
            $portfolio->name_en = $request->input('name_en');

            $portfolio->slug = str_slug($request->input('name_en'));
          }
  

          $portfolio->save();
  
        // flash message

        session()->flash('success', 'Updated successfully');

        // redirect user
        return redirect(route('admin.portfolio.index'));
    } catch (Exception $e) {

        return back()->withError($e->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        try{
            $oldImage = $portfolio->image;
    
            foreach (json_decode($portfolio->image, true) as $image) {
                $imagePath = public_path('uploads/gallery/'. $image);
                unlink($imagePath);
                //$this->removeImage($image);
            }
    
            $portfolio->delete();

            session()->flash('success', 'Deleted successfully');
    
            return redirect(route('admin.portfolio.index'));
            
        } catch (Exception $e) {

            return back()->withError($e->getMessage());
        }
        
    }

    public function Publish($id)
    {
        $portfolio = Portfolio::find($id);

        //dd($id);

        $portfolio->status = 1;

        $portfolio->save();

        Session::flash('success', 'Updated Successfully');

        return redirect(route('admin.portfolio.show',$portfolio))->with('portfolio', $portfolio);

    }

    
    public function unPublish($id)
    {
        //dd($id);
        $portfolio = Portfolio::find($id);

        $portfolio->status = 0;

        $portfolio->save();

        Session::flash('success', 'Updated Successfully');

        return redirect(route('admin.portfolio.show',$portfolio))->with('portfolio', $portfolio);

    }
}
