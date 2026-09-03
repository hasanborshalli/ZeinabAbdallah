<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class HomeImageController extends Controller
{
    public function addHomeImage(Request $request)
    {
        $fields = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tall' => 'nullable|boolean',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('/assets/images/home'), $imageName);
        $fields['image'] = '/assets/images/home/' . $imageName;

        Portfolio::create($fields);

        return redirect()->route('admin.homeImage.page')->with('success', 'Home image added successfully.');
    }
    public function deleteHomeImage(Portfolio $portfolio)
    {
        // Delete the image file from the public directory
        if (file_exists(public_path($portfolio->image))) {
            unlink(public_path($portfolio->image));
        }

        // Delete the record from the database
        $portfolio->delete();

        return redirect()->route('admin.homeImage.page')->with('success', 'Home image deleted successfully.');
    }
}