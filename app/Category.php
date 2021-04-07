<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use \Dimsav\Translatable\Translatable;
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    public $translatedAttributes = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);

    }//end of products

    public function productsWithTrashed()
    {
        return $this->hasMany(Product::class)->withTrashed();

    }//end of products

    public function productsOnlyTrashed()
    {
        return $this->hasMany(Product::class)->onlyTrashed();

    }//end of products

}//end of model
