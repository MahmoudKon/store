<?php

namespace App\Http\Controllers\Dashboard;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BannerImagesController extends Controller
{
    public function delete(Request $request)
    {
        if($request->ajax())
        {
            $image = Banner::findOrFail($request->id);
                File::delete(public_path('../../public_html/uploads/slider_images/' . $image->image));
            $image->delete();            
            session()->flash('success', __('site.deleted_successfully'));
        }
    } // end of delete the image specific slider
}
