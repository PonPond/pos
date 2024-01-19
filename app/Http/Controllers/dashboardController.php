<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class dashboardController extends Controller
{
    public function dash1()
    {
        
        return view('page.dashboard.index1');
    }
    public function dash1find(Request $request)
    {
        $from = $request->start;
        $to = $request->end;
      
        
        // $orders = DB::table('order_products')
        //         ->join('products', 'order_products.product_id', 'products.id_product')
        //         ->select('products.name',DB::raw('SUM(quantity) as total_qty'),DB::raw('SUM(price) as total_price'))
        //         ->whereBetween('order_products.created_at', [$from, $to])
        //         ->groupBy('products.name')
        //         ->orderBy('total_qty', 'desc')
        //         ->get();
             $orders = DB::table('order_products')
                ->join('products', 'order_products.product_id', 'products.id_product')
                ->join('orders', 'order_products.order_id', 'orders.id')
                ->select('products.name','order_products.price',DB::raw('SUM(quantity) as total_qty'))
                ->whereBetween('order_products.created_at', [$from, $to])
                ->groupBy('products.name','order_products.price')
                ->orderBy('total_qty', 'desc')
                ->get();

                
              
                $orders1 = DB::table('orders')
                ->select('type_sale',DB::raw('SUM(total_price) as total'))
                ->whereBetween('created_at', [$from, $to])
                ->groupBy('type_sale')
                ->orderBy('total', 'desc')
                ->get();

               

                $orders2 = DB::table('orders')
                ->whereBetween('created_at', [$from, $to])
                ->where('type_sale','ค้างชำระ')
                ->sum('total_price');
              
           

    // $refund = DB::table('refunds')
    // ->whereBetween('created_at', [$from, $to])
    // ->sum('priceP');

    $result = DB::table('refunds')
    ->whereBetween('created_at', [$from, $to])
    ->selectRaw('SUM(priceP * qty) as total')
    ->first();

    $refund = $result->total;


    $payment = DB::table('payments')
    ->whereBetween('created_at', [$from, $to])
    ->sum('amount');

    
    $fix = DB::table('orders')
    ->whereBetween('created_at', [$from, $to])
    ->sum('fix_cost');

    
     
        
        return view('page.dashboard.index1find',compact('orders','from','to','orders1','refund','payment','orders2','fix'));
    }

    
}
