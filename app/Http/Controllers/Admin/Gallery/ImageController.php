<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Image;


class ImageController extends Controller
{

    public function store(Request $request)
    {
        $image = Image::create($request->merge([
            'gallery_id' => $request->get('gallery')
        ])->only([
            'gallery_id'
        ]));

        if ($request->hasFile('qqfile')) {
            $image->imageUpload($request->file('qqfile'));
        }
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Image::find($id)->delete();
        Session::flash('success', 'Obrazek usunięty');
        return response()->json('Deleted', 200);
    }

    public function sort(Request $request, Image $image)
    {
        $image->sort($request);
    }
}
