<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;


use Illuminate\Support\Facades\Storage; 
class FileController extends Controller
{
    public function showUploadForm()
    {

        $files = File::all(); 
        return view('page.upload.index',compact('files'));
    }
    
    public function upload(Request $request)
    {
        $file = $request->file('file');
    
        // ตรวจสอบว่ามีไฟล์ถูกอัปโหลดหรือไม่
        if (!$file) {
            return redirect()->route('upload.form')->with('errorfile', 'No file selected.');
        }
    
        // ตรวจสอบขนาดไฟล์
        if ($file->getSize() > 10240000) { // 10 MB
            return redirect()->route('upload.form')->with('errorfile', 'File size exceeds 10 MB.');
        }
    
        // ตรวจสอบชนิดของไฟล์
        $allowedExtensions = ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx','pdf'];
        $extension = $file->getClientOriginalExtension();
        if (!in_array($extension, $allowedExtensions)) {
            return redirect()->route('upload.form')->with('errorfile', 'Invalid file format. Allowed formats are: doc, docx, xls, xlsx, ppt, pptx.');
        }
    
        // กำหนดเส้นทางที่คุณต้องการเก็บไฟล์ (ในที่นี้คือ "upload")
        $path = 'upload'; // ชื่อโฟลเดอร์ที่คุณต้องการ
    
        // ใช้ store() เพื่อบันทึกไฟล์ในโฟลเดอร์ที่คุณกำหนด
        $uploadedFile = $file->store($path);
    
        // เพิ่มข้อมูลไฟล์ลงในฐานข้อมูล
        $newFile = new File();
        $newFile->filename = $file->getClientOriginalName();
        $newFile->path = $uploadedFile; // เส้นทางที่ไฟล์ถูกเก็บไว้
        $newFile->save();
    
        return redirect()->route('upload.form')->with('success', 'File uploaded successfully.');
    }
    

    public function download($id)
{
    $file = File::find($id);
    if (!$file) {
        abort(404);
    }

    return response()->download(storage_path('app/' . $file->path), $file->filename);
}

public function delete($id)
{
    $file = File::find($id);
    if (!$file) {
        return redirect()->route('upload.form')->with('error', 'File not found.');
    }

    // ลบไฟล์จากเครื่องแม่ข่าย (host filesystem)
    Storage::delete($file->path);

    // ลบข้อมูลจากฐานข้อมูล
    $file->delete();

    return redirect()->route('upload.form')->with('delete', 'File deleted successfully.');
}


    
}
