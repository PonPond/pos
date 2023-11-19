@extends('layouts.shop')
@inject('ThaiFormat', 'App\Services\ThaiDate')
@section('content')
    <div class="col-lg-2">
        <div class="card ">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">เพิ่มลูกหนี้</h6>
                    </div>

                </div>
            </div>
            <div class="card-body p-3 pb-0">

                <form action="{{ route('debtors_store') }}" method="POST" enctype="multipart/form-data">
                    <form id="post-form">
                        @csrf
                        <div class="row">

                            <div class="input-group input-group-outline my-3">
                                <input type="text" class="form-control" placeholder="ชื่อ-นามสกุล" name="name">
                              
                            </div>
                            @error('name')
                            <div class="my-2">
                                <span class="text-danger my-2"> {{ $message }} </span>
                            </div>
                            @enderror
                           
                            <div class="input-group input-group-outline my-3">
                                <input type="text" class="form-control" placeholder="ที่อยู่" name="address">
                               
                            </div>
                            @error('address')
                            <div class="my-2">
                                <span class="text-danger my-2"> {{ $message }} </span>
                            </div>
                            @enderror
                            <div class="input-group input-group-outline my-3">
                                <input type="text" class="form-control" placeholder="เบอร์โทร" name="phone">
                             
                            </div>
                            @error('phone')
                            <div class="my-2">
                                <span class="text-danger my-2"> {{ $message }} </span>
                            </div>
                            @enderror
                            <div class="input-group input-group-outline my-3">
                                <input type="text" class="form-control" placeholder="รหัสบัตรประชาชน" name="email">
                              
                            </div>
                            @error('email')
                            <div class="my-2">
                                <span class="text-danger my-2"> {{ $message }} </span>
                            </div>
                            @enderror


                            <button type="input" class="btn btn-success">Add Debtors</button>


                        </div>

                    </form>
            </div>
        </div>

        <br><br>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>สำเร็จ !</strong> เพิ่มลูกหนี้เรียบร้อย
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                <strong>พบข้อผิดพลาด !</strong> ไม่พบสินค้าในฐานข้อมูล
            </div>
        @endif

    </div>

    <div class="col-lg-10">

        <div class="card">
            <div class="card-header p-3 pt-2">

                <h5>รายการลูกหนี้</h5>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="myTable">
                    <thead>
                        <tr>

                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ชื่อ
                            </th>
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                เบอร์โทร
                            </th>
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                เลขบัตร
                            </th>

                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ที่อยู่
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


                        @foreach ($deb as $item)
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
                                            <b>
                                                {{ $item->phone }}
                                            </b>

                                </td>

                                <td>
                                            <b>
                                                {{ $item->email }}
                                            </b>

                                </td>

                                <td>
                                            <b>
                                                {{ $item->address }}
                                            </b>

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
                                        data-bs-toggle="modal" data-bs-target="#modal-default{{$item->id}}"> ปิดการใช้งาน</button>

                                    <div class="modal fade" id="modal-default{{$item->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="modal-default" aria-hidden="true">
                                        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title font-weight-normal" id="modal-title-default">
                                                        <b>ปิดการใช้งานลูกหนี้</b>
                                                    </h6>
                                                    <button type="button" class="btn-close text-dark"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="p-4">
                                                        <form action="{{ url('/debtors/update/' . $item->id) }}"
                                                            method="post">
                                                            @csrf


                                                            <div class="row">

                                                                <div class="col-12">
                                                                    <div class="input-group input-group-static mb-4">
                                                                        <input type="hidden" class="form-control" name="status" value="1">
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

                                    <a href="{{ url('/debtors/' . $item->id) }}" class=" btn btn-primary"
                                        style="width: 80%;margin-left: 10% "> ดูรายการหนี้ทั้งหมด</a>
                                
                              

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
