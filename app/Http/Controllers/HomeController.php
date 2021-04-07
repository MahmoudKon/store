<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\DB;
use ProductsTableSeeder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        foreach (Category::all() as $category):
            $category->update([
                'hasCount' => $category->products()->count(),
            ]);
        endforeach;

        foreach (Product::all() as $product):
            if(date('d/m/Y', strtotime($product['end_discount'])) <= date('d/m/Y') && $product->end_discount != null):
                $product->update([
                    'discount' => null,
                    'start_discount' => null,
                    'end_discount' => null,
                ]);
            endif;
        endforeach;
    }// end of __construct

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = "Home";
        $discount = Product::select('discount')->where('discount', '>',  0)->groupBy('discount')->orderBy('discount', 'asc')->get();
        $categories = Category::where('hasCount', '>', 0)->inRandomOrder()->take(5)->get();
        $products   = Product::orderBy('created_at', 'desc')->take(4)->get();
        return view('ui.home.index', compact('categories', 'products', 'discount', 'title'));
    }

    public function product($id)
    {
        $product = Product::find($id);
        $category  = Category::find($product->category->id);
        return view('single', compact('category', 'product'));
    }

    public function category(Request $request)
    {
        $category = Category::find($request->category_id);
        $title = "Category | "  . $category->name;
        $discount = Product::select('discount')->where('discount', '>',  0)->groupBy('discount')->orderBy('discount', 'asc')->get();
        $categories = Category::where('hasCount', '>', 0)->inRandomOrder()->take(5)->get();
        return view('ui.products.index', compact('categories', 'category', 'discount', 'title'));
    }

}
