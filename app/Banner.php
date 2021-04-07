<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guarded = [];
    protected $casts = ['image' => 'array'];

    public function images()
    {
        return $this->hasMany(BannerImage::class);
    }//end of images
}
