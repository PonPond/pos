<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function index($id) 
    {
        
       
        $productCode =  $id;
       
        return view('page.barcode.barcode', [
            'productCode' => $productCode
        ]);
    }
}