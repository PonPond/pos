@extends('layouts.shop')
@inject('ThaiFormat', 'App\Services\ThaiDate')
@section('content')
    <div class="col-lg-12">

        <div class="card">
            <div class="card-header p-3 pt-2">

                <h5>สินค้าขายดีค้นหาจากวันที่</h5>
            </div>
            <form action="{{ route('finddash1') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-3" style="margin-left: 10px">
                        <div class="input-group input-group-static my-3">
                            <label>เวลาเริ่มต้น</label>
                            <input type="date" class="form-control" name="start">
                        </div>
                    </div>

                    <div class="col-3" style="margin-left: 10px">
                        <div class="input-group input-group-static my-3">
                            <label>เวลาสิ้นสุด</label>
                            <input type="date" class="form-control" name="end">
                        </div>
                    </div>

                    <div class="col-3">
                        <button type="submit" class="btn bg-gradient-success" style="margin-top: 10%">ค้นหา</button>
                    </div>
                </div>
            </form>

        </div>

        <br>




        <div class="card">
            <div class="card-header p-3 pt-2">

                <h5>ข้อมูล</h5>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="myTable">
                    <thead>
                        <tr>

                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ลำดับ
                            </th>
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ชื่อสินค้า
                            </th>
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                จำนวน
                            </th>

                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ราคารวม</th>


                            <th>

                            </th>

                        </tr>
                    </thead>

                    <tbody>






                        <tr>
                            <td>

                                <div class="d-flex px-2">
                                    <div class="my-auto">
                                        <b>

                                        </b>

                                    </div>
                                </div>
                            </td>

                            <td>




                            </td>

                            <td>
                                <b></b>

                            </td>
                            <td>


                            </td>
                            <td>

                            </td>


                        </tr>



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
