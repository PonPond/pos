<?php

namespace App\Http\Controllers;


use App\Models\Order_product;
use App\Models\Product;
use App\Models\Refund;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class RefundController extends Controller
{
    //
    public function index()
    {
        $refund = Refund::orderBy('created_at', 'desc')->get();
        return view('page.refund.index',compact('refund'));
    }

    public function addToRefund(Request $request)
    {

      
        $delete = Order_product::where('product_id',$request->id_product)->get();
        
        if (empty($delete[0])) {
            session()->flash('error', 'Product is Added to Cart Successfully !');
        }else{
            $updateP = Product::where('id_product',$request->id_product)->first();
           
    $tableName = new Refund();
    $tableName->name = $updateP->name;
    $tableName->key_slug = $updateP->id_product;
    $tableName->priceP = $updateP->priceP;
    $tableName->priceS = $updateP->priceS;
    $tableName->qty = $request->qty;
    $tableName->save();

    Product::where('id_product',$request->id_product)->update([
        'qty' => $updateP->qty+$request->qty,
    ]);
           

     
        }
       
    

        return redirect()->route('refund.index');

    }

             
    

}
