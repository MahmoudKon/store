<?php

namespace App\Http\Controllers\Dashboard;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->date) && isset($request->name)){
            $orders = Order::whereHas('client', function ($q) use ($request) {

                return $q->where('first_name', 'like', '%' . $request->name . '%');

            })->whereDate('created_at', '=', Carbon::parse($request->date))->paginate(5);

        }elseif(isset($request->date)){
            $orders = Order::whereHas('client', function ($q) use ($request) {

                return $q->where('first_name', 'like', '%' . $request->name . '%');

            })->whereDate('created_at', '=', Carbon::parse($request->date))->paginate(5);

        }else{
            $orders = Order::whereHas('client', function ($q) use ($request) {

                return $q->where('first_name', 'like', '%' . $request->name . '%')
                        ->orWhere('last_name', 'like', '%' . $request->name . '%')
                        ->orWhere('total_price', 'like', '%' . $request->name . '%');

            })->paginate(5);
        }

        return view('dashboard.orders.index', compact('orders'));

    }//end of index

    public function products($id)
    {
        $order = Order::withTrashed()->find($id);
        $products = $order->productsWithTrashed;
        $client = $order->client;
        return view('dashboard.orders._products', compact('order', 'products', 'client'));

    }//end of products

    public function destroy(Order $order)
    {

        $order->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.orders.index');

    }//end of order


    public function deleted(Request $request)
    {
        if(isset($request->date) && isset($request->name)){
            $orders = Order::onlyTrashed()->whereHas('client', function ($q) use ($request) {

                return $q->withTrashed()->where('first_name', 'like', '%' . $request->name . '%');

            })->whereDate('created_at', '=', Carbon::parse($request->date))->paginate(5);

        }elseif(isset($request->date)){
            $orders = Order::onlyTrashed()->whereHas('client', function ($q) use ($request) {

                return $q->withTrashed()->where('first_name', 'like', '%' . $request->name . '%');

            })->whereDate('created_at', '=', Carbon::parse($request->date))->paginate(5);

        }elseif(isset($request->name)){

            $orders = Order::onlyTrashed()->whereHas('client', function ($q) use ($request) {

                return $q->where('first_name', 'like', '%' . $request->name . '%')
                        ->orWhere('last_name', 'like', '%' . $request->name . '%')
                        ->orWhere('total_price', 'like', '%' . $request->name . '%');
            })->paginate(5);

        }else{
            $orders = Order::onlyTrashed()->with('client')->paginate(5);
        }

        return view('dashboard.orders.deleted', compact('orders'));

    }//end of deleted

    public function restore($id)
    {

        Order::onlyTrashed()->find($id)->restore();
        session()->flash('success', __('site.restore_successfully'));
        return redirect()->back();

    }// end of restore

}//end of controller
