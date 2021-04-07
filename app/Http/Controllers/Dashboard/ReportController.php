<?php

namespace App\Http\Controllers\Dashboard;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{

    public function index()
    {

        return view('dashboard.reports.reports');

    }//end of index

    public function show(Request $request)
    {
        if(isset($request->start) && isset($request->end)){

            $orders = Order::withTrashed()->with('productsWithTrashed')->whereBetween('created_at', [Carbon::parse($request->start), Carbon::parse($request->end)])->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('DAY(created_at) as day'),
                DB::raw('SUM(total_price) as sum'),
                DB::raw('COUNT(*) as count'),
                DB::raw('id'),
                DB::raw('created_at'),
            )
            ->orderBy('created_at', 'ASC')
            ->groupBy('month')->get();

        }else{

            $orders = Order::withTrashed()->with('productsWithTrashed')->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_price) as sum'),
                DB::raw('COUNT(*) as count'),
                DB::raw('id'),
                DB::raw('created_at'),
            )
            ->orderBy('created_at', 'ASC')
            ->groupBy('month')->get();

            $start = date("F", mktime(0, 0, 0, $orders->first()->created_at->month, 10));
            $end = date("F", mktime(0, 0, 0, $orders->last()->created_at->month, 10));
        }
        if(count($orders) > 0){
            $start = date("F", mktime(0, 0, 0, $orders->first()->created_at->month, 10));
            $end = date("F", mktime(0, 0, 0, $orders->last()->created_at->month, 10));
        }else{
            $start = "";
            $end = "";
        }

        return view('dashboard.reports._reports', compact('orders', 'start', 'end'));

    }//end of show


    public function showDay(Request $request)
    {

        $orders = Order::withTrashed()->with('productsWithTrashed')->with('client')->whereMonth('created_at', $request->month)->orderBy('created_at', 'ASC')->get();

        $month = date("F", mktime(0, 0, 0, $request->month, 10));

        $sales = Order::withTrashed()->with('productsWithTrashed')->whereMonth('created_at', $request->month)->select(
            // DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('DAY(created_at) as day'),
            DB::raw('SUM(total_price) as sum')
        )->groupBy('day')->get();

        return view('dashboard.reports.DayReports', compact('orders', 'month', 'sales'));

    }//end of show

}//end of controller
