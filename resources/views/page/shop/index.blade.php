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
                    <p class="text-sm mb-0 text-capitalize">สแกนบาร์โค้ด</p>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">

                <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="input-group input-group-static mb-4">
                        <input type="text" class="form-control" name="name" id="inputkey" placeholder="BARCODE ID">
                    </div>
                </form>
            </div>
        </div>



        <br>

        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">print</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">ใบเสร็จล่าสุด</p>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        <b>วันที่ขาย</b>
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        <b>ออกใบเสร็จ</b>
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        <b>รหัสใบเสร็จ</b>
                                    </th>



                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listall as $item)
                                    <tr>

                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    {{ $ThaiFormat->makeFormat($item->created_at) }}

                                                </div>
                                            </div>
                                        </td>

                                        <td>

                                            <button type="button" class="btn btn-outline-info"
                                                onclick="printreceiptContent('print')">
                                                พิมพ์
                                            </button>
                                            <div class="modal">
                                                <div id="print">
                                                    @include('page.export.index')
                                                </div>
                                            </div>

                                            {{-- <a   href="{{ URL::to('generate-pdf/' . $item->id) }}"
                                        target="_blank"  class="text-danger" > ออกใบเสร็จ <i class="fas fa-print"></i></a> --}}




                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    {{ $item->total_price }}
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
        </div>
        @if (session('ok'))
            <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                <span class="alert-text"> <strong>สำเร็จ !</strong> เพิ่มรายการขายเรียบร้อย</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                <span class="alert-text"> <strong>สำเร็จ !</strong> เพิ่มสินค้าลงในรายการขายเรียบร้อย</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible text-white fade show" role="alert">
                <span class="alert-text"> <strong>พบข้อผิดพลาด !</strong> ไม่พบสินค้าในฐานข้อมูล</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('delete'))
            <div class="alert alert-warning alert-dismissible text-white fade show" role="alert">
                <span class="alert-text"> <strong>สำเร็จ !</strong> ลบสินค้าออกจากรายการขายเรียบร้อย</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('update'))
            <div class="alert alert-warning alert-dismissible text-white fade show" role="alert">
                <span class="alert-text"> <strong>สำเร็จ !</strong> อัพเดทจำนวนเรียบร้อย</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('deleteall'))
            <div class="alert alert-warning alert-dismissible text-white fade show" role="alert">
                <span class="alert-text"> <strong>สำเร็จ !</strong> ลบข้อมูลทั้งหมดเรียบร้อย</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <br>

        <div class="card">
            <div class="card-header p-3 pt-2">

                <div class="text-end pt-1">
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <div class="card">
                    <div class="card-header p-3 pt-2">


                        <h5>รายการสินค้า</h5>

                    </div>
                    <div class="table-responsive">

                        <table class="table align-items-center mb-0" id="myTable">
                            <div class="form-group">

                            </div>
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7">
                                        รหัสสินค้า</th>
                                    <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7">ประเภท
                                    </th>
                                    <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                        ชื่อสินค้า
                                    </th>
                                    <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                        ราคาปลีก/ส่ง</th>



                                    <th></th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>



        <br><br>





    </div>

    <div class="col-9 mt-2">

        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">รายการขายปลีก</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7">ลำดับ
                                </th>
                                <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7">ชื่อสินค้า
                                </th>
                                <th class="text-uppercase text-secondary text-1xl font-weight-bolder opacity-7 ps-2">
                                    จำนวน</th>
                                <th
                                    class="text-center text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7">
                                    ราคาต่อชิ้น</th>
                                <th
                                    class="text-center text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7">
                                    ราคารวม</th>


                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 0;
                                $i = 1;
                            @endphp
                            @foreach ($reversedCart as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 ">{{ $i++ }}</h6>

                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 ">{{ $item->name }}</h6>

                                            </div>
                                        </div>
                                    </td>
                                    <td>




                                        <input type="number" style="width: 50px;border-style: none"
                                            id="updateinput{{ $index }}" value="{{ $item->quantity }}" />

                                        <a class="btn bg-gradient-secondary btn-sm" style="margin: 0 auto"
                                            onclick="testtwo('{{ $item->id }}','{{ $index }}')">รีเฟรช</a>


                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-pill badge-lg bg-gradient-success text-1xl">
                                            <h5 class="mb-0 " style="color: white">{{ $item->price }}</h5>
                                        </span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-pill badge-lg bg-gradient-success text-1xl">
                                            <h5 class="mb-0 " style="color: white">{{ $item->price * $item->quantity }}
                                            </h5>
                                        </span>
                                    </td>

                                    <td class="align-middle">

                                        <a class="btn bg-gradient-danger btn-sm mt-3"
                                            onclick="testone('{{ $item->id }}')">ลบ</a>

                                    </td>
                                    <form action="{{ route('list') }}" method="post" id="formsub">
                                        @csrf
                                        <input type="hidden" name="id[]" value="{{ $item->id }}">
                                        <input type="hidden" name="product_id[]" value="{{ $item->id }}">
                                        <input type="hidden" name="listall[]" value="{{ $item->name }}">
                                        <input type="hidden" name="quantity[]" value="{{ $item->quantity }}">
                                        <input type="hidden" name="price[]" value=" {{ $item->price }}">


                                </tr>


                                @php
                                    $index++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="card-body ">

                <div class="row">
                    <div class="col-4">
                        <div class="input-group input-group-static mb-4">
                            <label>
                                <h4>จำนวนเงินที่รับ</h4>
                            </label>
                            <input type="text" class="form-control" name="amount" id="num2"
                                style="color: rgb(19, 23, 235)" placeholder="ยอดเงิน" onchange="calculate()">
                            @error('amount')
                                <div class="my-2">
                                    <span class="text-danger my-2"> {{ $message }} </span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="input-group input-group-static mb-4">
                            <label>
                                <h4>ประเภทการชำระ</h4>
                            </label>
                            <div class="input-group input-group-static mb-1">
                                <select class="form-control" id="exampleFormControlSelect1" name="type_sale"
                                    style="color: rgb(19, 23, 235)">

                                    <option value="เงินสด"><b>เงินสด</b></option>
                                    <option value="โอนผ่านบัญชีธนาคาร"><b>โอนผ่านบัญชีธนาคาร</b></option>
                                    <option value="ค้างชำระ"><b>ค้างชำระ</b></option>

                                </select>
                                <input type="hidden" name="type" value="ขายปลีก">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group input-group-static mb-4">
                            <label>
                                <h4>รหัสผู้ค้างชำระ</h4>
                            </label>
                            <input type="text" class="form-control" list="browsers" name="debtors_id"
                                style="color: rgb(19, 23, 235)" placeholder="รหัสผู้ค้างชำระ">
                            @error('debtors_id')
                                <div class="my-2">
                                    <span class="text-danger my-2"> {{ $message }} </span>
                                </div>
                            @enderror

                            <datalist id="browsers">
                                @foreach ($deb as $item)
                                    <option value="{{ $item->id }}">{{ $item->email }} {{ $item->name }}</option>
                                @endforeach
                            </datalist>


                        </div>
                    </div>

                </div>

                <!-- fix -->
                <div class="row">
                    <div class="col-6">
                        <div class="input-group input-group-static mb-4">
                            <label>
                                <h4>กรณีพิเศษ</h4>
                            </label>
                            <select class="form-control" id="exampleFormControlSelect1" name="fix"
                                style="color: rgb(19, 23, 235)">
                                <option value="0">ปกติ</option>
                                <option value="1">โอนจ่ายแลกเงิน</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="input-group input-group-static mb-4">
                            <label>
                                <h4>ยอดส่วนต่าง</h4>
                            </label>
                            <input type="text" class="form-control" name="fix_cost" style="color: rgb(19, 23, 235)"
                                placeholder="ยอดเงิน">
                        </div>
                    </div>
                </div>
                <!-- fix -->

                <input type="hidden" class="btn btn-success " name="total_price" id="num1"
                    value=" {{ Cart::getTotal() }}">
                <h4> ยอดรวม : <span
                        class="badge badge-pill badge-lg bg-gradient-success">{{ number_format(Cart::getTotal(), 2, '.', ',') }}</span>
                    บาท
                </h4>

                <div class="row">

                    <h4> เงินทอน : <span class="badge badge-pill badge-lg bg-gradient-secondary">
                            <input class="form-control" style="color: rgb(255, 255, 255) ;font-size:1vw;width:120px"
                                id="answer" name="change" readonly> </span>
                    </h4>


                    @error('change')
                        <div class="my-2">
                            <span class="text-danger my-2"> {{ $message }} </span>
                        </div>
                    @enderror
                    <div class="col-6">
                        <button type="submit" class="btn btn-success " onclick="sendform()"
                            style="margin-left: 5%;float: right;padding: 20px 24px;">ออกใบเสร็จ</button>

                    </div>

                    </form>
                    <div class="col-6">
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger" style="padding: 20px 24px;">ล้างข้อมูลทั้งหมด</button>


                        </form>
                    </div>




                </div>


            </div>
        </div>

        <script>
            window.onload = function() {
                document.getElementById("inputkey").focus();
            }
        </script>


        <script>
            function printreceiptContent(el) {

                var data =
                    '';
                data += document.getElementById(el).innerHTML;
                myReceipt = window.open("", "myWin", "left=50,top=50,width=400,height=800");
                myReceipt.screnX = 0;
                myReceipt.screnY = 0;
                myReceipt.document.write(data);
                myReceipt.document.title = "พิมพ์ใบเสร็จรับเงิน";
                myReceipt.window.print();
                myReceipt.focus();
            }
        </script>
        <script>
            function calculate() {

                var field1 = document.getElementById("num1").value;
                var field = document.getElementById("num2").value;
                var result = parseFloat(field) - parseFloat(field1);

                if (!isNaN(result)) {
                    document.getElementById("answer").value = result;
                }
            }

            function testone(ele) {
                let data = {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id': ele
                }


                $.ajax({
                    type: 'post',
                    url: "{{ route('cart.remove') }}",
                    data: data,
                    success: function() {
                        location.reload();
                    }
                })
            }

            function testtwo(ele, index) {

                console.log(index)
                var datainput = $('#updateinput' + index).val()
                let data = {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id': ele,
                    'quantity': datainput
                }

                console.log(data)
                $.ajax({
                    type: 'post',
                    url: "{{ route('cart.update') }}",
                    data: data,
                    success: function() {
                        location.reload();

                    }
                })

            }

            function sendform() {
                formsub.submit();


            }
        </script>
    @endsection

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('product.index') }}",
                    columns: [{
                            data: 'id_product',
                            name: 'id_product'
                        },
                        {
                            data: 'category_name',
                            name: 'category_name'
                        }, // New column for category name
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'priceP',
                            name: 'priceP'
                        },

                    ],
                    deferRender: true,
                    // Pagination with server-side processing
                    serverSide: true,
                    processing: true,
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
    @endpush
