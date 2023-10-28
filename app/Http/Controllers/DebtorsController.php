<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debtors;
use App\Models\Orders;
use App\Models\Payments;
use Carbon\Carbon;
class DebtorsController extends Controller
{
    public function index()
    {
        $deb = Debtors::where('status',0)->get();
        return view('page.debtors.index',compact('deb'));
    }

     public function read($id)
    {
        $deb = Debtors::find($id);
        $deb2= Orders::where('debtors_id',$id)->get();
        $deb3= Payments::where('debt_id',$id)->get();
        return view('page.debtors.find', compact('deb','deb2','deb3'));
    }
    public function storeid(Request $request)
    {
        
        $request->validate([
            'amount' => 'required',
        
        ],
            [
                'amount.required' => "กรุณาป้อนจำนวนเงิน",
             
               
            ],

        );

        $tableName = new Payments();
        $tableName->debt_id  = $request->debt_id ;
        $tableName->amount = $request->amount;
      
        $tableName->save();

        return redirect()->back()->with('success', "บันทึกข้อมูลเรียบร้อย");
    }
   

    public function update(Request $request, $id)
    {

       
        $request->validate([
            'status' => 'required',
        ],

            ['status.required' => "กรุณาป้อนสถานะ",
              
            ]
        );

        Debtors::find($id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('update', "อัพเดตข้อมูลเรียบร้อย");
        // return redirect()->route('usermanager')->with('success',"อัพเดตข้อมูลเรียบร้อย");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:debtors',
        ],
            [
                'name.required' => "กรุณาป้อนชื่อ",
                'address.required' => "กรุณาป้อนที่อยู่",
                'phone.required' => "กรุณาป้อนเบอร์โทร",
                'email.required' => "กรุณาป้อนรหัสบัตร",
                'email.unique' => "รหัสบัตรซ้ำ",
               
            ],

        );

        $tableName = new Debtors();
        $tableName->name = $request->name;
        $tableName->address = $request->address;
        $tableName->phone = $request->phone;
        $tableName->email  = $request->email ;
        $tableName->save();
        return redirect()->route('debtors.index')->with('success', "บันทึกข้อมูลเรียบร้อย");

    }
}
