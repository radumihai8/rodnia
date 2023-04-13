<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Slide;
use Illuminate\Http\Request;

class SlidesController extends Controller
{
    //store function that takes an image and uploads it to the server
    public function store(Request $request)
    {

        $validated = $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:4092',
            'title' => 'required|string',
            'category_id' => 'required|integer',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/slides'), $imageName);

        $slide = new Slide();
        $slide->image = $imageName;
        $slide->title = $validated['title'];
        $slide->category_id = $validated['category_id'];
        $slide->save();

        //print image url

        return back()->with('success', 'Slide created');
    }

    //update function
    public function update(Request $request, Slide $slide)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'category_id' => 'required|integer',
        ]);

        $slide->title = $validated['title'];
        $slide->category_id = $validated['category_id'];
        $slide->save();

        return back()->with('success', 'Slide updated');
    }

    //delete function
    public function destroy(Slide $slide)
    {
        $slide->delete();
        return back()->with('success', 'Slide deleted');
    }
}
