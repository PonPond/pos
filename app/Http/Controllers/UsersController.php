<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UsersController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('page.users.index',compact('user'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([

            'name' => 'required',
           

        ],

            ['name.required' => "กรุณาป้อนชื่อ",
              

            ]
        );
        User::find($id)->update([

            'name' => $request->name,
            'role' => $request->role,

        ]);

        return redirect()->back()->with('update', "อัพเดตข้อมูลเรียบร้อย");
        // return redirect()->route('usermanager')->with('success',"อัพเดตข้อมูลเรียบร้อย");
    }
}
