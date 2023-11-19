<?php

namespace App\Http\Controllers;
use DataTables;
use App\Models\Orders;
use App\Models\Order_product;
use App\Models\Product;
use App\Models\Debtors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class ListAll extends Controller
{

    public function index(Request $request)
    {
         if ($request->ajax()) {
 
            $data = DB::table('orders')
            ->select('orders.*')
            ->where('type', 'ขายปลีก')
            ->orderByDesc('created_at');
            
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $actionButtons = '<a href="' . url('/generate-pdf2/' . $data->id) . '" style="margin: 0%;" target="_blank" class="text-danger"> ออกใบเสร็จ <i class="fas fa-print"></i></a>';
                
                $actionButtons .= '<a href="' . url('/generate-a4/' . $data->id) . '" style="margin: 0%;" target="_blank" class="text-success"> A4 <i class="fas fa-print"></i></a>';
            
                return $actionButtons;
            })
            ->addColumn('action1', function ($data) {
                // Define $actionButtons1 before appending to it
                $actionButtons1 = '';
            
                if (Auth::user()->role == 1) {
                    $actionButtons1 .= '<a href="' . url('/listall/delete/' . $data->id) . '" class="btn btn-secondary btn-sm bg-gradient-danger mb-3" onclick="return confirm(\'ลบหรือไม่ ?\')"> ลบข้อมูล</a>';
                }   
                
                return $actionButtons1;
            })
            ->rawColumns(['action', 'action1'])

            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->search['value'])) {
                    $searchValue = $request->search['value'];
                    $searchTerms = explode(' ', $searchValue);
                    
                    $query->where(function($subquery) use ($searchTerms) {
                        foreach ($searchTerms as $term) {
                            $subquery->where(function($subquery) use ($term) {
                                $subquery->where('slip_id', 'like', "%$term%");
                                         
                            });
                        }
                    });
                }
            })
            ->make(true);
    }

        return view('page.order.index');
    }

    public function indexS(Request $request)
    {
        if ($request->ajax()) {
 
            $data = DB::table('orders')
            ->where('type', 'ขายส่ง')
            ->select('orders.*')
            ->orderByDesc('created_at');
            
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $actionButtons = '<a href="' . url('/generate-pdf2/' . $data->id) . '" style="margin: 0%;" target="_blank" class="text-danger"> ออกใบเสร็จ <i class="fas fa-print"></i></a>';
                
                $actionButtons .= '<a href="' . url('/generate-a4/' . $data->id) . '" style="margin: 0%;" target="_blank" class="text-success"> A4 <i class="fas fa-print"></i></a>';
            
                return $actionButtons;
            })
            ->addColumn('action1', function ($data) {
                // Define $actionButtons1 before appending to it
                $actionButtons1 = '';
            
                if (Auth::user()->role == 1) {
                    $actionButtons1 .= '<a href="' . url('/listall/delete/' . $data->id) . '" class="btn btn-secondary btn-sm bg-gradient-danger mb-3" onclick="return confirm(\'ลบหรือไม่ ?\')"> ลบข้อมูล</a>';
                }   
                
                return $actionButtons1;
            })
            ->rawColumns(['action', 'action1'])

            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->search['value'])) {
                    $searchValue = $request->search['value'];
                    $searchTerms = explode(' ', $searchValue);
                    
                    $query->where(function($subquery) use ($searchTerms) {
                        foreach ($searchTerms as $term) {
                            $subquery->where(function($subquery) use ($term) {
                                $subquery->where('slip_id', 'like', "%$term%");
                                         
                            });
                        }
                    });
                }
            })
            ->make(true);
    }


        return view('page.order.indexS');
    }



    public function store(Request $request)
    {

     
        if($request->type_sale == "ค้างชำระ"){
            $request->validate([
                'amount' => 'required',
                'change' => 'required',
                'debtors_id' =>'required',
            ],
                [
                    'amount.required' => "กรุณาใส่จำนวนเงินที่รับ",
                    'change.required' => "กรุณากดคำนวณเงินทอน",
                    'debtors_id.required' => "กรุณาใส่รหัสผู้ค้างชำระ",
                ],
    
            );
        }else{
            $request->validate([
                'amount' => 'required',
                'change' => 'required',
                
            ],
                [
                    'amount.required' => "กรุณาใส่จำนวนเงินที่รับ",
                    'change.required' => "กรุณากดคำนวณเงินทอน",
                    
                ],
    
            );
        }
     
     
        $id = IdGenerator::generate(['table' => 'orders', 'field' => 'slip_id', 'length' => 17, 'prefix' => 'SLIP-']);

        $tableName = new Orders();

        $tableName->user_id = Auth::user()->id;
        $tableName->user_auth = Auth::user()->name;
        $tableName->slip_id = $id;
        $tableName->total_price = $request->total_price;
        $tableName->type_sale = $request->type_sale;
        $tableName->type = $request->type;
        $tableName->amount = $request->amount;
        $tableName->change = $request->change;
        $tableName->listall = $request->listall;
        $tableName->listcount = $request->quantity;
        $tableName->listprice = $request->price;
        $tableName->debtors_id = $request->debtors_id;
        
        $tableName->save();

       
        $orders = DB::table('orders')
            ->orderBy('id', 'desc')
            ->first();


        for ($i = 0; $i < count($request->product_id); $i++) {
            $table = new Order_product();
        $table->order_id  = $orders->id;
        $table->product_id = $request->product_id[$i];
        $table->quantity = $request->quantity[$i];
        $table->price = $request->price[$i];
            $table->save();
        }

     
  
        for ($i = 0; $i < count($request->id); $i++) {
            // $product1 = Product::find('1');
            // dd( $product1);
            $product1 = Product::where('id_product',$request->id[$i])->first();
            $sumtotal = $product1->qty;

            Product::where('id_product',$request->id[$i])->
            update([

            'qty' => $sumtotal - $request->quantity[$i],
        ]);

      

        $deb = Debtors::find($request->debtors_id);
        
       if($deb != null){
            $debtotal = $deb->total_debts;
            Debtors::find($request->debtors_id)->
            update([
                'total_debts' =>$debtotal + $request->total_price,
            ]);
        }
      

        
        }
        \Cart::clear();

        // return redirect()->route('shopP')->with('ok', 'addlistall!');
        return redirect()->back()->with('ok', 'addlistall');   
    }

    public function delete($id)
    {

        //ลบข้อมูล
        $delete = Orders::find($id)->delete();
        return redirect()->back()->with('delete', "ลบเรียบร้อยแล้ว");

    }
}
