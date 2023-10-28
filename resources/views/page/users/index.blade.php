@extends('layouts.shop')
@inject('ThaiFormat', 'App\Services\ThaiDate')
@section('content')
 

    <div class="col-lg-12">

        <div class="card">
            <div class="card-header p-3 pt-2">

                <h5>รายการพนักงานขาย</h5>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="myTable">
                    <thead>
                        <tr>

                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ชื่อ - นามสกุล
                            </th>
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ตำแหน่ง
                            </th>

                            {{-- <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                หนี้รวม
                            </th>

                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ยอดรวมที่ชำระ
                            </th> --}}

                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                เวลาที่เพิ่ม</th>

                            <th></th>
                        </tr>
                    </thead>

                    <tbody>


                        @foreach ($user as $item)
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
                                    @if ($item->role == 0)
                                    <span class="badge badge-pill badge-lg bg-gradient-success">พนักงานขาย</span>
                                    @else
                                    <span class="badge badge-pill badge-lg bg-gradient-warning">แอดมิน</span>
                                    @endif
                                               

                                </td>
                                {{-- <td>
                                    <b>
                                        {{ $item->total_debts }}
                                    </b>

                        </td>
                        <td>
                            <b>
                                {{ $item->total_payments }}
                            </b>

                       </td> --}}

                                <td>
                                    <b> {{ $ThaiFormat->makeFormat($item->created_at) }}</b>

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
                                                        <b>แก้ไขข้อมูลพนักงาน</b>
                                                    </h6>
                                                    <button type="button" class="btn-close text-dark"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="p-4">
                                                        <form action="{{ url('/user-update/' . $item->id) }}"
                                                            method="post">
                                                            @csrf


                                                            <div class="row">

                                                                <div class="col-12">
                                                                    <div class="input-group input-group-static mb-4">
                                                                        <label><b>ชื่อ-นามสกุล</b></label>
                                                                        <input type="text" class="form-control" name="name" value="{{$item->name}}">
                                                                    </div>
                                                                </div>

                                                                <div class="input-group input-group-outline mb-1">
                                                                    <select class="form-control" id="exampleFormControlSelect1" name="role">
                                                                        <option>กรุณาเลือกประเภท</option>
                                                                     
                                                                            <option value="0">พนักงานขาย</option>
                                                                            <option value="1">แอดมิน</option>
                                                                       
                                                                    </select>
                                                                </div>
                                                                
                                                            


                                                            </div>
                                                            <br><br><br>

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
