<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use \Dimsav\Translatable\Translatable;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $fillable = ['category_id', 'discount', 'start_discount', 'end_discount', 'purchase_price', 'sale_price', 'stock'];
    protected $casts = ['image' => 'array'];
    protected $appends = ['profit_percent'];
    public $translatedAttributes = ['name', 'description'];

    public function getAllPriceAttribute()
    {
        return $this->sale_price - ($this->sale_price * ($this->discount / 100));
    } //end of image path attribute

    public function getProfitPercentAttribute()
    {
        if ($this->all_price > 0 && $this->purchase_price > 0) :
            $profit = $this->all_price - $this->purchase_price;
            $profit_percent = $profit * 100 / $this->purchase_price;
            return number_format($profit_percent, 2);
        endif;
    } //end of get profit attribute

    public function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    } //end fo category

    public function categoryTrashed()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    } //end fo category

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order')->withPivot('quantity');
    } //end of orders

    public function images()
    {
        return $this->hasMany(Image::class);
    } //end of user

}//end of model
