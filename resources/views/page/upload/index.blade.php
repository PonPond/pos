

@extends('layouts.shop')

@section('content')
    <div class="col-lg-4">
        <div class="card ">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">อัปโหลดไฟล์</h6>
                    </div>

                </div>
            </div>
            <div class="card-body p-3 pb-0">

                <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                    <form id="post-form">
                        @csrf
                        <div class="row">
                    
                            <div class="input-group input-group-outline my-3">
                                <input type="file" class="form-control"  name="file">
                            </div>

                    
                            <button type="input" class="btn btn-success">Upload</button>


                        </div>

                    </form>
            </div>
        </div>

        <br><br>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>สำเร็จ !</strong> เพิ่มข้อมูลไฟล์เรียบร้อย
            </div>
        @endif


        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                <strong>พบข้อผิดพลาด !</strong> ไม่พบข้อมูลไฟล์
            </div>
        @endif

        @if (session('delete'))
        <div class="alert alert-danger" role="alert">
            <strong>สำเร็จ !</strong> ลบข้อมูลเรียบร้อย
        </div>
    @endif

    @if (session('errorfile'))
            <div class="alert alert-danger" role="alert">
                <strong>พบข้อผิดพลาด !</strong> ไฟล์ขนาดเกิน 10 mb หรือประเภทไม่เป็นเอกสาร
            </div>
        @endif
  
       
    </div>

    <div class="col-lg-7">

        <div class="card">
            <div class="card-header p-3 pt-2">
                
              
                <h5>ไฟล์ทั้งหมด</h5> 

            </div>
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="myTable">
                    <thead>
                        <tr>

                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ชื่อไฟล์
                            </th>
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                เวลาที่เพิ่ม</th>

                            
                        </tr>
                    </thead>

                    <tbody>


                    @foreach ($files as $file)
                            <tr>
                                <td>
                                <div class="d-flex px-2">
                                        <div class="my-auto">
                                            <b>
                                            {{ $file->filename }}
                                            </b>

                                        </div>
                                    </div>
                             

                                </td>
                                <td>
                                    <b>{{ $file->created_at }}</b>

                                </td>

                                <td>
             
                                <a href="{{ route('download', ['id' => $file->id]) }}"class="btn btn-secondary btn-sm bg-gradient-success mb-3"
                                                onclick="return confirm('โหลดไฟล์หรือไม่ ?')"> Download </a>
     
            <form action="{{ route('file.delete', ['id' => $file->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-secondary btn-sm bg-gradient-danger mb-3" onclick="return confirm('ยืนยันการลบไฟล์ ?')">Delete</button>
             </form>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>



@endsection
 
