<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payments;

class paymentController extends Controller
{
    public function delete($id)
    {

        //ลบข้อมูล
        $delete = Payments::find($id)->delete();
        return redirect()->back()->with('delete', "ลบเรียบร้อยแล้ว");

    }
}
