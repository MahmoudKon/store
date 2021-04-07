<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    protected $table= 'banner_image';
    protected $fillable = ['banner_id', 'image', 'title', 'description'];
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('uploads/banner_images/' . $this->image);
    }//end of image path attribute

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }//end of orders
}
