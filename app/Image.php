<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['product_id', 'image'];
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);
    } //end of image path attribute

    public function product()
    {
        return $this->belongsTo(Product::class);
    } //end of orders
}
