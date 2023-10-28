<?php

namespace App\Http\Controllers;

use App\Models\all;
use App\Models\Orders;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF1($id)
    {

        $print = Orders::find($id);

        $pdf = PDF::loadView('page.export.index', compact('print'))->setPaper('a4');

        // download PDF file with download method
        // return $pdf->download('pdf_file.pdf');
//        return $pdf->stream('pdf_file.pdf');

     return view('page.export.index',compact('print'));

    }

    public function generatePDF2($id)
    {
        $print = Orders::find($id);
        $pdf = PDF::loadView('page.export.indexorder', compact('print'))->setPaper('a4');

        // download PDF file with download method
        // return $pdf->download('pdf_file.pdf');
//        return $pdf->stream('pdf_file.pdf');

     return view('page.export.indexorder',compact('print'));

    }

    public function generateA4($id)
    {
        $print = Orders::find($id);
        $pdf = PDF::loadView('page.export.A4', compact('print'))->setPaper('a4');

        // download PDF file with download method
        // return $pdf->download('pdf_file.pdf');
//        return $pdf->stream('pdf_file.pdf');

     return view('page.export.A4',compact('print'));

    }
}
