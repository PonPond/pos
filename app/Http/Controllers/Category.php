<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class Category extends Controller
{
    public function index()
    {
        $typeCategory = Categories::all();

        return view('page.product.category', compact('typeCategory'));
    }

    
    public function store(Request $request)
    {
        $tableName = new Categories();
        $tableName->name = $request->name;
        $tableName->save();

        return redirect()->route('product.category')->with('success', "บันทึกข้อมูลเรียบร้อย");

    }

    public function update(Request $request, $id)
    {

        $request->validate([

            'name' => 'required',
           

        ],

            ['name.required' => "กรุณาป้อนชื่อประเภท",
              

            ]
        );
        Categories::find($id)->update([

            'name' => $request->name,
           

        ]);

        return redirect()->back()->with('update', "อัพเดตข้อมูลเรียบร้อย");
        // return redirect()->route('usermanager')->with('success',"อัพเดตข้อมูลเรียบร้อย");
    }

    public function delete($id)
    {

        //ลบข้อมูล
        $delete = Categories::find($id)->delete();
        return redirect()->back()->with('delete', "ลบเรียบร้อยแล้ว");

    }


}
