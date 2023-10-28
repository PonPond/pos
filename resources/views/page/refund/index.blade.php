@inject('ThaiFormat', 'App\Services\ThaiDate')
@extends('layouts.shop')
@section('content')
    <div class="col-3 mt-2">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">storefront</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">สแกนบาร์โค้ดคืนสินค้า</p>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">

                <form action="{{ route('refund.delete') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="input-group input-group-outline my-3">
                                <input type="text" class="form-control" placeholder="จำนวนที่คืน" name="qty">
                            </div>

                    <div class="input-group input-group-outline my-3">
                                <input type="text" class="form-control" placeholder="BARCODE ID" name="id_product">
                            </div>


                            <button type="input" class="btn btn-success">Add Category</button>


                </form>
            </div>
        </div>



        <br>



        <br><br>


        @if (session('ok'))

            <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                <span class="alert-text">  <strong>สำเร็จ !</strong> คืนรายการขายเรียบร้อย</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('success'))

            <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                <span class="alert-text">  <strong>สำเร็จ !</strong> เพิ่มสินค้าลงในรายการขายเรียบร้อย</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible text-white fade show" role="alert">
                <span class="alert-text">  <strong>พบข้อผิดพลาด !</strong> ไม่พบสินค้าในฐานข้อมูล</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('delete'))
            <div class="alert alert-warning alert-dismissible text-white fade show" role="alert">
                <span class="alert-text">  <strong>สำเร็จ !</strong> ลบสินค้าออกจากรายการขายเรียบร้อย</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('update'))
            <div class="alert alert-warning alert-dismissible text-white fade show" role="alert">
                <span class="alert-text">  <strong>สำเร็จ !</strong> อัพเดทจำนวนเรียบร้อย</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('deleteall'))
        <div class="alert alert-warning alert-dismissible text-white fade show" role="alert">
            <span class="alert-text">  <strong>สำเร็จ !</strong> ลบข้อมูลทั้งหมดเรียบร้อย</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
       

    </div>

    <div class="col-lg-9">

        <div class="card">
            <div class="card-header p-3 pt-2">

                <h5>รายการคืนสินค้า</h5>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="myTable">
                    <thead>
                        <tr>

                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ชื่อสินค้า
                            </th>
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                เวลาที่คืน</th>

                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                จำนวน</th>

                           
                        </tr>
                    </thead>

                    <tbody>


                        @foreach ($refund as $item)
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

                                <td>
                                    <b>{{ $item->qty }}</b>

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

     

        <script>
            window.onload = function() {
                document.getElementById("inputkey").focus();
            }
        </script>


     
    @endsection
