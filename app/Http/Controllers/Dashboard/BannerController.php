<?php

namespace App\Http\Controllers\Dashboard;

use App\Banner;
use App\BannerImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function __construct()
    {
        // $banners = Banner::get();
        // foreach($banners as $banner) :
        //     if($banner->images->count() == 0) :
        //         $banner->delete();
        //     endif;
        // endforeach;
    } //end of constructor


    public function index()
    {
        $banners = Banner::paginate(10);
        return view('dashboard.banners.index', compact('banners'));
    } // end of index page

    public function create()
    {
        return view('dashboard.banners.create');
    } // end of create page

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required',
            'title.*'         => 'required',
            'description.*'   => 'required',
            'image.*'         => 'required|image',
        ]);
        $slide = Banner::create(['name' => $request->name]);
        if($slide && $request->image !== null)
        {
            $data = $request->except(['_token', '_method', 'name']);
            for($i = 0; $i < count($data['image']); $i++)
            {
                Image::make($data['image'][$i])
                    ->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('/uploads/banner_images/' . $data['image'][$i]->hashName()));
                $data['image'][$i] = $data['image'][$i]->hashName();
                
                $slide->images()->create([
                    'title'       => $data['title'][$i],
                    'description' => $data['description'][$i],
                    'image'       => $data['image'][$i],
                ]);
            }
        }else{
            session()->flash('error', __('site.upload_image'));
            return redirect()->back();
        }
        return redirect()->route('dashboard.banners.index');
    } // end of store the new row

    public function show(Banner $banner)
    {
        return view('dashboard.banners.show', compact('banner'));
    } // end of show the row

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('dashboard.banners.edit', compact('banner'));
    } // end of edit page

    public function update(Request $request, $id)
    {
        $request->validate([
            'title.*'         => 'required',
            'description.*'   => 'required',
            'image.*'         => 'image',
        ]);
        $data = $request->except(['_token', '_method', 'sliderID']);
        $banner = Banner::findOrFail($id);

        foreach($data as $image) :            
            // If Isset Image Upload IT
            if(isset($image['image'])) :
                Image::make($image['image'])
                    ->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('/uploads/banner_images/' . $image['image']->hashName()));
                $image['image'] = $image['image']->hashName();
            endif;

            // If Isset Image ID Then This Row Is Isset on Database Then Make Update
            if(isset($image['id'])) : 
                $img = BannerImage::findOrFail($image['id']);
                if(isset($image['image'])) :
                    File::delete(public_path('/uploads/banner_images/' . $img->image));
                endif;
                $img->update($image);

            // Else This Row Is Not Exist On Database Then Make Create For IT
            else : 
                $banner->images()->create($image);
            endif;

        endforeach;
        return redirect()->route('dashboard.banners.index');
    } // end of update the row

    public function destroy($id)
    {
        $slider = Banner::findOrFail($id);
        foreach($slider->images as $image)
        {
            File::delete(public_path('/uploads/banner_images/' . $image->image));
        } //end of inner if
        $slider->delete();
        return redirect()->route('dashboard.banners.index');
    } // end of destroy the single row or multi rows
}
