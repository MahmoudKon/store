<?php

namespace App\Http\Controllers\Dashboard;

use App\Banner;
use App\Category;
use App\Client;
use App\Order;
use App\Product;
use App\User;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\Pivot;

class WelcomeController extends Controller
{
    public function __construct()
    {
        foreach (Category::all() as $category):
            $category->update([
                'hasCount' => $category->products()->count(),
            ]);
            endforeach;

        foreach (Product::all() as $product):
            if(date('d/m/Y', strtotime($product['end_discount'])) <= date('d/m/Y') || $product->end_discount == null || $product->discount == 0):
                $product->update([
                    'discount' => null,
                    'start_discount' => null,
                    'end_discount' => null,
                ]);
            endif;
        endforeach;
    }// end of __construct

    public function index(Request $request)
    {
        $products = DB::table('product_order')->select(
            DB::raw('order_id'),
            DB::raw('product_id'),
            DB::raw('SUM(quantity) as quantity')
        )->groupBy('product_id')->orderBy('quantity', 'DESC')->take(4)->get();

        // To View The Count of Models On Widgets
        $counts = [];
        $counts['categories'] = Category::count();
        $counts['products'] = Product::count();
        $counts['clients'] = Client::count();
        $counts['users'] = User::whereRoleIs('admin')->count();

        // To View The Digram
        $year = $request->year?$request->year:date("Y");
        $orders = Order::withTrashed()->whereYear('created_at', '=', $year)->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as sum')
        )->groupBy('month')->get();

        // To View The Clients That Have Big Sales [ ' VIP Clients ' ]
        $vip_clients = Order::withTrashed()->select(
            DB::raw('client_id'),
            DB::raw('SUM(total_price) as total'),
        )->groupBy('client_id')->with('client')->orderBy('total', 'DESC')->take(4)->get();
        // To View The Prodacts That Have Lower Than 10 Units
        $end_stock = Product::where('stock', "<" , 10)->take(5)->get();
        // To View The Products That Have Discount
        $hot_products = Product::with('images')->where('discount', ">" , 0)->take(5)->get();
        // To View The Last Products
        $new_products = Product::whereHas('images')->orderBy('id', 'desc')->take(5)->get();
        // To View The Last Orders
        $last_orders = Order::with('client')->take(5)->get();
        // To View The Last Banner
        $banner = Banner::with('images')->first();

        return view('dashboard.welcome', compact('counts', 'orders', 'year', 'products', 'vip_clients', 'end_stock', 'hot_products', 'new_products', 'last_orders', 'banner'));

    }//end of index



    public function bar(Request $request)
    {
        $year = $request->year?$request->year:date("Y");
        $orders = Order::withTrashed()->with('productsWithTrashed')->with('client')->whereYear('created_at', '=', $year)->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as sum')
        )->groupBy('month')->get();

        return view('dashboard._bar', compact('orders', 'year'));

    }//end of bar


    public function line(Request $request)
    {
        $year = $request->year?$request->year:date("Y");
        $orders = Order::withTrashed()->with('productsWithTrashed')->with('client')->whereYear('created_at', '=', $year)->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as sum')
        )->groupBy('month')->get();

        return view('dashboard._line', compact('orders', 'year'));

    }//end of bar

}//end of controller
