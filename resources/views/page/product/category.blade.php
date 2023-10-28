@extends('layouts.shop')

@section('content')
    <div class="col-lg-2">
        <div class="card ">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">ประเภทสินค้า</h6>
                    </div>

                </div>
            </div>
            <div class="card-body p-3 pb-0">

                <form action="{{ route('category_store') }}" method="POST" enctype="multipart/form-data">
                    <form id="post-form">
                        @csrf
                        <div class="row">

                            <div class="input-group input-group-outline my-3">
                                <input type="text" class="form-control" placeholder="ชื่อประเภท" name="name">
                            </div>


                            <button type="input" class="btn btn-success">Add Category</button>


                        </div>

                    </form>
            </div>
        </div>

        <br><br>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>สำเร็จ !</strong> เพิ่มประเภทสินค้าเรียบร้อย
            </div>
        @endif

        @if (session('update'))
        <div class="alert alert-success" role="alert">
            <strong>สำเร็จ !</strong> แก้ไขประเภทสินค้าเรียบร้อย
        </div>
         @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                <strong>พบข้อผิดพลาด !</strong> ไม่พบสินค้าในฐานข้อมูล
            </div>
        @endif

        @if (session('delete'))
        <div class="alert alert-danger" role="alert">
            <strong>สำเร็จ !</strong> ลบข้อมูลประเภทเรียบร้อย
        </div>
    @endif

    </div>

    <div class="col-lg-10">

        <div class="card">
            <div class="card-header p-3 pt-2">

                <h5>รายการประเภทสินค้า</h5>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="myTable">
                    <thead>
                        <tr>

                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ชื่อประเภทสินค้า
                            </th>
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                เวลาที่เพิ่ม</th>

                            <th></th>
                        </tr>
                    </thead>

                    <tbody>


                        @foreach ($typeCategory as $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-2">
                                        <div class="my-auto">
                                            <b>
                                                {{ $item->name }}
                                            </b>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <b>{{ $item->created_at }}</b>

                                </td>


                                <td class="align-middle">

                                    <button type="button" class="btn btn-secondary btn-sm bg-gradient-secondary mb-3  "
                                        data-bs-toggle="modal" data-bs-target="#modal-default{{$item->id}}"> <i
                                            class="far fa-edit"></i></button>

                                            {{-- <a href="{{ url('/category/delete/' . $item->id) }}"class="btn btn-secondary btn-sm bg-gradient-danger mb-3"
                                                onclick="return confirm('ลบหรือไม่ ?')"> ลบข้อมูล</a> --}}

                                    <div class="modal fade" id="modal-default{{$item->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="modal-default" aria-hidden="true">
                                        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title font-weight-normal" id="modal-title-default">
                                                        <b>แก้ไขประเภทสินค้า</b>
                                                    </h6>
                                                    <button type="button" class="btn-close text-dark"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="p-4">
                                                        <form action="{{ url('/category-update/' . $item->id) }}"
                                                            method="post">
                                                            @csrf


                                                            <div class="row">

                                                                <div class="col-12">
                                                                    <div class="input-group input-group-static mb-4">
                                                                        <label><b>ชื่อประเภทสินค้า</b></label>
                                                                        <input type="text" class="form-control" name="name" value="{{$item->name}}">
                                                                    </div>
                                                                </div>


                                                            </div>

                                                            <div >
                                                                <button type="submit" class="btn bg-gradient-success">บันทึก</button>
                                                                <button type="button" class="btn btn-link  ml-auto"
                                                                    data-bs-dismiss="modal">ปิด</button>
                                                            </div>
                                                        </form>
                                                      
                                                    </div>
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>



    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true,
                paging: true,
                lengthMenu: [10, 25, 50, 75, 100, 10000],
                ordering: false,
                info: false,

                "language": {
                    "search": "<b>ค้นหา</b>",
                    "zeroRecords": "ไม่พบข้อมูล - ขออภัย",
                    "info": '',
                    "infoEmpty": "ไม่มีข้อมูล",
                    "infoFiltered": "",
                    "lengthMenu": "   _MENU_ ",
                    "paginate": {
                        "previous": false,
                        "next": false
                    }
                }
            });
        });
    </script>
@endsection
