<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function getTotalPriceAttribute()
    {
        $total_price = 0;
        foreach($this->productsWithTrashed as $product):
            $total_price += $product->all_price * $product->pivot->quantity;
        endforeach;
            return number_format($total_price, 2);
    }//end of get price attribute

    public function getTotalProfitAttribute()
    {
        $total_profit = 0;
        foreach($this->productsWithTrashed as $product):
            $total_profit += $product->all_price - $product->purchase_price;
        endforeach;
            return number_format($total_profit, 2);
    }//end of get profit attribute

    public function getTotalPercentAttribute()
    {
        $total_percent = 0;
        foreach($this->products as $pro):
            $total_percent += $pro->profit_percent;
        endforeach;
            return number_format($total_percent, 2);
    }//end of get profit attribute

    public function client()
    {
        return $this->belongsTo(Client::class)->withTrashed();

    }//end of user

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order')->withPivot('quantity');
    }//end of products

    public function productsWithTrashed()
    {
        return $this->belongsToMany(Product::class, 'product_order')->withPivot('quantity')->withTrashed();
    }//end of products

}//end of model
